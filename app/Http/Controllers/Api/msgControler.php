<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
use App\Models\Message;
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
 //$this->middleware('auth:api', ['except' => ['show']]);
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

        $messages =  Message::with('sender','receiver')->whereIn('id', function($query) use($user_id) {
            $query->selectRaw('max(`id`)')
            ->from('messages')
            ->where('receiver_id', '=', $user_id)
            ->groupBy('sender_id');
        })->orderBy('created_at', 'desc')
        ->get();
        return $this-> returnData('messages',$messages);
    }
        // $messages = DB::select('
        //     SELECT * 
        //     FROM messages AS t1

        //     JOIN users uc ON t1.sender_id=uc.id      
        //     JOIN users uc1 ON t1.receiver_id=uc1.id
            
        //     INNER JOIN
        //     (
        //         SELECT
        //             LEAST(sender_id, receiver_id) AS sender_id,
        //             GREATEST(sender_id, receiver_id) AS receiver_id,
        //             MAX(id) AS max_id
        //         FROM messages
        //         GROUP BY
        //             LEAST(sender_id, receiver_id),
        //             GREATEST(sender_id, receiver_id)
        //     ) AS t2
        //         ON LEAST(t1.sender_id, t1.receiver_id) = t2.sender_id AND
        //            GREATEST(t1.sender_id, t1.receiver_id) = t2.receiver_id AND
        //            t1.id = t2.max_id
        //         WHERE t1.sender_id = ? OR t1.receiver_id = ?
        //     ', [$id, $id]);


        // $messages = Message::whereIn('id', function($query) use ($user_id) {
        //     $query->selectRaw('max(`id`)')
        //     ->from('messages')
        //     ->where('receiver_id', '=', $user_id)
        //     ->groupBy('sender_id');
        // })->select('sender_id', 'message', 'created_at')
        // ->orderBy('created_at', 'desc')
        // ->get();

        // $messages = Message::select(DB::raw('*, max(created_at) as created_at'))
        //     ->with('receiver','sender')
          
        //     ->Where('sender_id',$user_id)
        //     ->orderBy('created_at', 'desc')
        //     ->groupBy('receiver_id')

        //     ->get();

        // $messages = Message::with('receiver','sender')
        // ->where('receiver_id',$user_id)
        
        // ->where(
        //     function($query)use ($user_id) {
        //       return $query
        //              ->where('receiver_id',$user_id);
                    
        //      })
        // ->orwhere(
        //     function($query)use ($user_id) {
        //       return $query
        //              ->where('sender_id',$user_id);
                     
        //      })
        //      ->groupBy('sender_id')
        //      ->latest('created_at')
        //      ->get();

        // $messages = Message::with('receiver','sender')
        // ->where('receiver_id',$user_id)
        // ->orwhere('sender_id',$user_id)
        // ->orderBy('created_at', 'DESC')
        // ->groupBy('sender_id')
        // ->get();
        // $messages = Message::with('receiver','sender')->where('receiver_id',$user_id)->orderBy('created_at', 'DESC')->first();
        // $messages = Message::with('receiver','sender')->where('receiver_id',$user_id)->orderBy('created_at', 'DESC')->get();

    public function showUserMessages()
    
    {
        $user_id=80;
        $messages = Message::with('receiver','sender')
           ->where('receiver_id',$user_id)
          ->orwhere('sender_id',$user_id)
           ->orderBy('created_at', 'DESC')
           ->groupBy('shipment_id')
           ->get();
           return  $messages ;
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
             $message->message =$request->input('message');  
           
             $message->save();
             DB::commit();
             return $this->returnSuccessMessage('Message sent successfully');
            } catch (\Exception $ex) {
                     DB::rollback();
                    return $this->returnError($ex->getCode(), $ex->getMessage());
            }
        }

    public function show($id){
        $user_id = 80;
        // auth('api')->user()->id;
        // $messages = Message::with('receiver','sender')->where('receiver_id',$id, 'sender_id',$user_id)->orwhere('sender_id',$id, 'receiver_id',$user_id)->orderBy('created_at', 'DESC')->get();
         
        $messages = Message::with('receiver','sender')
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
            }

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
        
        


    public function update(Request $request,$id)
    {}
}