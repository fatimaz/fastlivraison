<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Shipment;
use App\Models\Trip;
use App\Models\User;
use App\Traits\GeneralTrait;
use Validator;

use DB;

class ShipmentsController extends Controller
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
    public function show_matching_shipments(){

     try{
       $shipments = Shipment::with('user','category')->where('user_id',1)->get();

           return $this-> returnData('shipments',$shipments);
     
      } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
     }  
    }
    public function index()
    {

      try {
          $shipments = Shipment::with('user','category')->get();
          return $this-> returnData('shipments',$shipments);
    
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

    public function uploadImage(Request $request)
    {
          return $request->all();

    }

    public function store(Request $request)
    {
       // try {


        DB::beginTransaction();

        //   $validator = Validator::make($request->all(), [
        //         "from" => "required",                 
        //         "to" => "required",
        //         "expected_date" => "required",
                
        //     ]);
        //  if ($validator->fails()) {
        //     $code = $this->returnCodeAccordingToInput($validator);
        //     return $this->returnValidationError($code, $validator);
        // }
          //validation
        $shipment = new Shipment();
        if (!$request->has('is_active'))
             $shipment->is_active = 0; 
        else
            $shipment->is_active = 1; 


        $fileName = "";
        if ($request->hasFile('shipmentImage')) {
           $path = $request->file('shipmentImage')->store('products');
            $shipment->photo = $path;
        }
        

         $shipment->user_id =1; 
        // auth('api')->user()->id;    
         $shipment->from =$request->input('from'); 
         $shipment->to =$request->input('to');  

         $shipment->expected_date =$request->input('expected_date');  
         $shipment->category_id =$request->input('category_id');  
         $shipment->link =$request->input('link');  
         $shipment->price =$request->input('price'); 
         $shipment->name =$request->input('name');   
         $shipment->qty =$request->input('qty');  
         $shipment->weight =$request->input('weight'); 
       
         // $shipment->photo =$fileName ; 
         $shipment->description =$request->input('description'); 
         $shipment->save();

         DB::commit();
         return $request->param ;

         


         // $this->returnSuccessMessage('Shipment saved successfully');
          // } catch (\Exception $ex) {
          //        DB::rollback();
          //       return $this->returnError($ex->getCode(), $ex->getMessage());
          // }
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







