<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use DB;

class Category extends Model
{

    protected $fillable = ['name','is_active'];

     protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query){
        return $query -> where('is_active',1) ;
    }

    public function getActive(){
        return  $this -> is_active  == 0 ?  'non active'   : 'active' ;
    }

       
    public function shipments(){
        return $this->hasMany(Shipment::class,'category_id');
    }

    public function trips(){
        return $this->hasMany(Trip::class,'category_id');
    }
}
