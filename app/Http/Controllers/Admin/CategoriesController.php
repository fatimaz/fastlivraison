<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use DB;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('id', 'DESC')->paginate(PAGINATION_COUNT);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }


    public function store(CategoryRequest $request)
    {

        DB::beginTransaction();

        //validation
        //another way of saving
        $category = Category::create(['name' => $request -> name]);

        DB::commit();
        return redirect()->route('admin.categories')->with(['success' => 'category added successfuly']);
    }

    public function edit($id)
    {
        //get specific categories and its translations
        $category = Category::find($id);

        if (!$category)
            return redirect()->route('admin.categories')->with(['error' => 'This category doesnt exist']);

        return view('admin.categories.edit', compact('category'));

    }


    public function update($id, CategoryRequest  $request)
    {
        try {

            $category = Category::find($id);

            if (!$category)
                return redirect()->route('admin.categories')->with(['error' => 'This category doesnt exist']);


            DB::beginTransaction();

            $category->update($request->except('_token', 'id'));  // update only for slug column

            DB::commit();
            return redirect()->route('admin.categories')->with(['success' => 'category updated successfuly']);

        } catch (\Exception $ex) {

            DB::rollback();
            return redirect()->route('admin.categories')->with(['error' => 'There is an error please try again ']);
        }
    }


    public function destroy($id)
    {
        try {
            //get specific categories and its translations
            $category = Category::find($id);

            if (!$categories)
                return redirect()->route('admin.categories')->with(['error' => 'This category doesnt exist']);

            $category->delete();

            return redirect()->route('admin.categories')->with(['success' => 'Category deleted successfuly']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.categories')->with(['error' => 'There is an error please try again']);
        }
    }
 

}
