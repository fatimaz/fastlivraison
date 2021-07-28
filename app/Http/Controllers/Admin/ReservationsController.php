<?php

namespace App\Http\Controllers\Admin;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationRequest;
use App\Models\Reservation;
use App\Models\Image;
use DB;

class ReservationsController extends Controller
{

    public function index()
    {
        $reservations = Reservation::with(['user' => function($prod){
            $prod ->select('id','username');
        },'trip'=> function($trip) {
            $trip->select('id','name');
        }])->select('id', 'user_id', 'trip_id','qty')->paginate(PAGINATION_COUNT);


        return view('admin.reservations.index', compact('reservations'));
    }

    public function create()
    {
        $data = [];
        $data['users'] = User::select('id','username')->get();
        $data['trips'] = Trip::select('id','name')->get();


        return view('admin.reservations.create', $data);
    }
    public function store(Request $request)
    {

        DB::beginTransaction();

        //validation
        $reservation = Reservation::create([
            'trip_id' => $request->trip_id,
            'user_id' => $request->user_id,
            // 'special_price' => $request->special_price,
            'qty' => $request->qty,
            'code' => $request->code,
            'stars' => $request->stars,
            'is_active' => $request->is_active,
            'status' => $request->status,
        ]);

        $reservation->save();

        DB::commit();
        return redirect()->route('admin.reservations')->with(['success' => 'Reservation saved successfuly']);
    }


    public function edit($id){

        $data = [];
        $data['reservation'] = Reservation::find($id);

        if (!$data['reservation'])
            return redirect()->route('admin.reservations')->with(['error' => 'This reservation does not exist']);


        $data['users'] = User::select('id','username')->get();
        $data['trips'] = Trip::select('id','name')->get();

        return view('admin.reservations.edit', $data);
    }

    public function update($id, ReservationRequest $request)
    {
        try {
            //update DB

            DB::beginTransaction();
            $reservation = Reservation::find($id);

            if (!$reservation)
                return redirect()->route('admin.reservations')->with(['error' => 'This option does not exist']);

            $reservation->update($request->only(['trip_id','user_id','qty','code','stars']));

            // $reservation->save();
            DB::commit();
            return redirect()->route('admin.reservations')->with(['success' => 'Reservation updated successfuly']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.reservations')->with(['error' => 'There is an error please try again']);
        }

    }

public function destroy($id)
    {
        try {
            //get specific categories and its translations
            $reservation = Reservation::find($id);

            if (!$reservation)
                return redirect()->route('admin.reservations')->with(['error' => 'This trip doesnt exist']);

            $reservation->delete();

            return redirect()->route('admin.reservations')->with(['success' => 'Reservation deleted successfuly']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.reservations')->with(['error' => 'There is an error please try again']);
        }
    }


}