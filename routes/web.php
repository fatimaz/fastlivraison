<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::group([
    // 'prefix' => LaravelLocalization::setLocale(),
    // 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {

    Auth::routes();

    Route::group(['namespace' => 'Site'], function () {
         route::get('/','HomeController@home') -> name('home') ;
         route::get('/business','HomeController@businessPage') -> name('business') ;
         route::get('/captain','HomeController@captainPage') -> name('captain') ;
        Route::post('store','DemandesController@store') -> name('admin.demandes.store');
    });

    Route::get('/get/{token}', function ($token) {
        return 'dd';
        // token is right or wrong
        if (isset($token) && $token != "") {
            $getData = DB::table('password_resets')->where('token', $token)->get();
            if (count($getData) != 0) {
                return view('front.pages.passwords.setPassword')->with('data', $getData);
            } else {
                echo "404 Error: Page not found";
            }
        } else {
            echo "404 Error: Page not found";
        }
    })->name('activate'); 


        // Route::get('/forgetPassword', function () {
        //     return view('front.pages.passwords.resetPassScreen');
        // });


    Route::group(['namespace' => 'Api'], function () {
    //set/update new password
        Route::get('setPass', 'UserController@setPass');
        Route::get('/request-password', 'Api/UserController@confirmation');
    });
 
});




