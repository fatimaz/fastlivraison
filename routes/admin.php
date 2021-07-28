<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/




Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {



    //prefix admin
    Route::group(['namespace' => 'Admin', 'middleware'=> 'auth:admin','prefix' => 'admin'],function(){
        Route::get('/','DashboardController@index')->name('admin.dashboard');
        Route::get('logout','LoginController@logout')->name('admin.logout');

        Route::group(['prefix' => 'settings'], function () {
            Route::get('shipping-methods/{type}', 'SettingsController@editShippingMethods')->name('edit.shippings.methods');
            Route::put('shipping-methods/{id}', 'SettingsController@updateShippingMethods')->name('update.shippings.methods');
            #settingsite
            Route::get('/sitesetting', 'SettingsController@index');
            Route::put('/sitesetting', 'SettingsController@store')->name('update.settings');

        });

        Route::group(['prefix' => 'profile'],function(){
            Route::get('edit','ProfileController@editProfile')->name('edit.profile');
            Route::put('update','ProfileController@updateProfile')->name('update.profile');
        });



    ################################## Users routes #################################################
        Route::group(['prefix' => 'users'], function () {
            Route::get('/','UsersController@index') -> name('admin.users');
            Route::get('create','UsersController@create') -> name('admin.users.create');
            Route::post('store','UsersController@store') -> name('admin.users.store');
            Route::get('edit/{id}','UsersController@edit') -> name('admin.users.edit');
            Route::post('update/{id}','UsersController@update') -> name('admin.users.update');
            Route::get('delete/{id}','UsersController@destroy') -> name('admin.users.delete');
        });
        ################################## end addresses    ################################################


  

        ################################## shipments routes #################################################
        Route::group(['prefix' => 'shipments'], function () {
            Route::get('/','ShipmentsController@index') -> name('admin.shipments');
            Route::get('create','ShipmentsController@create') -> name('admin.shipments.create');
            Route::post('store','ShipmentsController@store') -> name('admin.shipments.store');
            Route::get('edit/{id}','ShipmentsController@edit') -> name('admin.shipments.edit');
            Route::post('update/{id}','ShipmentsController@update') -> name('admin.shipments.update');
            Route::get('delete/{id}','ShipmentsController@destroy') -> name('admin.shipments.delete');
        });
        ################################## end shipments    ################################################

       ################################## categories routes #################################################
        Route::group(['prefix' => 'categories'], function () {
            Route::get('/','CategoriesController@index') -> name('admin.categories');
            Route::get('create','CategoriesController@create') -> name('admin.categories.create');
            Route::post('store','CategoriesController@store') -> name('admin.categories.store');
            Route::get('edit/{id}','CategoriesController@edit') -> name('admin.categories.edit');
            Route::post('update/{id}','CategoriesController@update') -> name('admin.categories.update');
            Route::get('delete/{id}','CategoriesController@destroy') -> name('admin.categories.delete');
        });
        ################################## end categories    ################################################

       ################################## countries routes #################################################
        Route::group(['prefix' => 'countries'], function () {
            Route::get('/','CountriesController@index') -> name('admin.countries');
            Route::get('create','CountriesController@create') -> name('admin.countries.create');
            Route::post('store','CountriesController@store') -> name('admin.countries.store');
            Route::get('edit/{id}','CountriesController@edit') -> name('admin.countries.edit');
            Route::post('update/{id}','CountriesController@update') -> name('admin.countries.update');
            Route::get('delete/{id}','CountriesController@destroy') -> name('admin.countries.delete');
        });
        ################################## end countries    ################################################




        ################################## Trips routes #################################################
        Route::group(['prefix' => 'trips'], function () {
            Route::get('/','TripsController@index') -> name('admin.trips');
            Route::get('create','TripsController@create') -> name('admin.trips.create');
            Route::post('store','TripsController@store') -> name('admin.trips.store');
            Route::get('edit/{id}','TripsController@edit') -> name('admin.trips.edit');
            Route::post('update/{id}','TripsController@update') -> name('admin.trips.update');
            Route::get('delete/{id}','TripsController@destroy') -> name('admin.trips.delete');
        });
        ################################## end Trips    ################################################


        ################################## orders routes #################################################
        Route::group(['prefix' => 'orders'], function () {
            Route::get('/','OrdersController@index') -> name('admin.orders');
            Route::get('create','OrdersController@create') -> name('admin.orders.create');
            Route::post('store','OrdersController@store') -> name('admin.orders.store');
            Route::get('edit/{id}','OrdersController@edit') -> name('admin.orders.edit');
            Route::post('update/{id}','OrdersController@update') -> name('admin.orders.update');
            Route::get('delete/{id}','OrdersController@destroy') -> name('admin.orders.delete');
        });
        ################################## end orders    ################################################

 
       ################################## coupons routes ######################################
        Route::group(['prefix' => 'coupons'], function () {
            Route::get('/','CouponsController@index') -> name('admin.coupons');
          
            Route::post('store','CouponsController@store') -> name('admin.coupons.store');
            Route::get('edit/{id}','CouponsController@edit') -> name('admin.coupons.edit');
            Route::post('update/{id}','CouponsController@update') -> name('admin.coupons.update');
            Route::get('delete/{id}','CouponsController@destroy') -> name('admin.coupons.delete');

        });
        ################################## end coupons    #######################################

 ################################## demandes routes ######################################
        Route::group(['prefix' => 'demandes'], function () {
            Route::get('/','DemandesController@index') -> name('admin.demandes');
            Route::get('delete/{id}','DemandesController@destroy') -> name('admin.demandes.delete');

        });
        ################################## end demandes    #######################################

    });

    Route::group(['namespace' => 'Admin', 'middleware'=> 'guest:admin','prefix' => 'admin'],function(){
        Route::get('login','LoginController@login')->name('admin.login');
        Route::post('login','LoginController@postLogin')->name('admin.post.login');
    });

});
