<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use DB;
class Order extends Model
{
   protected $table = "orders";
    protected $fillable = ['reward','message','trip_id','shipment_id','user_id','type','is_active'];

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


     public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function trip()
    {
        return $this->belongsTo(Trip::class,'trip_id');
    }

    public function shipment()
    {
        return $this->belongsTo(Shipment::class,'shipment_id');
    }



}
