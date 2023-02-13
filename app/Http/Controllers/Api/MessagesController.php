<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
use App\Models\Message;
use App\Models\Conversation;
use DB;
use Validator;

class MessagesController extends Controller
{
    use GeneralTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->middleware('auth:api');
    }
        // $this->middleware('CheckUserToken:api');
        // $this->middleware('auth.guard:api'); 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth('api')->user()->id;

        $messages =  Message::with('sender','receiver', 'shipment','shipment.countries','shipment.countriesto')->whereIn('id', function($query) use($user_id) {
            $query->selectRaw('max(`id`)')
            ->from('messages')
            ->where('receiver_id', '=', $user_id)
            // ->orwhere('sender_id', '=', $user_id)
            ->groupBy('shipment_id');
        })->orderBy('created_at', 'desc')
        ->get();
        return $this-> returnData('messages',$messages);
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(),[            
                     "receiver_id" => "required",  
                     "message" =>"required|string|max:2000"
                ]);
            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }
            DB::beginTransaction();
            $message = new Message();
            
            if (!$request->has('is_active'))
                 $message->is_active = 0; 
             else
                 $message->is_active = 1; 
            
            $message->sender_id = auth('api')->user()->id;;    
            $message->receiver_id =$request->input('receiver_id'); 
            $message->shipment_id =$request->input('shipment_id');  
            $message->message =$request->input('message');       
            $message->save();
            DB::commit();
            return $this->returnSuccessMessage('Message sent successfully');
            }catch (\Exception $ex) {
                DB::rollback();
                return $this->returnError($ex->getCode(), $ex->getMessage());
            }
        }

    public function show($id){
        // auth('api')->user()->id;
        // $messages = Message::with('receiver','sender')->where('receiver_id',$id, 'sender_id',$user_id)->orwhere('sender_id',$id, 'receiver_id',$user_id)->orderBy('created_at', 'DESC')->get();  
        try {
        $user_id = auth('api')->user()->id;

           $messages = Message::with('receiver','sender','shipment','shipment.countries')
            ->where('receiver_id',$id)
            ->where('sender_id',$user_id)
            ->orwhere(
          function($query)use ($id,$user_id) {
          return $query
                 ->where('sender_id',$id)
                 ->Where('receiver_id',$user_id);
         })
          ->orderBy('created_at', 'DESC')
         ->get();
         return $this-> returnData('messages',$messages);

        }catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
        }
        public function update(Request $request,$id){}

        // $conversations = Conversation::with('messsage.receiver','messsage.sender','messsage')
        
        // ->with(['messsage'=>function($query) use($id, $user_id){
        //     $query->where('receiver_id',$id)
        //     ->where('sender_id',$user_id)
        //     ->orwhere(
        //         function($query)use ($id,$user_id) {
        //           return $query
        //                  ->where('sender_id',$id)
        //                  ->Where('receiver_id',$user_id);
        //          });
        //   }])->orderBy('created_at', 'desc')->get();
        
        

    //     return $conversations;
    // }




    // $messages = Message::with('receiver','sender')
    // ->where('receiver_id',$id)
    // ->where('sender_id',$user_id)
    // ->orwhere(
    //     function($query)use ($id,$user_id) {
    //       return $query
    //              ->where('sender_id',$id)
    //              ->Where('receiver_id',$user_id);
    //      })
    //      ->orderBy('created_at', 'DESC')
    //      ->get();
    //      return $this-> returnData('messages',$messages);
    //     }


        // $messages = Message::with('receiver','sender','conversations')
        // ->where('receiver_id',$id)
        // ->where('sender_id',$user_id)
        // ->orwhere(
        //     function($query)use ($id,$user_id) {
        //       return $query
        //              ->where('sender_id',$id)
        //              ->Where('receiver_id',$user_id);
        //     })
        //     ->orderBy('created_at', 'DESC')
        //     ->get();
        //       return $this-> returnData('messages',$messages);
        //     }
            //  $messages = Message::with('receiver','sender')
            //  ->where(
            //      function($query)use ($id,$user_id) {
            //        return $query
            //               ->where('receiver_id',$id)
            //               ->orWhere('receiver_id',$user_id);
            //       })
            //  // ->where('receiver_id',$id)
            //  // ->where('sender_id',$user_id)
            //  ->where(
            //      function($query)use ($id,$user_id) {
            //        return $query
            //               ->orwhere('sender_id',$id)
            //               ->orWhere('sender_id',$user_id);
            //       })
            //       ->get();
    

}