<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\Academy;
use App\Models\AcadSubscription;
use App\Models\Coach;
use App\Models\Notification;
use App\Models\Rate;
use App\Models\Subscription;
use App\Models\Team;
use App\Models\Token;
use App\Models\User;
use App\Models\UserToken;
use App\Notifications\UserPasswordReset;
use App\Traits\GlobalTrait;
use App\Traits\SMSTrait;
use App\Traits\SubscriptionTrait;
use App\Traits\UserTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use Auth;
use JWTAuth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    use UserTrait, GlobalTrait, SMSTrait, SubscriptionTrait;

    public function __construct(Request $request)
    {

    }


    public function register(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "firstname" => "required|max:255",
                "lastname" => "required|max:255",
                "mobile" => array(
                    "required",
                    "string",
                    "max:11",
                    "unique:users,mobile",
                    "regex:/^01[0-2]{1}[0-9]{8}/",
                ),
                "device_token" => "required|max:255",
                "password" => "required||min:6|max:255",
                "email" => "required|email|max:255|unique:users,email",
                // "photo" => "required",
            ]);

            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }
            DB::beginTransaction();
            try {

                // if (isset($request->photo) && !empty($request->photo)) {
                //     $fileName = $this->saveImage('users', $request->photo);
                // }

                $user = User::create([
                    'firstname' => trim($request->firstname),
                    'lastname' => trim($request->lastname),
                    'password' => $request->password,
                    'mobile' => $request->mobile,
                    // 'photo' => $fileName,
                    // 'status' => 0,
                    'device_token' => $request->device_token,
                    'email' => $request->email,
                    'api_token' => ''
                ]);


                DB::commit();

                //fire pusher  notification for admin
                event(new \App\Events\NewRegisteration($notify));   // fire pusher message event notification*/

                return $this->returnData('user', json_decode(json_encode($this->authUserByMobile($request->mobile, $request->password))), __('messages.registered succussfully'));
            } catch (\Exception $ex) {
                DB::rollback();
                return $this->returnError($ex->getCode(), $ex->getMessage());
            }

        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }


    public
    function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "device_token" => "required|max:255",
            "mobile" => "required",
            "password" => "required",
        ]);

        if ($validator->fails()) {
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code, $validator);
        }
        $user = $this->authUserByMobile($request->mobile, $request->password);

        if ($user != null) {

            if ($user->subscribed == 0) {
                return $this->returnError('E338', __('messages.unsubscribe'));
            } else {
                DB::beginTransaction();
                $user->device_token = $request->device_token;
                $user->update();
                $user->name = $user->getTranslatedName();
                DB::commit();
            }
            return $this->returnData('user', json_decode(json_encode($user)));
        }
        return $this->returnError('E001', trans('messages.No result, please check your registration before'));
    }

    public function CodeVerification(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "api_token" => "required",
                "activation_code" => "required"
            ]);
            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }

            $user = $this->getUserByTempToken($request->api_token);
            if (!$user) {
                return $this->returnError('E001', trans('messages.no user found'));
            }

            if ($user->activation_code != $request->activation_code)
                return $this->returnError('E001', trans('messages.This code is not valid please enter it again'));
            $user->update(['activation_code' => '']);
            $user->name = $user->getTranslatedName();
            $user->makeVisible(['api_token', 'status', 'name_en', 'name_ar']);
            return $this->returnData('user', json_decode(json_encode($user)), ' تم التحقيق من الكود بنجاح ');
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    public
    function resendCodeVerification(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "api_token" => "required",
            ]);
            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }

            $user = $this->getUserByTempToken($request->api_token);
            if (!$user) {
                return $this->returnError('E001', trans('messages.no user found'));
            }
            $code = $this->getRandomString(4);
            $user->update(['activation_code' => $code]);
            $user->notify(new UserPasswordReset($code));
            return $this->returnData('user', json_decode(json_encode($user)), trans('messages.confirm code send'));
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    public function forgetPassword(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "mobile" => array(
                    "required",
                    "exists:users,mobile"
                )
            ]);
            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }

            $user = $this->getUserMobileOrEmail($request->mobile);
            if (!$user) {
                return $this->returnError('E001', trans('messages.No user with this mobile'));
            }
            DB::beginTransaction();
            try {
                $code = $this->getRandomString(4);
                $tempToken = $this->getRandomString(250);
                $user->update(['api_token' => $tempToken, 'activation_code' => $code]);
                $user->notify(new UserPasswordReset($code));
                return $this->returnData('user', json_decode(json_encode($user)), trans('messages.confirm code send'));
            } catch (\Exception $ex) {
                DB::rollback();
                return $this->returnError($ex->getCode(), $ex->getMessage());
            }
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }

    }


    public function passwordReset(Request $request)
    {

        try {
            $validator = Validator::make($request->all(), [
                "password" => "required|confirmed|max:255|min:6",
                "api_token" => "required"
            ]);
            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }
            $user = $this->getUserByTempToken($request->api_token);
            if (!$user) {
                return $this->returnError('E001', trans('messages.no user found'));
            }

            DB::beginTransaction();

            try {
                $user->update([
                    'password' => $request->password,
                    'activation_code' => ''
                ]);
                DB::commit();
                return $this->returnSuccessMessage(trans('messages.password reset Successfully'));
            } catch (\Exception $ex) {
                DB::rollback();
                return $this->returnError($ex->getCode(), $ex->getMessage());
            }
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    public
    function logout(Request $request)
    {
        try {
            $user = $this->auth('user-api');
            $token = $request->api_token;
            UserToken::where('api_token', $token)->delete();
            $user->api_token = '';
            $user->device_token = '';
            $user->update();
            return $this->returnData('message', trans('messages.Logged out successfully'));
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }


    public function update_user_profile(Request $request)
    {
        $user = $this->auth('user-api');
        if (!$user) {
            return $this->returnError('D000', trans('messages.User not found'));
        }

        try {

            $rules = [
                "email" => "required|email|max:255|unique:users,email," . $user->id,
            ];

            if ($request->has('password')) {
                $rules['password'] = "required|nullable|confirmed||min:6|max:255";
                $rules['old_password'] = "required";
            }

            if ($request->has('photo')) {
                $rules['photo'] = "required";
            }

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }
            $fileName = $user->photo;
            if (isset($request->photo) && !empty($request->photo)) {
                $fileName = $this->saveImage('users', $request->photo);
            }

            if ($request->password) {
                //check for old password
                if (Hash::check($request->old_password, $user->password)) {
                    $user->update([
                        'password' => $request->password,
                    ]);
                } else {
                    return $this->returnError('E002', trans('messages.invalid old password'));
                }
            }

            $user->update(['photo' => $fileName] + $request->except('photo'));
            $user = $this->getAllData($user->id);
            $user->name = $user->{'name_' . app()->getLocale()};
            return $this->returnData('user', json_decode(json_encode($user)),
                trans('messages.User data updated successfully'));
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }

    }
}