<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Category;
use App\Models\Trip;
use App\Models\User;
use App\Traits\GeneralTrait;
use Validator;

use DB;

class PaymentController extends Controller
{
     use GeneralTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

      public function pay(){
     
          \Stripe\Stripe::setApiKey( 'pk_test_51JoOflCMUdU8l4yqOxMDhui3K86HHF04Cc6tKRPpzy9r9HIp5FGWAW3g036nk8aGG2uqLH77BNz6lJocrGtXvV2M00NGoEPQVa');

            $intent = \Stripe\PaymentIntent::create([
                'amount' => 1099,
                'currency' => 'gbp',
                ]);
                 $client_secret = $intent->client_secret;

                 
      }
    public function index()
    {
      try {
          $categories = Category::get();
          return $this-> returnData('categories',$categories);

        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


     
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */




    public function destroy($id)
    {}

}







