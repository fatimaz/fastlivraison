<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Category;
use DB;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id', 'DESC')->paginate(PAGINATION_COUNT);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::select('id','name')->get();
        return view('admin.products.create',compact('categories'));
    }

    public function store(ProductRequest $request)
    {
        DB::beginTransaction();


        $filePath = "";
        if ($request->has('photo')) {
            $filePath = uploadImage('products', $request->photo);
        }

        //validation
        $product = Product::create(
            ['name' => $request -> name,
             'weight' => $request -> weight,
             'photo' => $filePath,
             'price' => $request -> price,
             'qty' => $request -> qty,
             'details' => $request -> details,
             'category_id' => $request -> category_id,
            ]);

        $product->save();
        DB::commit();
        return redirect()->route('admin.products')->with(['success' => 'product added successfuly']);
    }


    public function edit($id)
    {
        $data= [];
        $data['product'] = Product::find($id);
        $data['categories'] = Category::select('id','name')->get();

        if (! $data['product'])
            return redirect()->route('admin.products')->with(['error' => 'This product doesnt exist']);

        return view('admin.products.edit', $data);
    }


    public function update($id, ProductRequest  $request)
    {
        try {
            //validation
            //update DB
            $product = Product::find($id);

            if (!$product)
                return redirect()->route('admin.products')->with(['error' => 'This product doesnt exist']);

            DB::beginTransaction();
            if ($request->has('photo')) {
                $fileName = uploadImage('products', $request->photo);
                $product ->update([
                        'photo' => $fileName,
                    ]);
            }
            $product->update($request->except('_token', 'id'));  // update only for slug column
            $product->save();

            DB::commit();
            return redirect()->route('admin.products')->with(['success' => 'product updated successfuly']);

        } catch (\Exception $ex) {

            DB::rollback();
            return redirect()->route('admin.products')->with(['error' => 'There is an error please try again ']);
        }
    }

    public function destroy($id)
    {
        try {
            $product = Product::find($id);

            if (!$product)
                return redirect()->route('admin.products')->with(['error' => 'This product doesnt exist']);

            $product->delete();
            return redirect()->route('admin.products')->with(['success' => 'product deleted successfuly']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.products')->with(['error' => 'There is an error please try again']);
        }
    }

}
