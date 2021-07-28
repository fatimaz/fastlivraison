<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\GeneralTrait;
use App\Traits\UserTrait;
use Illuminate\Http\Request;
use App\Http\Requests\PasswordRequest;

use App\Models\User;
use App\Models\User_Verification;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\VerificationServices;
use DB;
use Redirect;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{

    use GeneralTrait, UserTrait;
    public $verification_services;
   
     public function __construct(VerificationServices $verification_services)
     {   
      $this -> verification_services = $verification_services;
     }


    function login(Request $request)
    {
  
        // 
       try{
        $validator = Validator::make($request->all(), [
            // "device_token" => "required|max:255",
            "email" => "required|exists:users,email",
            "password" => "required",
        ]);

        if ($validator->fails()) {
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code, $validator);
        }

        // Login

        $user = $this->authUserByEmail($request->email, $request->password);

        if ($user != null) {           
            return $this->returnData('user', json_decode(json_encode($user)));
        }
        return $this->returnError('E001', trans('messages.No result, please check your registration before'));

    }catch(\Exception $ex){
     return $this->returnError($ex->getCode() , $ex-> getMessage());
    }
   }




    // 
   public function register(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "name" => "required|max:255",                 
                "password" => "required||min:6|max:255",
                "email" => "required|email|max:255|unique:users,email",
                
            ]);

            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }

          
            DB::beginTransaction();
            try {
    
                $user = User::create([
                    'name' => trim($request->name),
                    'password' => Hash::make($request->password),
                    'email' => $request->email,
                    'mobile' => $request->mobile,
                    'rewards' => 0,
                    'verified' => 1,
                    'api_token' => ''
                ]);

            // send OTP SMS code
            // set/ generate new code

             $verification['user_id'] = $user->id;
             $verification_data =  $this->verification_services->setVerificationCode($verification);
             $message = $this->verification_services->getSMSVerifyMessageByAppName($verification_data -> code );
            //save this code in verifcation table
            //done
            //send code to user mobile by sms gateway   // note  there is no gateway credentails in config file
            # app(VictoryLinkSms::class) -> sendSms($user -> mobile,$message);

                DB::commit();          
                return $this->returnData('user', json_decode(json_encode($this->authUserByEmail($request->email, $request->password))), 'registered successfully');
            } catch (\Exception $ex) {
                DB::rollback();
                return $this->returnError($ex->getCode(), $ex->getMessage());
            }
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }


    // 

    public function CodeVerification(Request $request)
    {
         try {
            $validator = Validator::make($request->all(), [
              
                "code" => "required"
            ]);
            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }

           $user = $this->getUserByTempToken($request->api_token);
            if (!$user) {
                return $this->returnError('E001', trans('messages.no user found'));
            }


           $verificationData = User_Verification::where('user_id',$user->id) -> first();
           if($verificationData -> code != $request->code){       
                return $this->returnError('E001', trans('messages.This code is not valid please enter it again'));
           }
            User::whereId(Auth::id()) -> update(['email_verified_at' => now()]);
            $this ->  verification_services -> removeOTPCode($request -> code);
             return $this->returnData('user', json_decode(json_encode($user)), 'code verified successfully');

        
       } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
       }
    }


  


   // forget password
//     public function forget(Request $request)
//     {
//         try {
//             $validator = Validator::make($request->all(), [
//                 "mobile" => array(
//                     "required",
//                     "exists:users,mobile"
//                 )
//             ]);
//             if ($validator->fails()) {
//                 $code = $this->returnCodeAccordingToInput($validator);
//                 return $this->returnValidationError($code, $validator);
//             }


//             $user = $this->getUserMobileOrEmail($request->mobile);
//             if (!$user) {
//                 return $this->returnError('E001', trans('messages.No user with this mobile'));
//             }
//             DB::beginTransaction();
//             try {
//                //$code = $this->getRandomString(4);


// //  generate new code 
//              $verification['user_id'] = $user->id;
                  

//                 $verification_data =  $this->verification_services->setVerificationCode($verification);
                 
//              $message = $this->verification_services->getSMSVerifyMessageByAppName($verification_data -> code );
//              $tempToken = $this->getRandomString(250);
//              $user->update(['api_token' => $tempToken, 'activation_code' => $verification_data -> code]);
               
//                 return $this->returnData('user', json_decode(json_encode($user)), trans('messages.confirm code send'));
//                 // 

