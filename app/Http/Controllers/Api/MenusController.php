<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Offer;
use App\Models\Trip;
use App\Models\Category;
use App\Models\Menu;
use App\Models\User;
use App\Traits\GeneralTrait;
use Validator;
use DB;

class MenusController extends Controller
{
     use GeneralTrait;
    /**
     * Create a new controller instance.
     *
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
        $menus = Category::with('items','items.attributes', 'items.attributes.options')->get();
        return $this-> returnData('menus',$menus);
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

        $validator = Validator::make($request->all(), [
                "from_id" => "required",                 
                "to_id" => "required",  
                "weight_total" =>"required"
            ]);
         if ($validator->fails()) {
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code, $validator);
        }
        DB::beginTransaction();
        $trip = new Trip();
        if (!$request->has('is_active'))
             $trip->is_active = 0; 
         else
              $trip->is_active = 1; 

        
        $trip->user_id = auth('api')->user()->id;    
         $trip->from =$request->input('from_id');  
         $trip->to = $request->input('to_id');  
         $trip->travel_date =$request->input('travel_date');  
         $trip->weight_total =$request->input('weight_total'); 
         // $trip->name ="trip"+$request->input('to_id');    
        //  $trip->weight_free =$request->input('weight_free');  
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







