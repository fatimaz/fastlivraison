<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Offer;
use App\Models\Country;
use App\Models\Trip;
use App\Models\User;
use App\Traits\GeneralTrait;
use Validator;

use DB;

class OffersController extends Controller
{
     use GeneralTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      // $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      // try {
      //     $offers = Offer::with('user','shipment','shipment.countries','shipment.countriesto','trip','trip.countries','trip.countriesto')
      //     ->where('shipment_id',181)
      //     ->Where('type','!=',"rejected")->get();
      //     // $offerscount = Offer::with('user','shipment','trip','trip.countries','trip.countriesto')
      //     // ->where('shipment_id',180)
      //     // ->where('type','pending')
      //     // ->get();
      //     return $this-> returnData('offers',$offers);
      //   } catch (\Exception $ex) {
      //       return $this->returnError($ex->getCode(), $ex->getMessage());
      //   }
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
        $offer = new Offer();
        if (!$request->has('is_active'))
             $offer->is_active = 0; 
        else
            $offer->is_active = 1; 

          $offerS = Offer::where('shipment_id',$request->input('shipment_id'))
                ->where('user_id',$request->input('user_id'))
                ->where('type','!=','rejected')
                ->first();
          if($offerS){
            return $this->returnError('D000', 'Vous avez deja envoyé une offre pour cette article');
          }

         $offer->user_id = $request->input('user_id');  
         $offer->shipment_id =$request->input('shipment_id'); 
         $offer->trip_id =$request->input('trip_id'); 
         $offer->reward =$request->input('reward');  
         $offer->message =$request->input('message');  
         $offer->save();

         $user = User::where('id', $offer->user_id)->first();
         if($offer->type != 'rejected'){
          if( $offer->user_id == 2){
              $user->offers_sent =   $user->offers_sent+1;
          }else{
            $user->offers_received = $user->offers_received+1;
          }
        }
           $user->save();
          DB::commit();
          return $this->returnSuccessMessage('offer saved successfully');
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
    public function show($trip_id)
    {
      try {
         
        $deals = Offer::with('user','shipment','shipment.countries','shipment.countriesto','trip','trip.countries','trip.countriesto','shipment.user','user.shipments','user.trips','user.offers', 'shipment.user.shipments','shipment.user.trips')
         ->where('trip_id', $trip_id)
        ->Where('type','!=',"rejected")->get();
         return $this-> returnData('deals',$deals);
      } catch (\Exception $ex) {
          return $this->returnError($ex->getCode(), $ex->getMessage());
      }
    }
      // try {
      //     $offers = Offer::with('user','shipment','shipment.countries','shipment.countriesto','trip','trip.countries','trip.countriesto')
      //     ->where('shipment_id',$id)
      //     ->Where('type','!=',"rejected")->get();
      //     // $offerscount = Offer::with('user','shipment','trip','trip.countries','trip.countriesto')
      //     // ->where('shipment_id',180)
      //     // ->where('type','pending')
      //     // ->get();
      //     return $this-> returnData('offers',$offers);
      //   } catch (\Exception $ex) {
      //       return $this->returnError($ex->getCode(), $ex->getMessage());
      //   }
 
 
    public function update($id, Request $request)
    {
       try {

            $offer = Offer::find($id);

             if (!$offer) {
                        return $this->returnError('D000', trans('This Offer does not exist'));
             }
             $shipment_id = $offer->shipment_id;
             $user =$offer->user_id;
            
             $offer->type = $request->input('type');
             if ($request->input('type') == 0){
              $offer->type = 'rejected';
            }else if ($request->input('type') == 1){
              $offer->type = 'accepted';
              $offerCancel = Offer::where('shipment_id',181 )->where('user_id','!=',$user)->update(['type' => 'rejected']);        
             }else if ($request->input('type') == 2){
              $offer->type = 'delivered';
             }

             if ($request->input('type') == 3){
              $offer->livraison = 1;
             }
        
            $offer->save();

           return $this->returnSuccessMessage('Offer saved successfully');
         } catch (\Exception $ex) {
                return $this->returnError($ex->getCode(), $ex->getMessage());
         }
    }

    public function updateOffer($id, Request $request)
    {

      try {
        $validator = Validator::make($request->all(), [
          "reward" =>"required"
      ]);
        if ($validator->fails()) {
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code, $validator);
        }
        $offer = Offer::find($id);
        DB::beginTransaction();

          if (!$request->has('is_active'))
              $request->request->add(['is_active' => 0]);
          else
              $request->request->add(['is_active' => 1]);

          $offer->update($request->except('_token', 'id'));

          DB::commit();
        return $this->returnSuccessMessage('offer updated successfully');
      } catch (\Exception $ex) {
         DB::rollback();
        return $this->returnError($ex->getCode(), $ex->getMessage());
      }
    }

}







