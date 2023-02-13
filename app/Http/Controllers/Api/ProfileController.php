<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
use Validator;
use App\Models\User;
use App\Traits\UserTrait;
use App\Models\User_Verification;
use App\Http\Services\VerificationServices;
use App\Http\Services\SMSGateways\NexmoLinkSms;
use DB;
use Hash;
class ProfileController extends Controller
{

    use GeneralTrait;
    use GeneralTrait, UserTrait;
    public $verification_services;
   
    public function __construct(VerificationServices $verification_services)
    {   
      $this -> verification_services = $verification_services;
      $this->middleware('auth:api');
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth('api')->user()->id;
        $profile = User::with('shipments','trips','offers','messages','messagesfrom')->withCount('messages')->where('id', $user_id)->firstOrFail();
       return $this-> returnData('profile',$profile , 'Compte utilisateur');  
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    { }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     try {
        DB::beginTransaction();
        $user_id = auth('api')->user()->id;
         $profile = User::find($user_id);
         $validator = Validator::make($request->all(), [
           'name' => 'required|max:255|string',
           'email' => 'required|email|max:255',  
        ]);
        if ($validator->fails()) {
               $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
        }

        if ($request->has('photo')) {
            $fileName = uploadImage('users', $request->photo);
            User::where('id',  $user_id)
                ->update([
                    'photo' => $fileName,
                ]);
            }
             if ($request->email != $profile->email) {
                $checkemail = $profile->where('email', $request->input('email'))->count();
                if ($checkemail != 0) {
                     return $this->returnError('E007', 'Adresse e-mail déjà prise');
                }
            }
            // $profile->fill($request->all())->save();
            // $profile->fill($request->except('_token','photo'));

            $profile->update($request->except('_token', 'id', 'photo'));
            // $profile->photo = $fileName;
            // $profile->save();
           DB::commit();
           return $this-> returnData('profile',$profile , 'Compte utilisateur enregistré');  
      } catch (\Exception $ex) {
            DB::rollback();
            return $this->returnError($ex->getCode(), $ex->getMessage());
      }
    }

    // public function update(Request $request, $id)
    // {
    //  try {
    //     DB::beginTransaction();
    //     $user_id = auth('api')->user()->id;
    //     $profile = User::find($user_id);
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|max:255|string',
    //         'email' => 'required|email|max:255',
    //     ]);
    //     if ($validator->fails()) {
    //            $code = $this->returnCodeAccordingToInput($validator);
    //             return $this->returnValidationError($code, $validator);
    //     }
    //      // else {
    //         if ($request->email != $profile->email) {
    //             $checkemail = $profile->where('email', $request->input('email'))->count();
    //             if ($checkemail != 0) {
    //                  return $this->returnError('E007', 'Adresse e-mail déjà prise');
    //             }
    //         }
    //         $profile->fill($request->all())->save();
    //        DB::commit();

    //          return $this-> returnData('signup',$profile , 'Compte utilisateur enregistré');  
    //   } catch (\Exception $ex) {
    //         DB::rollback();
    //         return $this->returnError($ex->getCode(), $ex->getMessage());
    //   }
    // }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {}

    public function changePassword(Request $request)
    {
     try{
         $userId  = auth('api')->user()->id;
         $user = User::find($userId);

        $validator = Validator::make($request->all(), [
            'password' => 'required|max:255',
            'newpassword' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code, $validator);
        }
            if (Hash::check($request->password, $user->password)) {
                $hash = Hash::make($request->newpassword);
                 $user->fill(['password' => $hash])->save();
                return $this->returnSuccessMessage('Password saved successfully');
       
           } else {
                return $this->returnError('E031', 'Veuillez vous assurer de taper le bon mot de passe');
           }
                  return $this->returnSuccessMessage('Password saved successfully');
                  DB::commit();

      } catch (\Exception $ex) {
                 DB::rollback();
                return $this->returnError($ex->getCode(), $ex->getMessage());
       }
 }

 public function sendPhone(Request $request)
 {
     try {
         $validator = Validator::make($request->all(), [
             "mobile" => "required|max:255",                 
         ]);

         if ($validator->fails()) {
             $code = $this->returnCodeAccordingToInput($validator);
             return $this->returnValidationError($code, $validator);
         }
         DB::beginTransaction();
         try {
            $userId = auth('api')->user()->id;
            $user = User::find($userId);
 
             $user->update([
                 'mobile' => $request->mobile,
             ]);
         // send OTP SMS code
         // set/ generate new code
          $verification['user_id'] = $user->id;
          $verification_data =  $this->verification_services->setVerificationCode($verification);
          $message = $this->verification_services->getSMSVerifyMessageByAppName($verification_data -> code );
         //save this code in verifcation table
         //send code to user mobile by sms gateway   // note  there is no gateway credentails in config file
           app(NexmoLinkSms::class) -> sendSms($request->mobile,$message);
            
            DB::commit();           
            return $this->returnSuccessMessage('Phone saved successfully');
         } catch (\Exception $ex) {
             DB::rollback();
            return $this->returnError($ex->getCode(), $ex->getMessage());
         }
     } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
     }
 }


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

         $user_id = auth('api')->user()->id;
         $user = User::where('id',$user_id)->first();
     //    $user = $this->getUserByTempToken($request->api_token);
         if (!$user) {
             return $this->returnError('E001', 'User Not found');
         }

        $verificationData = User_Verification::where('user_id',$user->id) -> first();

        if($verificationData -> code != $request->code){       
             return $this->returnError('E001', 'Ce code n\'est pas valide veuillez le saisir à nouveau');
        }
    

         User::whereId($user_id)->update(['phone_verified_at' => now()]);
         $this ->  verification_services -> removeOTPCode($request -> code);
          return $this->returnData('user', json_decode(json_encode($user)), 'code verified successfully');
     
    } catch (\Exception $ex) {
         // return $this->returnError($ex->getCode(), $ex->getMessage());
         return $this->returnError('E001', 'Ce code est expiré');
    }
 }
}





