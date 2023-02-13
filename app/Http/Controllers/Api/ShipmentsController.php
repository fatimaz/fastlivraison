<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
use App\Models\Shipment;
use App\Models\Offer;
use App\Models\Trip;
use App\Models\User;
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
     $this->middleware('auth:api')->except('updateShipment','destroy','matchingShipments');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
        $user= auth('api')->user()->id; 
        $shipments = Shipment::with('user','countries','countriesto','user.shipments','user.trips','user.offers')->where('user_id','!=', $user)->orderBy('created_at', 'desc')->get();
          return $this-> returnData('shipments',$shipments);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    public function matchingShipments(Request $request)
    {
        try {
        $shipments = Shipment::with('user','countries','countriesto','user.shipments','user.trips','user.offers')->where('from', $request->input('country_from'))->where('to', $request->input('country_to'))->orderBy('created_at', 'desc')->get();
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
    public function showMyShipments(){
      try {
          $user_id = auth('api')->user()->id; 
          $offers = Offer::where('type','!=','rejected')->pluck('shipment_id');
          $myshipments = Shipment::with('user','user.shipments','user.trips','user.offers','category','countries','countriesto','offers.trip','offers.shipment','offers.trip.countries', 'offers.trip.countriesto', 'offers.user', 'offers.user.shipments','offers.user.trips')
          ->where('user_id',$user_id)
          ->with(['offers'=>function($query){
            $query->where('type' , '!=', 'rejected');
          }])->orderBy('created_at', 'desc')->get();
          // $shipments = Shipment::with('user','category','countries','countriesto','offers.trip','offers.trip.countries', 'offers.trip.countriesto', 'offers.user')
          // ->where('user_id',$user)
          // -> whereHas('offers', function($q){
          //   $q->where('type','rejected');
          // })->get();
          return $this-> returnData('myshipments',$myshipments);
      } catch (\Exception $ex) {
          return $this->returnError($ex->getCode(), $ex->getMessage());
      }
    }


    public function store(Request $request)
    {
       try {
        DB::beginTransaction();
          $validator = Validator::make($request->all(), [
                "from" => "required",                 
                "to" => "required",
                "link" => "required",
                "price" => "required|numeric",
                "name" => "required",
                "photo" => "required",     
            ]);
         if ($validator->fails()) {
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code, $validator);
        }
        $shipment = new Shipment();
        if (!$request->has('is_active'))
             $shipment->is_active = 0; 
        else
            $shipment->is_active = 1; 


            $fileName = "";
            if ($request->has('photo')) {
                $fileName  = uploadImage('products', $request->photo);    
            }
               

         $shipment->user_id =  auth('api')->user()->id;   
         $shipment->from = $request->input('from'); 
         $shipment->to = $request->input('to');  
         $shipment->expected_date = $request->input('expected_date');  
         $shipment->category_id = $request->input('category_id');  
         $shipment->link = $request->input('link');  
         $shipment->price = $request->input('price'); 
         $shipment->name = $request->input('name');   
         $shipment->qty = $request->input('qty');  
          $reward = $request->input('price') * 10 /100;
              if($reward <= 5){
                   $shipment->reward= 5;
              }else{
                 $shipment->reward = $request->input('price') * 10 /100; 
              }
    
             
         $shipment->weight = 0; 
         $shipment->photo =  $fileName ; 
         $shipment->description =$request->input('description'); 
         $shipment->save();

         DB::commit();
          return $this->returnSuccessMessage('Shipment saved successfully');
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

    public function update( $id,Request $request)
    {
      try {
      // DB::beginTransaction();
      $shipment = Shipment::find($request->input('id'));

      if (!$shipment)
      return redirect()->route('admin.shipments')->with(['error' => 'This shipment doesnt exist']);

      $shipment->user_id = auth('api')->user()->id;   
      $shipment->from = $request->input('from'); 
      $shipment->to = $request->input('to');  
      $shipment->expected_date = $request->input('expected_date');  
      $shipment->category_id = $request->input('category_id');  
      $shipment->link = $request->input('link');  
      $shipment->price = $request->input('price'); 
      $shipment->name = $request->input('name');   
      $shipment->qty = $request->input('qty');  
      $reward = $request->input('price') * 10 /100;
      if($reward<=0){
           $shipment->reward= 5;
      }else{
            $shipment->reward = $request->input('price') * 10 /100; 
      }
    
      
       $shipment->weight = 0; 
      // $shipment->photo =  $fileName ; 
      $shipment->description =$request->input('description'); 
      $shipment->save();
    } catch (\Exception $ex) {
      DB::rollback();
    return $this->returnError($ex->getCode(), $ex->getMessage());
 }

    }
    public function updateShipment( Request $request)
    {
       try {
           DB::beginTransaction();
          $validator = Validator::make($request->all(), [
                "from" => "required",                 
                "to" => "required",
                "link" => "required",
                "price" => "required|numeric",
                "name" => "required",
                
            ]);
         if ($validator->fails()) {
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code, $validator);
        }
            $shipment = Shipment::find($request->input('id'));
     
            if (!$shipment)
                return redirect()->route('admin.shipments')->with(['error' => 'This shipment doesnt exist']);



            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);

                if ($request->has('photo')) {
                    $fileName  = uploadImage('products', $request->photo); 
                    $shipment->photo =  $fileName ;  
                  // $shipment ->fill(['photo' => $$fileName]);  
                }
                   
             $shipment->user_id =$request->input('user_id'); 
             $shipment->from =$request->input('from'); 
             $shipment->to =$request->input('to');  
             $shipment->expected_date =$request->input('expected_date');  
             $shipment->category_id =$request->input('category_id');  
             $shipment->link =$request->input('link');  
             $shipment->price =$request->input('price'); 
             $shipment->name =$request->input('name');   
             $shipment->qty =$request->input('qty');  
             $shipment->description =$request->input('description'); 
             $reward = $request->input('price') * 10 /100;
             if($reward<=0){
                  $shipment->reward= 5;
             }else{
                   $shipment->reward = $request->input('price') * 10 /100; 
             }
           
             $shipment->save();
            DB::commit();
            return $this->returnSuccessMessage('shipment updated successfully');
       } catch (\Exception $ex) {
            DB::rollback();
          return $this->returnError($ex->getCode(), $ex->getMessage());
       }
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
            $shipment = Shipment::find($id);
             if (!$shipment) {
                        return $this->returnError('D000', trans('This shipment does not exist'));
             }
       

             $shipment->delete();
           return $this->returnSuccessMessage('shipment cancelled successfully');
         } catch (\Exception $ex) {
                return $this->returnError($ex->getCode(), $ex->getMessage());
         }
    }
}







