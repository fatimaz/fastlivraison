<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use DB;

class Category extends Model
{

    protected $fillable = ['name','photo','is_active'];

     protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query){
        return $query -> where('is_active',1) ;
    }

    public function getPhotoAttribute($val)
    {
        return ($val !== null) ? asset('assets/images/products/' . $val) : "";

    }


    public function getActive(){
        return  $this -> is_active  == 0 ?  'non active'   : 'active' ;
    }
    
    public function products(){
        return $this->hasMany(Product::class,'category_id');
    }

}
