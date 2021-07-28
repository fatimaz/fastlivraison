<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CountryRequest;

use App\Models\Country;
use DB;
use Illuminate\Http\Request;

class CountriesController extends Controller
{
    public function index()
    {
        $countries = Country::orderBy('id', 'DESC')->paginate(PAGINATION_COUNT);
        return view('admin.countries.index', compact('countries'));
    }

    public function create()
    {
        return view('admin.countries.create');
    }


    public function store(CountryRequest $request)
    {

        DB::beginTransaction();

        //validation
        //another way of saving
        $country = Country::create(['name' => $request -> name]);

        DB::commit();
        return redirect()->route('admin.countries')->with(['success' => 'Country added successfuly']);
    }

    public function edit($id)
    {
        //get specific categories and its translations
        $country = Country::find($id);

        if (!$country)
            return redirect()->route('admin.countries')->with(['error' => 'This country doesnt exist']);

        return view('admin.countries.edit', compact('country'));

    }


    public function update($id, CountryRequest  $request)
    {
        try {

            $country = Country::find($id);

            if (!$country)
                return redirect()->route('admin.countries')->with(['error' => 'This country doesnt exist']);


            DB::beginTransaction();


            $country->update($request->except('_token', 'id'));  // update only for slug column

          

            DB::commit();
            return redirect()->route('admin.countries')->with(['success' => 'country updated successfuly']);

        } catch (\Exception $ex) {

            DB::rollback();
            return redirect()->route('admin.countries')->with(['error' => 'There is an error please try again ']);
        }
    }


    public function destroy($id)
    {
        try {
            //get specific categories and its translations
            $country = Country::find($id);

            if (!$country)
                return redirect()->route('admin.countries')->with(['error' => 'This country doesnt exist']);

            $country->delete();

            return redirect()->route('admin.countries')->with(['success' => 'country deleted successfuly']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.countries')->with(['error' => 'There is an error please try again']);
        }
    }
 

}
