<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Trip;
use App\Models\User;
use App\Traits\GeneralTrait;
use Validator;

use DB;

class TripsController extends Controller
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
    public function show_matching_trips(){

     try{
       $trips = Trip::with('user','category')->where('user_id',1)->get();

           return $this-> returnData('trips',$trips);
     
     } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
     }  
    }
     public function index()
    {

      try {
          $trips = Trip::with('user','category')->get();
          return $this-> returnData('trips',$trips);
    
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
    public function store(Request $request)
    {
       try {

        DB::beginTransaction();

          $validator = Validator::make($request->all(), [
                "from" => "required",                 
                "to" => "required",
                "reservation_number" => "required",
                
            ]);
         if ($validator->fails()) {
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code, $validator);
        }
        $trip = new Trip();

         $trip->user_id =1; 
        // auth('api')->user()->id;    
         $trip->from =$request->input('from');  
         $trip->to =$request->input('to');  

          $trip->reservation_number =$request->input('reservation_number');  

         $trip->category_id =$request->input('category_id');  
         $trip->travel_date =$request->input('travel_date');  
         $trip->weight_total =$request->input('weight_total'); 
         $trip->name =$request->input('name');    
         $trip->weight_free =$request->input('weight_free');  
         $trip->transportation_type =$request->input('transportation_type'); 
         $trip->note =$request->input('note'); 

          $trip->save();

         DB::commit();
         return $this->returnSuccessMessage('Trip saved successfully');
          } catch (\Exception $ex) {
                 DB::rollback();
                return $this->returnError($ex->getCode(), $ex->getMessage());
          }
    }
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
    {
       try {

            $reservation = Reservation::find($id);

             if (!$reservation) {
                        return $this->returnError('D000', trans('This reservation does not exist'));
             }  
            $reservation->status = 'cancelled';
            $reservation->code = null;
            $reservation->save();
     
           return $this->returnSuccessMessage('Booking cancelled successfully');
         } catch (\Exception $ex) {
                return $this->returnError($ex->getCode(), $ex->getMessage());
         }
    }

}







