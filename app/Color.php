<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $fillable = [
        'name', 'code'
    ];
    public function color_detail(){
        return $this->belongsToMany('App\Product_Detail','color_id','id');
    }
}
