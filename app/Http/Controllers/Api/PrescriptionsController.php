<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Offer;
use App\Models\Image;
use App\Models\Prescription;
use App\Models\User;
use App\Traits\GeneralTrait;
use Validator;
use DB;

class PrescriptionsController extends Controller
{
     use GeneralTrait;
    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct(){
      // $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $orders = Prescription::with('images')->get();
        return $this-> returnData('orders',$orders);
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
        // $validator = Validator::make($request->all(), [
        // ]);
        //  if ($validator->fails()) {
        //     $code = $this->returnCodeAccordingToInput($validator);
        //     return $this->returnValidationError($code, $validator);
        // }
        DB::beginTransaction();
        $prescription = new Prescription();
        // if (!$request->has('is_active'))
        //   $prescription->is_active = 0; 
        //  else
        //    $prescription->is_active = 1; 

        $prescription->user_id = 80;
        //auth('api')->user()->id;    
        $prescription->about ='sdsd';  
        $prescription->save();
        $fileName = "";
        if ($request->has('photo')  && count($request->photo) > 0) {
         foreach ($request->photo as $image) {
           $fileName  = uploadImage('products', $image);  
           $prescription->images()->create([
             'name' => $fileName,
             'prescription_id' => $prescription->id
           ]);
         } 
        }  
     
        DB::commit();
        return $this->returnSuccessMessage('Precription saved successfully');
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
    public function show($id)
    {}
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        try {
          $validator = Validator::make($request->all(), [
            "weight_total" =>"required"
        ]);
          if ($validator->fails()) {
              $code = $this->returnCodeAccordingToInput($validator);
              return $this->returnValidationError($code, $validator);
          }

            $trip = Trip::find($id);

            if (!$trip)
            return $this->returnError('no trip available');
            DB::beginTransaction();

            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);

            $trip->update($request->except('_token', 'id'));

            DB::commit();
          return $this->returnSuccessMessage('Trip updated successfully');
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
            $trip = Trip::find($id);
             if (!$trip) {
                return $this->returnError('D000', trans('This trip does not exist'));
             }
             $trip->delete();
           return $this->returnSuccessMessage('Trip deleted successfully');
         } catch (\Exception $ex) {
                return $this->returnError($ex->getCode(), $ex->getMessage());
         }
    }

}







