<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CartProductRequest;
use Illuminate\Http\Request;
use App\Models\CartProduct;
use App\Models\Product;
use App\Models\Cart;
use DB;

class CartProductsController extends Controller
{
    public function index()
    {
        $cartproducts = CartProduct::orderBy('id', 'DESC')->paginate(PAGINATION_COUNT);
        return view('admin.cartproducts.index', compact('cartproducts'));
    }

    public function create()
    {

        $data['products'] = Product::select('id','name')->get();
        $data['carts'] = Cart::get();
        return view('admin.cartproducts.create',$data);
    }


    public function store(CartProductRequest $request)
    {
       DB::beginTransaction();
        $cartproduct = CartProduct::create([
            'product_id' => $request -> product_id,
            'cart_id' => $request -> cart_id,
            'count' => $request -> count,
            'cost' => $request -> cost,
            'inCart' => $request -> inCart,
        ]);

        DB::commit();
        return redirect()->route('admin.cartproducts')->with(['success' => 'cartproduct item added successfuly']);
    }

    public function edit($id)
    { 
        $data['cartproduct'] = CartProduct::find($id);
        $data['products'] = Product::select('id','name')->get();
        $data['carts'] = Cart::get();

        if (!$data['cartproduct'] )
            return redirect()->route('admin.cartproducts')->with(['error' => 'This cartproduct doesnt exist']);
        return view('admin.cartproducts.edit', $data);

    }


    public function update($id, CartProductRequest  $request)
    {
        try {
            $cartproduct = CartProduct::find($id);

            if (!$cartproduct)
                return redirect()->route('admin.cartproducts')->with(['error' => 'This cartproducts doesnt exist']);

            DB::beginTransaction();

            $cartproduct->update($request->except('_token', 'id'));  // update only for slug column

            DB::commit();
            return redirect()->route('admin.cartproducts')->with(['success' => 'cartproduct updated successfuly']);

        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.cartproducts')->with(['error' => 'There is an error please try again ']);
        }
    }


    public function destroy($id)
    {
        try {
            $cartproduct = CartProduct::find($id);

            if (!$cartproduct)
                return redirect()->route('admin.cartproducts')->with(['error' => 'This cartproduct doesnt exist']);

            $cartproduct->delete();
            return redirect()->route('admin.cartproducts')->with(['success' => 'cartproduct deleted successfuly']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.cartproducts')->with(['error' => 'There is an error please try again']);
        }
    }
 

}
