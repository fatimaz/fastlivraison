<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\User;
use DB;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('id', 'DESC')->paginate(PAGINATION_COUNT);
        return view('admin.orders.index', compact('orders'));
    }

    public function create()
    {
        $users = User::select('id','name')->get();
        return view('admin.orders.create',compact('users'));
    }


    public function store(OrderRequest $request)
    {
       DB::beginTransaction();
        $order = Order::create([
            'user_id' => $request -> user_id,
            'total_price' => $request -> total_price,
            'livraison' => $request -> livraison,
            'delivery_date' => $request -> delivery_date,
            'delivery_time' => $request -> delivery_time,
        ]);

        DB::commit();
        return redirect()->route('admin.orders')->with(['success' => 'order added successfuly']);
    }

    public function edit($id)
    { 
        $data['order'] = Order::find($id);
        $data['users'] = User::select('id','name')->get();

        if (!$data['order'] )
            return redirect()->route('admin.orders')->with(['error' => 'This order doesnt exist']);
        return view('admin.orders.edit', $data);
    }
    
    public function update($id, OrderRequest  $request)
    {
        try {
            $order = Order::find($id);

            if (!$order)
                return redirect()->route('admin.orders')->with(['error' => 'This order doesnt exist']);


            DB::beginTransaction();

            $order->update($request->except('_token', 'id'));  // update only for slug column

            DB::commit();
            return redirect()->route('admin.orders')->with(['success' => 'Order updated successfuly']);

        } catch (\Exception $ex) {

            DB::rollback();
            return redirect()->route('admin.orders')->with(['error' => 'There is an error please try again ']);
        }
    }


    public function destroy($id)
    {
        try {
            $order = Order::find($id);

            if (!$order)
                return redirect()->route('admin.orders')->with(['error' => 'This order doesnt exist']);

            $order->delete();

            return redirect()->route('admin.orders')->with(['success' => 'Order deleted successfuly']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.orders')->with(['error' => 'There is an error please try again']);
        }
    }
 

}
