<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Link;
use App\Models\User;
use App\Traits\GeneralTrait;
use Validator;
use App\Models\Shipment;
use DB;

class Book extends Controller
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

   public function addShip(Request $request)
    {
       // try {
        //return $request->all();

        DB::beginTransaction();

        //   $validator = Validator::make($request->all(), [
        //         "from" => "required",                 
        //         "to" => "required",
        //         "expected_date" => "required",
                
        //     ]);
        //  //  'from','to','expected_date','link','name', 'photo', 'price' ,'weight' , 'qty' ,'description' , 'category_id' , 'user_id' ,'is_active'
        //  if ($validator->fails()) {
        //     $code = $this->returnCodeAccordingToInput($validator);
        //     return $this->returnValidationError($code, $validator);
        // }
      //  $shipment = new Shipment();

         $shipment = Shipment::create($request->except('_token')); 

        //  $shipment->user_id =2; 
        //  auth('api')->user()->id;    
        //  $shipment->from =1;  
        //  $shipment->to = 1;  
        //  $shipment->expected_date =20;       
        //  $shipment->link ='jj';  
        //  $shipment->name = 'njj'; 
        //  $shipment->price =7;    
        //  $shipment->weight =  5;  
        //  $shipment->qty = 7; 
        //  $shipment->description = 'hh'; 
        //  $shipment->is_active =1; 
        //  $shipment->category_id = 1;  
        //  $shipment->photo ='jjj'; 

        //   $shipment->save();
         return $shipment;
         //DB::commit();
         //return $this->returnSuccessMessage('shipment saved successfully');
         //} catch (\Exception $ex) {
         //       DB::rollback();
         //      return $this->returnError($ex->getCode(), $ex->getMessage());
         //}
}

       public function upload(Request $req){
        //$destinationPath = public_path('/upload');
             $image1 = $req->file('pic')->store('products');
             return $image1;
        //             $_image1 = rand().'.'.$image1->getClientOriginalExtension();
        //             $image1->move($destinationPath, $_image1);

        // $info = new Upload;
        // $info->image = $_image1;
        // $info->save();

       // return json_encode( $image1+" Successfully ");
        }
        public function index()
        {
            try {
          // $userId = auth('api')->user()->id;
                //0 for active bookings
                // $trip_id = 2;
               $userId = 169;
            //0 is active , 1 is past , 2 is cancelledbApp/
             $activebookings = DB::table('reservations')
             ->join('links', 'reservations.link_id', '=', 'links.id')
             ->join('trips', 'links.trip_id', '=', 'trips.id')
              ->join('drivers', 'drivers.id', '=', 'trips.driver_id')
             ->select( 'trips.*','links.*','drivers.*','reservations.*')
            ->where('reservations.user_id','=', $userId)
             ->where('reservations.status', 0)
            // ->where(function ($query) {
            //         $query->where('reservations.status', 1)
            //              ->orwhere('reservations.status', 0);
            //    })
            ->get();
          //1  for past bookings and 2 for cancelled
           $pastbookings = DB::table('reservations')
            // ->join('trips', 'reservations.trip_id', '=', 'trips.id')
            // ->join('links', 'trips.id', '=', 'links.trip_id') 
             ->join('links', 'reservations.link_id', '=', 'links.id')
             ->join('trips', 'links.trip_id', '=', 'trips.id')
               ->join('drivers', 'drivers.id', '=', 'trips.driver_id')
             ->select( 'trips.*','links.*','drivers.*','reservations.*')
              ->where('reservations.user_id','=', $userId)
              ->where(function ($query) {
                    $query->where('reservations.status', 1)
                         ->orwhere('reservations.status', 2);
               })
            ->get();
        // return response()->json([
        //     'success' => true,
        //     'message' => 'reservations',
        //     'activebookings' => $activebookings,
        //     'pastbookings'  => $pastbookings
        // ]);

          // return $this->returnData('pastbookings', $pastbookings);
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
            $reservation->status = 2;
            $reservation->save();
     
       return $this->returnSuccessMessage('Booking cancelled successfully');
         } catch (\Exception $ex) {
                return $this->returnError($ex->getCode(), $ex->getMessage());
            }
    }

}


