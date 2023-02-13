<?php

namespace App\Http\Middleware;

use App\Traits\GeneralTrait;
use Closure;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use JWTAuth;

class AssignGuard extends BaseMiddleware
{
  use GeneralTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if($guard != null)
            auth()->shouldUse($guard);

           $token = $request->header('api_token');
           $request->headers->set('api_token', (string) $token, true);
          //  $request->headers->set('Authorization', 'Bearer ' .$token, true);
           $response->headers->set('Authorization', 'Bearer '.$token);
           try{
            //  $user = $this->auth->authenticate($request);
            $user = JWTAuth::parseToken()->authenticate();

           }catch(TokenExpiredException $e){
             return $this-> returnError('401','Unautheticated user');
           }catch(JWTException $e){
             return $this-> returnError('','token_invalid',$e->getMessage());
           }


         return $next($request);
    }
}