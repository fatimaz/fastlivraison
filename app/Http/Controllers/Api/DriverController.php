<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Validator;
use App\Models\Trip;
use App\Models\Driver;
use App\Models\User;
use App\Models\Reservation;
use Auth;

class DriverController extends Controller
{

    use GeneralTrait;

    public function login(Request $request)
    {

        try {
            $rules = [
                "email" => "required|exists:drivers,email",
                "password" => "required"

            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }

            //login

            $credentials = $request->only(['email', 'password']);

            $token = Auth::guard('driver-api')->attempt($credentials);

            if (!$token)
                return $this->returnError('E001', 'The login information is incorrect');

            $driver = Auth::guard('driver-api')->user();
            $driver->api_token = $token;
            //return token
            return $this->returnData('driver', $driver);

        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }


    }

    // public function logout(Request $request)
    // {
    //      $token = $request -> header('auth-token');
    //     if($token){
    //         try {

    //             JWTAuth::setToken($token)->invalidate(); //logout
    //         }catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e){
    //             return  $this -> returnError('','some thing went wrongs');
    //         }
    //         return $this->returnSuccessMessage('Logged out successfully');
    //     }else{
    //         $this -> returnError('','some thing went wrongs');
    //     }

    // }


    public function index(){

     try{
         $driver_id = 1;
         $trips = Driver::where('id', $driver_id)-> with(['trips' => function ($q) {
                    $q->orderBy('date', 'asc');
                  }])->with(['trips.stations' => function ($q) {
                     $q->orderBy('time', 'asc');
                  }])->with('trips.reservations')->with('trips.reservations.user')->get(); 
   
       return $this-> returnData('trips',$trips);  

      } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
     }
    }

     public function getFromBalance(){
    //user already has balance in his wallet
     
            DB::beginTransaction();
            $id = 4;
            $reservation = Reservation::find($id);


          $user = User::where('id',  $reservation->user_id)->first();


             if (!$reservation) {
                        return $this->returnError('D000', trans('This reservation does not exist'));
             }  

            $user_balance = $user ->balance ;

            // get payment from balance
             if( $user_balance >= $reservation->last_price ){

                       $user_paid =  $user_balance - $reservation->last_price;

                       $user ->balance =  $user_paid;
                        $user ->save();

             }

              //put extra money from client and pay price
             if(  $payment = 100){
                 // $user_balance = $user ->balance ;

                     $user_total_balance =  $user_balance + $payment;

                      $user_paid=   $user_total_balance - $reservation->last_price;

                      $user -> balance =  $user_paid;
                       $user -> save();
                  
             }
             //give same price
             if ( 3tani same price){
                   //   $reservation -> status = 'confirmed';
                   //  $reservation -> code = null;
                   //  $reservation -> save();
                   //  DB::commit();
                   // return $this->returnSuccessMessage('Entrée est Confirmée');
             }

             if( user denied){
                    $user_paid=  $user_balance - $reservation->last_price;
                   $user -> balance =  $user_paid;
                   $user ->save();
                   //  $reservation->status = 'denied';
                   //  $reservation->code = null;
                   //   $reservation->save();
                   //  DB::commit();
                   // return $this->returnSuccessMessage('Entrée est refusee');
             }
      

           $reservation->status = 'confirmed';
           //request->status
                        $reservation->code = null;
                        $reservation->save();
                       DB::commit();
                      return $this->returnSuccessMessage('Entrée est Confirmée');
   
         } catch (\Exception $ex) {
                   DB::rollback();
                return $this->returnError($ex->getCode(), $ex->getMessage());
         }
    }

     public function paySamePrice(){
    //user already has balance in his wallet
     
        DB::beginTransaction();
     
            $reservation = Reservation::find($id);

             if (!$reservation) {
                        return $this->returnError('D000', trans('This reservation does not exist'));
             }  
      
            $reservation -> status = 'confirmed';
            $reservation -> code = null;
            $reservation -> save();
            DB::commit();
           return $this->returnSuccessMessage('Entrée est Confirmée');
         } catch (\Exception $ex) {
                   DB::rollback();
                return $this->returnError($ex->getCode(), $ex->getMessage());
         }
    }
    public function payMore(Request $request)
    {
    try {

        DB::beginTransaction();
             $id = 4;

            $reservation = Reservation::find($id);


          $user = User::where('id',  $reservation->user_id)->first();

            $payment = 100;



             if (!$reservation) {
                        return $this->returnError('D000', trans('This reservation does not exist'));
             }  
             $user_balance = $user ->balance ;

             $user_total_balance =  $user_balance + $payment;

              $user_paid=   $user_total_balance - $reservation->last_price;

              $user -> balance =  $user_paid;
               $user -> save();
          
            $reservation->status = 'confirmed';
            $reservation->code = null;
            $reservation->save();
        DB::commit();
           return $this->returnSuccessMessage('Entrée est Confirmée');
         } catch (\Exception $ex) {
                   DB::rollback();
                return $this->returnError($ex->getCode(), $ex->getMessage());
         }
    }


    public function deniedPay(Request $request)
    {
    try {

        DB::beginTransaction();
             $id = 4;

            $reservation = Reservation::find($id);


           $user = User::where('id',  $reservation->user_id)->first();


             if (!$reservation) {
                        return $this->returnError('D000', trans('This reservation does not exist'));
             }  
             $user_balance = $user ->balance ;

     

              $user_paid=  $user_balance - $reservation->last_price;

              $user -> balance =  $user_paid;
               $user ->save();
          
            $reservation->status = 'denied';
            $reservation->code = null;
            $reservation->save();
        DB::commit();
           return $this->returnSuccessMessage('Entrée est refusee');
         } catch (\Exception $ex) {
                   DB::rollback();
                return $this->returnError($ex->getCode(), $ex->getMessage());
         }
    }

}