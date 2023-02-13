<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImageRequest;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Models\Prescription;
use DB;


class ImagesController extends Controller
{
    public function index()
    {
        $images = Image::orderBy('id', 'DESC')->paginate(PAGINATION_COUNT);
        return view('admin.images.index', compact('images'));
    }
    public function create()
    {
        $prescriptions = Prescription::select('id')->get();
        return view('admin.images.create',compact('prescriptions'));
    }
    public function store(ImageRequest $request)
    {
       DB::beginTransaction();
        $image = Image::create([
            'prescription_id' => $request -> prescription_id,
            'name' => $request -> name,
        ]);

        DB::commit();
        return redirect()->route('admin.images')->with(['success' => 'image added successfuly']);
    }

    public function edit($id)
    { 
        $data['image'] = Image::find($id);
         $data['prescriptions'] = Prescription::select('id')->get();

        if (!$data['image'] )
            return redirect()->route('admin.images')->with(['error' => 'This image doesnt exist']);
        return view('admin.images.edit', $data);
    }
    
    public function update($id, ImageRequest  $request)
    {
        try {
            $image = Image::find($id);

            if (!$image)
                return redirect()->route('admin.images')->with(['error' => 'This prescription doesnt exist']);
            DB::beginTransaction();
            $image->update($request->except('_token', 'id'));  // update only for slug column
            DB::commit();
            return redirect()->route('admin.images')->with(['success' => 'image updated successfuly']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.images')->with(['error' => 'There is an error please try again ']);
        }
    }
    public function destroy($id)
    {
        try {
            $image = Image::find($id);

            if (!$image)
                return redirect()->route('admin.images')->with(['error' => 'This image doesnt exist']);
            $image->delete();
            return redirect()->route('admin.images')->with(['success' => 'image deleted successfuly']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.images')->with(['error' => 'There is an error please try again']);
        }
    }
}
