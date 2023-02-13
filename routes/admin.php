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
    // 'prefix' => LaravelLocalization::setLocale(),
    // 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
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



       ################################ Users routes #################################################
        Route::group(['prefix' => 'users'], function () {
            Route::get('/','UsersController@index') -> name('admin.users');
            Route::get('create','UsersController@create') -> name('admin.users.create');
            Route::post('store','UsersController@store') -> name('admin.users.store');
            Route::get('edit/{id}','UsersController@edit') -> name('admin.users.edit');
            Route::post('update/{id}','UsersController@update') -> name('admin.users.update');
            Route::get('delete/{id}','UsersController@destroy') -> name('admin.users.delete');
        });
        ################################## end addresses    #############################################

        ################################## products routes ##############################################
        Route::group(['prefix' => 'products'], function () {
            Route::get('/','ProductsController@index') -> name('admin.products');
            Route::get('create','ProductsController@create') -> name('admin.products.create');
            Route::get('show/{id}','ProductsController@show') -> name('admin.products.show');
            Route::post('store','ProductsController@store') -> name('admin.products.store');
            Route::get('edit/{id}','ProductsController@edit') -> name('admin.products.edit');
            Route::post('update/{id}','ProductsController@update') -> name('admin.products.update');
            Route::get('delete/{id}','ProductsController@destroy') -> name('admin.products.delete');
        });
        ################################## end products  #############################################

       ################################## categories routes #############################################
        Route::group(['prefix' => 'categories'], function () {
            Route::get('/','CategoriesController@index') -> name('admin.categories');
            Route::get('create','CategoriesController@create') -> name('admin.categories.create');
            Route::post('store','CategoriesController@store') -> name('admin.categories.store');
            Route::get('edit/{id}','CategoriesController@edit') -> name('admin.categories.edit');
            Route::post('update/{id}','CategoriesController@update') -> name('admin.categories.update');
            Route::get('delete/{id}','CategoriesController@destroy') -> name('admin.categories.delete');
        });
        ################################## end categories    #############################################
      
        ################################## prescriptions routes #############################################
       Route::group(['prefix' => 'prescriptions'], function () {
        Route::get('/','PrescriptionsController@index') -> name('admin.prescriptions');
        Route::get('create','PrescriptionsController@create') -> name('admin.prescriptions.create');
        Route::post('store','PrescriptionsController@store') -> name('admin.prescriptions.store');
        Route::get('edit/{id}','PrescriptionsController@edit') -> name('admin.prescriptions.edit');
        Route::post('update/{id}','PrescriptionsController@update') -> name('admin.prescriptions.update');
        Route::get('delete/{id}','PrescriptionsController@destroy') -> name('admin.prescriptions.delete');
        });
       ################################## end prescriptions    #############################################
     
       ################################## images routes #############################################
        Route::group(['prefix' => 'images'], function () {
            Route::get('/','ImagesController@index') -> name('admin.images');
            Route::get('create','ImagesController@create') -> name('admin.images.create');
            Route::post('store','ImagesController@store') -> name('admin.images.store');
            Route::get('edit/{id}','ImagesController@edit') -> name('admin.images.edit');
            Route::post('update/{id}','ImagesController@update') -> name('admin.images.update');
            Route::get('delete/{id}','ImagesController@destroy') -> name('admin.images.delete');
        });
       ################################## end images    #############################################
    
       ################################## carts routes ############################################
        Route::group(['prefix' => 'carts'], function () {
            Route::get('/','CartsController@index') -> name('admin.carts');
            Route::get('create','CartsController@create') -> name('admin.carts.create');
            Route::post('store','CartsController@store') -> name('admin.carts.store');
            Route::get('edit/{id}','CartsController@edit') -> name('admin.carts.edit');
            Route::post('update/{id}','CartsController@update') -> name('admin.carts.update');
            Route::get('delete/{id}','CartsController@destroy') -> name('admin.carts.delete');
        });
        ################################## end carts    #########################################

        ################################## Cart Product routes #############################################
        Route::group(['prefix' => 'cartproducts'], function () {
            Route::get('/','CartProductsController@index') -> name('admin.cartproducts');
            Route::get('create','CartProductsController@create') -> name('admin.cartproducts.create');
            Route::get('show/{id}','CartProductsController@show') -> name('admin.cartproducts.show');
            Route::post('store','CartProductsController@store') -> name('admin.cartproducts.store');
            Route::get('edit/{id}','CartProductsController@edit') -> name('admin.cartproducts.edit');
            Route::post('update/{id}','CartProductsController@update') -> name('admin.cartproducts.update');
            Route::get('delete/{id}','CartProductsController@destroy') -> name('admin.cartproducts.delete');
        });
        ################################## end cart product  ##############################################

        ################################## Ratings routes ############################################
         Route::group(['prefix' => 'ratings'], function () {
                    Route::get('/','RatingController@index') -> name('admin.ratings');
                    Route::get('create','RatingController@create') -> name('admin.ratings.create');
                    Route::get('show/{id}','RatingController@show') -> name('admin.ratings.show');
                    Route::post('store','RatingController@store') -> name('admin.ratings.store');
                    Route::get('edit/{id}','RatingController@edit') -> name('admin.ratings.edit');
                    Route::post('update/{id}','RatingController@update') -> name('admin.ratings.update');
                    Route::get('delete/{id}','RatingController@destroy') -> name('admin.ratings.delete');
         });
        ################################## end ratings    ############################################

        ################################## O routes ###########################################
        Route::group(['prefix' => 'messages'], function () {
            Route::get('/','MessagesController@index') -> name('admin.messages');
            Route::get('create','MessagesController@create') -> name('admin.messages.create');
            Route::post('store','MessagesController@store') -> name('admin.messages.store');
            Route::get('edit/{id}','MessagesController@edit') -> name('admin.messages.edit');
            Route::post('update/{id}','MessagesController@update') -> name('admin.messages.update');
            Route::get('delete/{id}','MessagesController@destroy') -> name('admin.messages.delete');
            Route::get('showchat','MessagesController@showchat') -> name('admin.showchat');
        });
        ################################## end messages    ##################################### 
   
        ################################## Reports routes #######################################
        Route::group(['prefix' => 'reports'], function () {
            Route::get('/','ReportsController@index') -> name('admin.reports');
            Route::get('show/{id}','ReportsController@show') -> name('admin.reports.show');
            Route::get('delete/{id}','ReportsController@destroy') -> name('admin.reports.delete');
        });
        ################################## end reports   ##########################################
    
        ################################## orders routes ###########################################
        Route::group(['prefix' => 'orders'], function () {
            Route::get('/','OrdersController@index') -> name('admin.orders');
            Route::get('create','OrdersController@create') -> name('admin.orders.create');
            Route::post('store','OrdersController@store') -> name('admin.orders.store');
            Route::get('edit/{id}','OrdersController@edit') -> name('admin.orders.edit');
            Route::post('update/{id}','OrdersController@update') -> name('admin.orders.update');
            Route::get('delete/{id}','OrdersController@destroy') -> name('admin.orders.delete');
            Route::get('/history','OrdersController@showList') -> name('admin.orders.list');
            Route::get('show/{id}','OrdersController@show') -> name('admin.orders.details');        
        });
        ################################## end orders    ############################################
     
        ################################## menus routes ##############################################
       Route::group(['prefix' => 'menus'], function () {
        Route::get('/','MenusController@index') -> name('admin.menus');
        Route::get('create','MenusController@create') -> name('admin.menus.create');
        Route::post('store','MenusController@store') -> name('admin.menus.store');
        Route::get('edit/{id}','MenusController@edit') -> name('admin.menus.edit');
        Route::post('update/{id}','MenusController@update') -> name('admin.menus.update');
        Route::get('delete/{id}','MenusController@destroy') -> name('admin.menus.delete');
        });
     ################################## end menus    ################################################
    
     ################################## restaurants routes ########################################
       Route::group(['prefix' => 'restaurants'], function () {
        Route::get('/','RestaurantsController@index') -> name('admin.restaurants');
        Route::get('create','RestaurantsController@create') -> name('admin.restaurants.create');
        Route::post('store','RestaurantsController@store') -> name('admin.restaurants.store');
        Route::get('edit/{id}','RestaurantsController@edit') -> name('admin.restaurants.edit');
        Route::post('update/{id}','RestaurantsController@update') -> name('admin.restaurants.update');
        Route::get('delete/{id}','RestaurantsController@destroy') -> name('admin.restaurants.delete');
    });
    ################################## end restaurants  ##############################################

    ################################## Options routes ##############################################
       Route::group(['prefix' => 'options'], function () {
        Route::get('/','OptionsController@index') -> name('admin.options');
        Route::get('create','OptionsController@create') -> name('admin.options.create');
        Route::post('store','OptionsController@store') -> name('admin.options.store');
        Route::get('edit/{id}','OptionsController@edit') -> name('admin.options.edit');
        Route::post('update/{id}','OptionsController@update') -> name('admin.options.update');
        Route::get('delete/{id}','OptionsController@destroy') -> name('admin.options.delete');
    });
    ################################## end options    ###########################################
      
    ################################## Attributes routes ###############################################
     Route::group(['prefix' => 'attributes'], function () {
        Route::get('/','AttributesController@index') -> name('admin.attributes');
        Route::get('create','AttributesController@create') -> name('admin.attributes.create');
        Route::post('store','AttributesController@store') -> name('admin.attributes.store');
        Route::get('edit/{id}','AttributesController@edit') -> name('admin.attributes.edit');
        Route::post('update/{id}','AttributesController@update') -> name('admin.attributes.update');
        Route::get('delete/{id}','AttributesController@destroy') -> name('admin.attributes.delete');
    });
    ################################## end Attributes    ###########################################

     ################################## coupons routes ######################################
        Route::group(['prefix' => 'coupons'], function () {
            Route::get('/','CouponsController@index') -> name('admin.coupons');
          
            Route::post('store','CouponsController@store') -> name('admin.coupons.store');
            Route::get('edit/{id}','CouponsController@edit') -> name('admin.coupons.edit');
            Route::post('update/{id}','CouponsController@update') -> name('admin.coupons.update');
            Route::get('delete/{id}','CouponsController@destroy') -> name('admin.coupons.delete');

        });
        ################################## end coupons    #######################################

       ############################## demandes routes ######################################
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

    Route::get('/test',function(){
        $user = \App\Models\Admin::find(1);
        $user -> notify(new \App\Notifications\PostNewNotification());
    });
});
