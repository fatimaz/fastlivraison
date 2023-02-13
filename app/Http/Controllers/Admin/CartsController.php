<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CartRequest;
use App\Models\Cart;
use App\Models\User;
use DB;
use Illuminate\Http\Request;

class CartsController extends Controller
{
    public function index()
    {
        $carts = Cart::orderBy('id', 'DESC')->paginate(PAGINATION_COUNT);
        return view('admin.carts.index', compact('carts'));
    }

    public function create()
    {
        $users = User::select('id','name')->get();
        return view('admin.carts.create',compact('users'));
    }


    public function store(CartRequest $request)
    {
       DB::beginTransaction();
        $cart = Cart::create([
            'user_id' => $request -> user_id,
            'price' => $request -> price]);

        DB::commit();
        return redirect()->route('admin.carts')->with(['success' => 'cart added successfuly']);
    }

    public function edit($id)
    { 
        $data['cart'] = Cart::find($id);
        $data['users'] = User::select('id','name')->get();

        if (!$data['cart'] )
            return redirect()->route('admin.carts')->with(['error' => 'This cart doesnt exist']);
        return view('admin.carts.edit', $data);

    }


    public function update($id, CartRequest  $request)
    {
        try {
            $cart = Cart::find($id);

            if (!$cart)
                return redirect()->route('admin.carts')->with(['error' => 'This cart doesnt exist']);


            DB::beginTransaction();

            $cart->update($request->except('_token', 'id'));  // update only for slug column

            DB::commit();
            return redirect()->route('admin.carts')->with(['success' => 'cart updated successfuly']);

        } catch (\Exception $ex) {

            DB::rollback();
            return redirect()->route('admin.carts')->with(['error' => 'There is an error please try again ']);
        }
    }


    public function destroy($id)
    {
        try {
            $cart = Cart::find($id);

            if (!$cart)
                return redirect()->route('admin.carts')->with(['error' => 'This cart doesnt exist']);

            $cart->delete();

            return redirect()->route('admin.carts')->with(['success' => 'Cart deleted successfuly']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.carts')->with(['error' => 'There is an error please try again']);
        }
    }
 

}
