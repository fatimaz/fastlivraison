<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PrescriptionRequest;
use App\Models\Prescription;
use Illuminate\Http\Request;
use App\Models\User;
use DB;


class PrescriptionsController extends Controller
{
    public function index()
    {
        $prescriptions = Prescription::orderBy('id', 'DESC')->paginate(PAGINATION_COUNT);
        return view('admin.prescriptions.index', compact('prescriptions'));
    }

    public function create()
    {
        $users = User::select('id','name')->get();
        return view('admin.prescriptions.create',compact('users'));
    }


    public function store(PrescriptionRequest $request)
    {
       DB::beginTransaction();
        $prescription = Prescription::create([
            'user_id' => $request -> user_id,
            'about' => $request -> about,
        ]);

        DB::commit();
        return redirect()->route('admin.prescriptions')->with(['success' => 'prescription added successfuly']);
    }

    public function edit($id)
    { 
        $data['prescription'] = Prescription::find($id);
        $data['users'] = User::select('id','name')->get();

        if (!$data['prescription'] )
            return redirect()->route('admin.prescriptions')->with(['error' => 'This prescription doesnt exist']);
        return view('admin.prescriptions.edit', $data);
    }
    
    public function update($id, PrescriptionRequest  $request)
    {
      try {
            $prescription = Prescription::find($id);

            if (!$prescription)
                return redirect()->route('admin.prescriptions')->with(['error' => 'This prescription doesnt exist']);
            DB::beginTransaction();
            $prescription->update($request->except('_token', 'id', 'is_active'));  // update only for slug column
            DB::commit();
            return redirect()->route('admin.prescriptions')->with(['success' => 'Prescription updated successfuly']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.prescriptions')->with(['error' => 'There is an error please try again ']);
        }
    }


    public function destroy($id)
    {
        try {
            $prescription = Prescription::find($id);

            if (!$prescription)
                return redirect()->route('admin.prescriptions')->with(['error' => 'This prescription doesnt exist']);
            $prescription->delete();
            return redirect()->route('admin.prescriptions')->with(['success' => 'prescription deleted successfuly']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.prescriptions')->with(['error' => 'There is an error please try again']);
        }
    }
 

}
