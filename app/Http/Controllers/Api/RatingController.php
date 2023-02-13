<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
use App\Models\Rating;
use App\Models\User;
use App\Models\Offer;
use DB;

class RatingController extends Controller
{
    use GeneralTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => [ 'show']]);
        //  $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = auth('api')->user()->id;
        $ratings = Rating::with('receiver')->where('receiver_id',$id)->get();
        return $this-> returnData('ratings',$ratings);
    }

    public function getReceived()
    {
        $id = auth('api')->user()->id;
        $ratings = Rating::with('sender')->where('receiver_id',$id)->get();
        return $this-> returnData('ratings',$ratings);
    }
    public function getGiven()
    {
        $id = auth('api')->user()->id;
        $ratings = Rating::with('receiver')->where('sender_id',$id)->get();
        return $this-> returnData('ratings',$ratings);
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
       $rating = new Rating();
       if (!$request->has('is_active'))
              $rating->is_active = 0; 
        else
              $rating->is_active = 1; 

       $rating->sender_id = auth('api')->user()->id;
       $rating->receiver_id = $request->input('receiver_id');
       $rating->order_id = $request->input('order_id');
       $rating->stars = $request->input('stars');
       $rating->review = $request->input('review');
       $rating->save();
        $user = User::find($rating->receiver_id);
        $offer = Offer::find($rating->order_id);
        $offer->rated= 1;
        $offer->save();
        $avgstars = $rating->where('receiver_id',$user->id)->avg('stars');
        $numRating = Rating::where('receiver_id',$user->id)->where('stars','!=', 0)->count();
        $user->avgstars = $avgstars;
        $user->numRating = $numRating;
        $user->save();
       DB::commit();
         return $this->returnSuccessMessage('Rating saved successfully');
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
    public function show($id){
        $ratings = Rating::with('sender')->where('receiver_id',$id)->get();
        return $this-> returnData('ratings',$ratings);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {}
          // try {
        //     DB::beginTransaction();
        //     $offer = new Offer();
        //     if (!$request->has('is_active'))
        //          $offer->is_active = 0; 
        //      else
        //           $offer->is_active = 1; 
        //           $offer->sender_id = 81;    
        //           $offer->receiver_id =$request->input('receiver_id');  
        //           $offer->order_id= $request->input('order_id');  
        //           $offer->stars =$request->input('stars');  
        //           $offer->review =$request->input('review'); 
              
        //           $offer->save();
        // $user = User::find($offre->user_id);
        // $totalstars = $offre->where('user_id',$user->id)->avg('stars');
        // $numRating = Offre::where('user_id',$user->id)->where('stars','!=', 0)->count();
        // $user->avgstars = $avgstars;
        // $user->numRating = $numRating;
        // $user->save();
        // DB::commit();
        //  return $this->returnSuccessMessage('Offer saved successfully');
        // } catch (\Exception $ex) {
        //      DB::rollback();
        //      return $this->returnError($ex->getCode(), $ex->getMessage());
        // }
   
}