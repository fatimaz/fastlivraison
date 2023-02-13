<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeRequest;
use App\Models\Attribute;
use App\Models\Menu;
use DB;
use Illuminate\Http\Request;

class AttributesController extends Controller
{

    public function index()
    {
        $attributes = Attribute::orderBy('id', 'DESC')->paginate(PAGINATION_COUNT);
        return view('admin.attributes.index', compact('attributes'));
    }

    public function create()
    {
        $menus = Menu::get();
        return view('admin.attributes.create', compact('menus'));
    }


    public function store(AttributeRequest $request)
    {

        DB::beginTransaction();

        $attribute = Attribute::create([

            'name' => $request -> name,
            'min' => $request -> min,
            'max' => $request -> max,
            'menu_id' => $request -> menu_id
        ]);

        DB::commit();
        return redirect()->route('admin.attributes')->with(['success' => 'Attribute added successfuly']);

    }


    public function edit($id)
    {
        $data['attribute'] = Attribute::find($id);

        $data['menus'] = Menu::get();

        if (!$data['attribute'])
            return redirect()->route('admin.attributes')->with(['error' => 'This attribute does not exist']);

        return view('admin.attributes.edit', $data);

    }


    public function update($id, AttributeRequest $request)
    {
        try {

            $attribute = Attribute::find($id);

            if (!$attribute)
                return redirect()->route('admin.attributes')->with(['error' => 'This attribute does not exist']);

            DB::beginTransaction();
            $attribute->name = $request->name;
            $attribute->save();

            DB::commit();
            return redirect()->route('admin.attributes')->with(['success' => 'Attribute updated successfuly']);

        } catch (\Exception $ex) {

            DB::rollback();
            return redirect()->route('admin.attributes')->with(['error' => 'There is an error please try again']);
        }

    }


    public function destroy($id)
    {
        try {
            $attribute = Attribute::find($id);

            if (!$attribute)
                return redirect()->route('admin.attributes')->with(['error' => 'This attribute does not exist']);

            $attribute->delete();
            $attribute->deleteTranslations();

            return redirect()->route('admin.attributes')->with(['success' => 'Attribute deleted successfuly']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.attributes')->with(['error' => 'There is an error please try again']);
        }
    }

}