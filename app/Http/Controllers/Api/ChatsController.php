<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Chat;
use App\Models\User;
use App\Traits\GeneralTrait;
use Validator;
use DB;

class ChatsController extends Controller
{
     use GeneralTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      try {
          $chats = Chat::with('user')->get();
          return $this-> returnData('chats',$chats);
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
        // $validator = Validator::make($request->all(), [
        //      "user" => "required",                 
        //      "to" => "required",
        //      "reservation_number" => "required",    
        //     ]);
        //  if ($validator->fails()) {
        //     $code = $this->returnCodeAccordingToInput($validator);
        //     return $this->returnValidationError($code, $validator);
        // }
        $chat = new Chat();

         $chat->user_id =1; 
        // auth('api')->user()->id;    
         $chat->text =$request->input('text');  
        //  $trip->to =$request->input('to');  
          $chat->save();

         DB::commit();
         return $this->returnSuccessMessage('Chat saved successfully');
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







