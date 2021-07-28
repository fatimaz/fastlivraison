<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Trip;
use App\Models\User;
use App\Traits\GeneralTrait;
use Validator;

use DB;

class BookingsController extends Controller
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
    public function index()
    {

      try {
          // $userId = auth('api')->user()->id;
                //0 for active bookings
                // $trip_id = 2;
         $userId = 169;
          
         $activebookings= Reservation::where('user_id',$userId)
                         ->where('status', 'active')
                         ->with('trip','trip.driver','trip.vehicle')
                         ->with(['trip.stations'=> function ($q) {
                           $q->orderBy('time', 'asc');
                         }])->get(); 
    
         $pastbookings= Reservation::where('user_id',$userId)
                               ->where(function ($query) {
                                $query->where('status', 'confirmed')
                                     ->orwhere('status', 'absent');
                           })
                         ->with('trip','trip.driver','trip.vehicle')
                         ->with(['trip.stations'=> function ($q) {
                           $q->orderBy('time', 'asc');
                         }])->get(); 
 
       return response()->json([
            'status' => true,
            'errNum' => "S000",
            'msg' => "",
            'pastbookings'=> $pastbookings,
            'activebookings'=> $activebookings,
           'token_type' => 'bearer'
        ]);

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

        $reservation = new Reservation();
        $userId = 169;
        $Id = 1;
         
        $reservationtrip = Reservation::where('trip_id',$Id )->Where('user_id',$userId)->first();
        // return  $reservationtrip;
        if($reservationtrip)
            return $this->returnError('D000', trans('Already booked'));


        $trip = Trip::where('id', $request->input('trip_id'))->first();


        // if($link->time_start == $request->input('time_start')){
        //     return $this->returnError('E005', 'You already booked another trip at the same time');
        // }
        $reservation->user_id =169; 
        // auth('api')->user()->id;     
         $reservation->trip_id = $request->input('trip_id');
         $reservation->last_price = $request->input('last_price');
         $reservation->qty = $request->input('qty');
         $randomId  =   rand(2,100);
         $reservation->code = $randomId;
         $reservation->save();
         $tripID = $reservation->trip_id;
         $userID = $reservation->user_id;
         $reservation_qty =$reservation->qty;
         $reservation_price =$reservation->last_price;



       if($reservation){
            $total_places= $trip ->total_places;
            $left_places = $total_places - $reservation_qty;
         
            $trip ->update([
                            'total_places' => $left_places,
                    ]);

            $user = User::where('id', $userID)->first();
              if($user)
                $balance = $user->balance - $reservation_price;

              $user ->update([
                            'balance' => $balance,
                    ]);

              if($balance < -100)
                 return $this->returnError('E031', 'You have insuffisant credit, please top up your balance');

         }

         DB::commit();
         return $this->returnSuccessMessage('Booking saved successfully');
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







