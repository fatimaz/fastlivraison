<?php

namespace App\Http\Services;

use App\Models\User_Verification;
use Illuminate\Support\Facades\Auth;


class VerificationServices
{
    /** set OTP code for mobile
     * @param $data
     *
     * @return User_Verification
     */
    public function setVerificationCode($data)
    {
        $code = mt_rand(100000, 999999);
        $data['code'] = $code;
        User_Verification::whereNotNull('user_id')->where(['user_id' => $data['user_id']])->delete();
        return User_Verification::create($data);
    }
    

    public function getSMSVerifyMessageByAppName( $code)
    {
        $message = " est votre code de vérification pour votre compte";
        return $code.$message;
    }

    
    public function checkOTPCode ($code){

        if (Auth::guard('api')->check()) {
            $verificationData = User_Verification::where('user_id',Auth::id()) -> first();

            if($verificationData -> code == $code){
                User::whereId(Auth::id()) -> update(['phone_verified_at' => now()]);
                return true;
            }else{
                return false;
            }
        }
        return false ;
    }
        public function removeOTPCode($code)
    {
        User_Verification::where('code',$code) -> delete();
    }


}