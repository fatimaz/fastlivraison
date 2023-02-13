<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use DB;

class Conversation extends Model
{
    protected $table = 'conversations';
    protected $fillable =['message_id','message','is_active'];

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

    public function messsage()
    {
        return $this->belongsTo(Message::class,'message_id');
    }

}

