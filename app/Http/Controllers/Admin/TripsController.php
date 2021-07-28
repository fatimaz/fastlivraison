<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TripRequest;
use App\Models\Trip;
use App\Models\User;
use App\Models\Category;
use App\Models\Country;

use DB;
use Illuminate\Http\Request;

class TripsController extends Controller
{

    public function index()
    {
        $trips = Trip::with('user','category')->orderBy('id', 'DESC')->paginate(PAGINATION_COUNT);
        return view('admin.trips.index', compact('trips'));
    }

    public function create()
    {
     
        $data['users'] = User::get();
        $data['categories'] = Category::get();
        $data['countries'] = Country::get();
        return view('admin.trips.create',$data);
    }


    public function store(TripRequest $request)
    {

        DB::beginTransaction();

        //validation
        if (!$request->has('is_active'))
            $request->request->add(['is_active' => 0]);
        else
            $request->request->add(['is_active' => 1]);

        
        $trip = Trip::create($request->except('_token'));
        
        DB::commit();
        return redirect()->route('admin.trips')->with(['success' => 'Trip added successfuly']);
        
    }


    public function edit($id)
    {
        //get specific categories and its translations
        $data= [];
        $data['trip'] = Trip::find($id);
        $data['users'] = User::get();
        $data['categories'] = Category::get();
        $data['countries'] = Country::get();

        if (!$data['trip'])
            return redirect()->route('admin.trips')->with(['error' => 'This trip doesnt exist']);

        return view('admin.trips.edit', $data);

    }


    public function update($id, TripRequest $request)
    {
        try {
            //validation

            //update DB
            $trip = Trip::find($id);

            if (!$trip)
                return redirect()->route('admin.trips')->with(['error' => 'This trip doesnt exist']);


            DB::beginTransaction();

            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);

            $trip->update($request->except('_token', 'id'));

            // $trip->save();

            DB::commit();
            return redirect()->route('admin.trips')->with(['success' => 'Trip updated successfuly']);

        } catch (\Exception $ex) {

            DB::rollback();
            return redirect()->route('admin.trips')->with(['error' => 'There is an error please try again']);
        }
    }


    public function destroy($id)
    {
        try {
            //get specific categories and its translations
            $trip = Trip::find($id);

            if (!$trip)
                return redirect()->route('admin.trips')->with(['error' => 'This trip doesnt exist']);

            $trip->delete();

            return redirect()->route('admin.trips')->with(['success' => 'Trip deleted successfuly']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.trips')->with(['error' => 'There is an error please try again']);
        }
    }

}
