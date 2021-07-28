<?php

namespace App\Http\Services;

use App\Models\User_Verification;


class SMSGateWayServices
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
        $message = " is your verification code for your account";


        return $code.$message;
    }

}