<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use DB;
class Voyage extends Model
{

    protected $fillable = ['vehicle_id','ligne_id','driver_id','date','is_active'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query){
        return $query -> where('is_active',1) ;
    }

    public function getActive(){
        return  $this -> is_active  == 0 ?  'non active'   : 'active' ;
    }


    public function driver()
    {
        return $this->belongsTo(Driver::class,'driver_id');
    }
      public function vehicle()
    {
        return $this->belongsTo(Driver::class,'vehicle_id');
    }

    public function ligne()
    {
        return $this->hasMany(Link::class,'ligne_id');
    }

  
}
