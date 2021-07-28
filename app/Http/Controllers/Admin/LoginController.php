<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;

class LoginController extends Controller
{
     public function login(){
         return view('admin.auth.login');
     }
    public function postLogin(AdminLoginRequest $request){


        $remember_me = $request->has('remember_me') ? true : false;

        if (auth()->guard('admin')->attempt(['email' => $request->input("email"), 'password' => $request->input("password")], $remember_me)) {
            return redirect() -> route('admin.dashboard');
        }
        return redirect()->back()->with(['error' => 'There is an error in your data']);
    }


     public function logout(){
        $guard = $this -> getGuard();
         $guard -> logout();
         return redirect()->route('admin.login');
     }

     
    private function getGuard(){
        return auth('admin');
    }
}