//            // $verificationData = User_Verification::where('user_id',$user->id) -> first();
//            // if($verificationData -> code != $request->code){       
//            //      return $this->returnError('E001', trans('messages.This code is not valid please enter it again'));
//            // }
//             // User::whereId(Auth::id()) -> update(['email_verified_at' => now()]);
//             // $this ->  verification_services -> removeOTPCode($request -> code);
//             //  return $this->returnData('user', json_decode(json_encode($user)), 'code verified successfully');

          
//                 // $code = $this->getRandomString(4);
//                 // $tempToken = $this->getRandomString(250);
//                 // $user->update(['api_token' => $tempToken, 'activation_code' => $verification_data -> code ]);
//                 // $user->notify(new UserPasswordReset($code));
//                 // return $this->returnData('user', json_decode(json_encode($user)), trans('messages.confirm code send'));
//             } catch (\Exception $ex) {
//                 DB::rollback();
//                 return $this->returnError($ex->getCode(), $ex->getMessage());
//             }
//         } catch (\Exception $ex) {
//             return $this->returnError($ex->getCode(), $ex->getMessage());
//         }

//     }


    public function resendCodeVerification(Request $request)
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
   
    //  public function passwordReset(Request $request)
    // {

    //     try {
    //         $validator = Validator::make($request->all(), [
    //             "password" => "required|confirmed|max:255|min:6",
           
    //         ]);
    //         if ($validator->fails()) {
    //             $code = $this->returnCodeAccordingToInput($validator);
    //             return $this->returnValidationError($code, $validator);
    //         }
    //         $user = $this->getUserByTempToken($request->api_token);
    //         if (!$user) {
    //             return $this->returnError('E001', trans('messages.no user found'));
    //         }

    //         DB::beginTransaction();

    //         try {
    //             $user->update([
    //                'password' => Hash::make($request->password),
    //                 'activation_code' => ''
    //             ]);
    //             DB::commit();
    //             return $this->returnSuccessMessage(trans('messages.password reset Successfully'));
    //         } catch (\Exception $ex) {
    //             DB::rollback();
    //             return $this->returnError($ex->getCode(), $ex->getMessage());
    //         }
    //     } catch (\Exception $ex) {
    //         return $this->returnError($ex->getCode(), $ex->getMessage());
    //     }
    // }


    public function forgetPass(Request $request)
    {
          try {
              DB::beginTransaction();


           $email = $request->input('email');

              $validator = Validator::make($request->all(), [
                 "email" => "email|required"
            ]);
            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }

            $checkEmail = DB::table('users')->where('email', $email)->get();
            $emailcount = DB::table('password_resets')->select("email")->where('email', $email)->count();
            $emailtoken = DB::table('password_resets')->select("token")->where('email', $email)->first();
            if ($emailcount > 0) {
                $token = $emailtoken->token;
            } else {
                $randomNumber = rand(1, 500);
                $token_sl = bcrypt($randomNumber);
                $token = stripslashes($token_sl);
                $insert_token = DB::table('password_resets')->insert(['email' => $email, 'token' => $token,
                    'created_at' => \Carbon\Carbon::now()->toDateTimeString()]);
            }
            $name = User::select("username")->where("email", $email)->first();

            //echo "send reset link to this email address";
            $baseUrl = route('activate', $token);
            $to = $email;
            $subject = "Réinitialisation du mot de passe";
            $message = "<a href='$baseUrl'>$token</a>";
            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            // More headers
            $headers .= 'From: <admin@seizop.com>' . "\r\n";
            //mail($to, $subject, $message, $headers);
            $data = [
                'token' => $token,
                'baseUrl' => $baseUrl,
                'name' => $name,
            ];
            Mail::send('front.pages.passwords.forgetpassword', $data, function ($message) use ($email, $subject) {
                $message->from('admin@seizop.com', 'seizop');
                $message->to($email);
                $message->subject($subject);
            });



                DB::commit();          
                return $this->returnSuccessMessage('Email envoyé successfully');

         } catch (\Exception $ex) {
         return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }



    public function setPass(PasswordRequest $request)
    {
     try {
        $email = $request->email;
        $pass = $request->password;
        $cpass = $request->confirm_password;


        if ($pass == $cpass) {
            //update the pass for this user
            DB::table('users')->where('email', $email)->update(['password' => bcrypt($pass)]);
            return view('front.pages.passwords.resetsubmit');
        } else {
            return Redirect::back()->with(['error' => 'Les mots de passe ne correspondent pas']);

        }
         } catch (\Exception $ex) {
         return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    public function confirmation()
    {
        return view('front.pages.confirmation');
    }

}
