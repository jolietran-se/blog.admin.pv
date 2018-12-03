<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manufacture extends Model
{
    protected $fillable = [
        'name', 'status', 'description',
    ];

    public function product(){
    	return $this->hasMany('App\Manufacture','manufacture_id','id');
    }
}
