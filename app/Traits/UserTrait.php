<?php

namespace App\Traits;

use App\Models\User;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Models\UserToken;


trait UserTrait
{
    public function authUserByEmail($email, $password)
    {

        $userId = null;

        $user = User::where('users.email', $email)->first();


        $token = Auth::guard('api')->attempt(['email' => $email, 'password' => $password]);


          
        // if($user-> email_verified_at == null)
        //        return null;

        if (!$user)
            return null;
        // to allow open  app on more device with the same account
            
        if ($token) {
            $newToken = new UserToken(['user_id' => $user->id, 'api_token' => $token]);
           // return $token ;
            $user->tokens()->save($newToken);
            //last access token
            $user->update(['api_token' => $token]);

           return $user;

        }
         return null;
         // return null;
    }

    public function getUserByTempToken($token)
    {
        $user = null;
        $user = User::where('api_token', $token)->first();
        return $user;
    }

    public function getUserMobileOrEmail($mobile = "")
    {
        $user = null;
        $user = User::where('mobile', $mobile)->first();
        return $user;
    }

    public function getAllData($id)
    {
        $user = User::with(['academy' => function ($q) {
            $q->select('id', DB::raw('name_' . app()->getLocale() . ' as name'),'name_ar','name_en','code', 'logo');
        }, 'team' => function ($q) {
            $q->select('id', DB::raw('name_' . app()->getLocale() . ' as name'),'name_ar','name_en', 'photo');
        }, 'category' => function ($qq) {
            $qq->select('id', 'name_' . app()->getLocale() . ' as name');
        }])->find($id);

        return $user;
    }

}