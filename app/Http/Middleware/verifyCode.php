<?php

namespace App\Http\Middleware;


use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;

use Closure;

class verifyCode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {


       if (Auth::guard('api')->check()) {  // if he already registered and have account

            if(Auth::user() -> email_verified_at == null){

                // return redirect(RouteServiceProvider::VERIFIED);
               return $this->returnError('E003', 'Phone not verified');

            }

        }
        return $next($request);
    }
}
