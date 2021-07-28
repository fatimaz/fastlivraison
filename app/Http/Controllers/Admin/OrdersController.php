<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;

use App\Models\Order;
use App\Models\User;
use App\Models\Trip;
use App\Models\Shipment;
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
        $data['users'] = User::get();
        $data['shipments'] = Shipment::get();
         $data['trips'] = Trip::get();

        return view('admin.orders.create',$data);
    }


    public function store(OrderRequest $request)
    {

        DB::beginTransaction();

   
        $order = Order::create($request->except('_token')); 

        DB::commit();
        return redirect()->route('admin.orders')->with(['success' => 'Order added successfuly']);
    }

    public function edit($id)
    {
        //get specific categories and its translations
        $data['order'] = Order::find($id);
        $data['users'] = User::get();
        $data['shipments'] = Shipment::get();
        $data['trips'] = Trip::get();

        if (!$data['order'])
            return redirect()->route('admin.orders')->with(['error' => 'This order doesnt exist']);

        return view('admin.orders.edit',$data);

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
            return redirect()->route('admin.orders')->with(['success' => 'order updated successfuly']);

        } catch (\Exception $ex) {

            DB::rollback();
            return redirect()->route('admin.orders')->with(['error' => 'There is an error please try again ']);
        }
    }


    public function destroy($id)
    {
        try {
            //get specific categories and its translations
            $order = Order::find($id);

            if (!$order)
                return redirect()->route('admin.orders')->with(['error' => 'This order doesnt exist']);

            $order->delete();

            return redirect()->route('admin.orders')->with(['success' => 'order deleted successfuly']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.orders')->with(['error' => 'There is an error please try again']);
        }
    }
 

}
