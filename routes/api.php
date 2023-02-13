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
Route::group([ 'middleware' => ['auth:api']], function () {
Route::get('/users', function (Request $request) {
  return auth('api')->user();
});
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
    Route::apiResource('trips', 'TripsController');



    Route::apiResource('menus', 'MenusController');


    Route::get('voyage','VoyageController@index');
    Route::apiResource('bookings','BookingsController');

    Route::apiResource('ratings','RatingController'); 

    Route::apiResource('carts','CartsController'); 

    Route::apiResource('products','ProductsController'); 

    Route::apiResource('prescriptions','PrescriptionsController'); 

    
    Route::apiResource('shipments','ShipmentsController'); 
    Route::get('getMyshipments',"ShipmentsController@showMyShipments"); 
    Route::get('getmatchingshipments',"ShipmentsController@matchingShipments"); 
    Route::post('updateshipment',"ShipmentsController@updateShipment"); 

 

    Route::get('avis/received',"RatingController@getReceived"); 
    Route::get('avis/given',"RatingController@getGiven"); 

    Route::get('deals',"OffersController@deals"); 
    Route::post('offers/edit/{id}',"OffersController@updateOffer"); 

    
    Route::apiResource('messages','MessagesController');
    Route::apiResource('reports','ReportController');

    Route::get('get/usermessages','MessagesController@showUserMessages');
    

   Route::get('email/resend',"VerificationController@resend"); 
   Route::get('email/verify/{id}/{hash}',"VerificationController@verify"); 
   Route::post('verify',"VerificationController@verifyEmail"); 


   Route::get('/verify/email/{token}/{user_id}', 'VerificationController@setVerify')->name('verify'); 

    Route::apiResource('countries','CountriesController'); 
    Route::apiResource('categories','CategoriesController'); 
    Route::apiResource('offers','OffersController'); 
    Route::apiResource('chats','ChatsController'); 
    Route::post('changePassword', 'ProfileController@changePassword');
    Route::post('send/phonenumber', 'ProfileController@sendPhone');

    
    // 'middleware' => 'api',
    Route::group(['prefix' => 'user'],function (){
	         Route::post('login', 'UserController@login');
	         Route::post('register', 'UserController@register');
	         Route::post('resend/verification-code', "UserController@resendCodeVerification");
           Route::post('forgetPassword', "UserController@forgetPass");    
     });


        // hada project l9dim
    // Route::post('login', 'AuthController@login');
       // Route::post('logout', 'AuthController@logout');
    // Route::post('refresh', 'AuthController@refresh');
    // Route::post('me', 'AuthController@me');
    // Route::get('password','Api\ProfileController@changePassword');
    Route::apiResource('profile', 'ProfileController');
    Route::apiResource('signup','SignupController');
    Route::post('codeverification', "ProfileController@CodeVerification");
  


    Route::post('photo', 'ProfileController@editPhoto');
    

    // Route::group([ 'namespace' => 'Api','middleware' => 'api'], function () {

          // Route::get('get-trips','TripsController@index');
    // }
     // Reservations
  
});

    // Route::post('/password/email', 'Api\ForgotPasswordController@sendResetLinkEmail');
    // Route::post('/password/reset', 'Api\ResetPasswordController@reset');  

    // Route::group(['middleware' => ['auth']], function () {
    // Route::post('cancelBooking/{id}','Api\BookingsController@cancelBooking');
    // Route::post('forgetpass','Api\SignupController@forgetPass');

