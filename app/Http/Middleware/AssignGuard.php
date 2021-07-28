<?php

namespace App\Http\Middleware;


use Closure;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class AssignGuard extends BaseMiddleware
{
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
           $request->headers->set('authorization', 'Bearer ' .$token, true);
           try{
             $user = $this->auth->authenticate($request);

           }catch(TokenExpiredException $e){
             return $this-> returnError('401','Unautheticated user');
           }catch(JWTException $e){
             return $this-> returnError('','token_invalid',$e->getMessage());
           }


         return $next($request);
    }
}