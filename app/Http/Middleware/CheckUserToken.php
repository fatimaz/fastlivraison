<?php

namespace App\Http\Middleware;

use App\Traits\GeneralTrait;
use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\UserToken;

class CheckUserToken
{

    use GeneralTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = null;
        try {
             $user = JWTAuth::parseToken()->authenticate();
            
        } catch (\Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return $this -> returnError('E3001','INVALID_TOKEN');
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
               $newToken = JWTAuth::parseToken()-> refresh();
                return $this -> returnError('E3001','EXPIRED_TOKEN');
                // $user = JWTAuth::parseToken()->authenticate();
                // $newToken = new UserToken(['user_id' => $user->id, 'api_token' => $newToken]);
             
                // $user->tokens()->save($newToken);
                //  $user->update(['api_token' => $newToken]);
                return response()->json(['status'=>true, 'token'=>$newToken , 'msg' => 'expired'],200);
            } else {
                return $this -> returnError('E3001','TOKEN_NOTFOUND');
            }
        } catch (\Throwable $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return $this -> returnError('E3001','INVALID_TOKEN');
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return $this -> returnError('E3001','EXPIRED_TOKEN');
            } else {
                return $this -> returnError('E3001','TOKEN_NOTFOUND');
            }
        }

        if (!$user)
        $this -> returnError(trans('Unauthenticated'));
        return $next($request);
    }
}