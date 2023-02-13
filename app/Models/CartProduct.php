<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use DB;
class CartProduct extends Model
{
    protected $table = 'cart_product';
    protected $fillable = ['cart_id','product_id','count','cost','request','inCart'];

     protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query){
        return $query -> where('is_active',1) ;
    }

    public function getActive(){
        return  $this -> is_active  == 0 ?  'non active'   : 'active' ;
    }
    public function  getPhotoAttribute($val){
        return ($val !== null) ? asset('assets/images/products/' . $val) : "";
    }

    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
    public function cart(){
        return $this->belongsTo(Cart::class,'cart_id');
    }
}
