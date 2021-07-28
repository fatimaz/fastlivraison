<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShipmentRequest;
use App\Models\Shipment;
use App\Models\User;
use App\Models\Category;
use App\Models\Country;

use DB;
use Illuminate\Http\Request;

class ShipmentsController extends Controller
{

    public function index()
    {
        $shipments = Shipment::with('user','category')->orderBy('id', 'DESC')->paginate(PAGINATION_COUNT);
        return view('admin.shipments.index', compact('shipments'));
    }

    public function create()
    { 
        $data['users'] = User::get();
        $data['categories'] = Category::get();
        $data['countries'] = Country::get();
        return view('admin.shipments.create',$data);
    }


    public function store(ShipmentRequest $request)
    {
        DB::beginTransaction();

        //validation
        if (!$request->has('is_active'))
            $request->request->add(['is_active' => 0]);
        else
            $request->request->add(['is_active' => 1]);

        $shipment = Shipment::create($request->except('_token')); 

        // $shipment->save();
        DB::commit();
        return redirect()->route('admin.shipments')->with(['success' => 'Shipment added successfuly']);
        
    }


    public function edit($id)
    {
        //get specific categories and its translations
        $data= [];
        $data['shipment'] = Shipment::find($id);
        $data['users'] = User::get();
        $data['categories'] = Category::get();
         $data['countries'] = Country::get();


        if (!$data['shipment'])
            return redirect()->route('admin.shipments')->with(['error' => 'This shipment doesnt exist']);

        return view('admin.shipments.edit', $data);

    }


    public function update($id, ShipmentRequest $request)
    {
        try {
            //validation

            //update DB
            $shipment = Shipment::find($id);

            if (!$shipment)
                return redirect()->route('admin.shipments')->with(['error' => 'This shipment doesnt exist']);


            DB::beginTransaction();

            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);

            $shipment->update($request->except('_token', 'id'));

            // $trip->save();

            DB::commit();
            return redirect()->route('admin.shipments')->with(['success' => 'Shipment updated successfuly']);

        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.shipments')->with(['error' => 'There is an error please try again']);
        }
    }


    public function destroy($id)
    {
        try {
            //get specific categories and its translations
            $shipment = Shipment::find($id);

            if (!$shipment)
                return redirect()->route('admin.shipments')->with(['error' => 'This shipment doesnt exist']);

            $shipment->delete();

            return redirect()->route('admin.shipments')->with(['success' => 'Trip deleted successfuly']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.shipments')->with(['error' => 'There is an error please try again']);
        }
    }

}
