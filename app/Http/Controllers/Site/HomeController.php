<?php

namespace App\Http\Controllers\Site;

use App\Models\Category;
use App\Models\Slider;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    public function home()
    {
        $data = [];
      //  $data['sliders'] = Slider::get(['photo']);
        // $data['categories'] = Category::parent()->select('id', 'slug')->with(['childrens' => function ($q) {
        //     $q->select('id', 'parent_id', 'slug');
        //     $q->with(['childrens' => function ($qq) {
        //         $qq->select('id', 'parent_id', 'slug');
        //     }]);
        // }])->get();
        return view('front.pages.index');
    }
    public function businessPage(){
         return view('front.pages.business');
    }
       public function captainPage(){
         return view('front.pages.captain');
    }
}
