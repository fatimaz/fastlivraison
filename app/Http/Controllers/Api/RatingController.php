<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Trip;
use App\Models\Link;
use App\Models\Driver;
use App\Traits\GeneralTrait;
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
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
//    public function store(Request $request)
//    {
//        $rating = new Rating();
//        $rating->user_id = 1;
//        $rating->tutor_id = $request->input('tutor_id');
//        $rating->stars = $request->input('stars');
//        $rating->review = $request->input('review');
//        $rating->rated = $request->input('rated');
//      //  $booking->user_id = auth('api')->user()->id;
//        $rating->save();
//        return response()->json([
//            'success' => true,
//            'message' => 'saved'
//        ]);
//    }
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {}
//        $ratings = DB::table('ratings')
//           ->where('tutor_id','=', $id)
//           ->join('tutors', 'ratings.tutor_id', '=', 'tutors.id')
//            ->join('users', 'ratings.user_id', '=', 'users.id')
//            ->select('ratings.*', 'tutors.firstname','tutors.lastname', 'users.firstname')
//           ->where('ratings.rated', 1)
//            ->where('ratings.status', 1)
//            ->get();
//
//        return response()->json([
//            'success' => true,
//            'message' => 'booking',
//            'ratings' => $ratings,
//        ]);
//

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
      try {
        DB::beginTransaction();

        $reservation = Reservation::find($id);

        if($reservation) {
            $reservation->stars = $request->input('stars');
            $reservation->save();

        }
         $trip = Trip::find($reservation->trip_id);


        $driver = Driver::where('id',$trip->driver_id)->first();
         


        $totalstars = Reservation::where('trip_id',$trip->id)->active()->where('status',1)->avg('stars');


        $numRating = Reservation::where('trip_id',$trip->id)->active()->->where('status',1)->where('stars','!=', 0)->count();
    

        $driver->totalstars = $totalstars;
        $driver->numRating = $numRating;
        $driver->save();
        DB::commit();
         return $this->returnSuccessMessage('Note enregistrée avec succès');
          } catch (\Exception $ex) {
                 DB::rollback();
                return $this->returnError($ex->getCode(), $ex->getMessage());
          }
    }
     
}


