<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddressRequest;
use App\Models\Address;
use App\Models\User;
use DB;

class AddressesController extends Controller
{
    public function index()
    {
        $addresses = Address::with('users')->orderBy('id', 'DESC')->paginate(PAGINATION_COUNT);

        return view('admin.addresses.index', compact('addresses'));
    }

    public function create()
    {
        $users = User::select('id','name')->get();
        return view('admin.addresses.create',compact('users'));
    }

    public function store(AddressRequest $request)
    {
        DB::beginTransaction();

        //validation
        //another way of saving
        $tag = Address::create(
            ['name' => $request -> name,
             'value' => $request -> value]);

        $tag->save();
        DB::commit();
        return redirect()->route('admin.addresses')->with(['success' => 'Address added successfuly']);
    }


    public function edit($id)
    {
        $data= [];
        $data['address'] = Address::find($id);
        $data['users'] = User::select('id','name')->get();

        if (! $data['address'])
            return redirect()->route('admin.addresses')->with(['error' => 'This address doesnt exist']);

        return view('admin.addresses.edit', $data);
    }


    public function update($id, AddressRequest  $request)
    {
        try {
            //validation
            //update DB
            $address = Address::find($id);

            if (!$address)
                return redirect()->route('admin.addresses')->with(['error' => 'This address doesnt exist']);


            DB::beginTransaction();
            $address->update($request->except('_token', 'id'));  // update only for slug column
            $address->save();

            DB::commit();
            return redirect()->route('admin.addresses')->with(['success' => 'Address updated successfuly']);

        } catch (\Exception $ex) {

            DB::rollback();
            return redirect()->route('admin.addresses')->with(['error' => 'There is an error please try again ']);
        }
    }


    public function destroy($id)
    {
        try {
            //get specific categories and its translations
            $addresses = Address::find($id);

            if (!$addresses)
                return redirect()->route('admin.addresses')->with(['error' => 'This address doesnt exist']);

            $addresses->delete();
            return redirect()->route('admin.addresses')->with(['success' => 'Address deleted successfuly']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.addresses')->with(['error' => 'There is an error please try again']);
        }
    }

}
