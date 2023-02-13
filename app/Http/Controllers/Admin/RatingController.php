<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RatingRequest;
use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\Offer;
use App\Models\User;
use DB;

class RatingController extends Controller
{
    public function index()
    {
        $ratings = Rating::with('sender','receiver','offer')->orderBy('id', 'DESC')->paginate(PAGINATION_COUNT);
        return view('admin.ratings.index', compact('ratings'));
    }

    public function show($id)
    { 
        $rating = Rating::with('sender','receiver','offer')->first();
        return view('admin.ratings.show', compact('rating'));
    }


    public function create()
    {
        $data['users'] = User::get();
        $data['orders'] = Offer::get();
        return view('admin.ratings.create',$data);
    }

    public function store(RatingRequest $request)
    {
     try {
        DB::beginTransaction();

        if (!$request->has('is_active'))
          $request->request->add(['is_active' => 0]);
        else
          $request->request->add(['is_active' => 1]);

        if (!$request->has('rated'))
          $request->request->add(['rated' => 0]);
       else
          $request->request->add(['rated' => 1]);

        $rating = Rating::create([
            'sender_id' => $request -> sender_id,
            'receiver_id' => $request -> receiver_id,
            'order_id' => $request -> order_id,
            'type' => $request -> type,
            'stars' => $request -> stars,
            'review' => $request -> review,
            'is_active' =>  $request -> is_active,
            'rated' =>  $request -> rated,
        ]);

        $rating->save();
        DB::commit();
        return redirect()->route('admin.ratings')->with(['success' => 'Rating added successfuly']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.ratings')->with(['error' => 'There is an error please try again ']);
        }  
    }

    public function edit($id)
    {
        $data['rating'] = Rating::find($id);
        $data['users'] =  User::get();
        $data['orders'] = Offer::get();

        if (!$data['rating'])
            return redirect()->route('admin.ratings')->with(['error' => 'This ratings doesnt exist']);

        return view('admin.ratings.edit', $data);
    }

    public function update($id, RatingRequest  $request)
    {
        try {

            DB::beginTransaction();
            $rating = Rating::find($id);


            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
             else
                $request->request->add(['is_active' => 1]);


                if (!$request->has('rated'))
                $request->request->add(['rated' => 0]);
             else
                $request->request->add(['rated' => 1]);



            if (!$rating)
                return redirect()->route('admin.ratings')->with(['error' => 'This rating doesnt exist']); 
        
            $rating->update($request->except('_token', 'id')); 

            DB::commit();
            return redirect()->route('admin.ratings')->with(['success' => 'rating updated successfuly']);

        } catch (\Exception $ex) {

            DB::rollback();
            return redirect()->route('admin.ratings')->with(['error' => 'There is an error please try again ']);
        }
    }
    public function destroy($id)
    {
        try {
            $rating = Rating::find($id);
            if (!$rating)
                return redirect()->route('admin.ratings')->with(['error' => 'This rating doesnt exist']);

            $rating->delete();
            return redirect()->route('admin.ratings')->with(['success' => 'rating deleted successfuly']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.ratings')->with(['error' => 'There is an error please try again']);
        }
    }
}
