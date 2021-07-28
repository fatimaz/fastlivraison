<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

 Route::group(['namespace' => 'Api', 'middleware' => 'auth:api'], function () {
	  
     // Route::apiResource('bookings','BookingsController');
    Route::get('balance','ProfileController@showUserBalance');
    Route::apiResource('profile', 'ProfileController');
 });


//all routes / api here must be api authenticated
    Route::group([ 'namespace' => 'Api'], function () {
    Route::get('get-shipments','ShipmentsController@index');



  Route::post('uploadImage','ShipmentsController@uploadImage');


    




    Route::get('get-trips','TripsController@index');
    Route::post('countbuses','TripsController@countBuses');

    
    Route::get('voyage','VoyageController@index');
    Route::apiResource('bookings','BookingsController');
    Route::apiResource('ratings','RatingController'); 
    Route::apiResource('shipments','ShipmentsController'); 
    Route::post('changePassword', 'ProfileController@changePassword');


 
    // 'middleware' => 'api',
     Route::group(['prefix' => 'user'],function (){
	         Route::post('login', 'UserController@login');
	         Route::post('register', 'UserController@register');
	         Route::post('resend/verification-code', "UserController@resendCodeVerification");
	         Route::post('codeverification', "UserController@CodeVerification");
           Route::post('forgetPassword', "UserController@forgetPass");    
     });

        Route::group(['prefix' => 'driver'],function (){
          Route::post('login', 'DriverController@login');
      
          Route::apiResource('trips', 'DriverController');
           Route::post('getfrombalance', 'DriverController@getFromBalance');
           Route::post('pay_same_price', 'DriverController@paySamePrice');
             Route::post('payMore', 'DriverController@payMore');

           
        });

        // hada project l9dim
    // Route::post('login', 'AuthController@login');
       // Route::post('logout', 'AuthController@logout');
    // Route::post('refresh', 'AuthController@refresh');
    // Route::post('me', 'AuthController@me');
    // Route::get('password','Api\ProfileController@changePassword');



    Route::apiResource('profile', 'ProfileController');
    Route::apiResource('signup','SignupController');
    Route::apiResource('ratings','RatingController');

    // Route::group([ 'namespace' => 'Api','middleware' => 'api'], function () {

          // Route::get('get-trips','TripsController@index');
    // }
     // Reservations
  
});



// dd



    // Route::post('/password/email', 'Api\ForgotPasswordController@sendResetLinkEmail');
    // Route::post('/password/reset', 'Api\ResetPasswordController@reset');



//    Route::group(['middleware' => ['auth']], function () {


   // Route::post('cancelBooking/{id}','Api\BookingsController@cancelBooking');

    // Route::post('forgetpass','Api\SignupController@forgetPass');

