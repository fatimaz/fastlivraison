<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use DB;
class Country extends Model
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

    public function trips()
    {
        return $this->belongsToMany(Trip::class, 'country_trips')->withPivot('state');
    }
     public function shipments()
    {
        return $this->belongsToMany(Shipment::class, 'country_trips')->withPivot('state');
    }
}
