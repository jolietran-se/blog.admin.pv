<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_Detail extends Model
{
	protected $table = 'product_details';
    protected $fillable = [
        'color', 'product_id', 'quantity','size_id'
    ];
    public function product(){
    	return $this->belongsTo()('App\Product','product_id','id');
    }
    public function code(){
        return $this->hasMany('App\Color','id','color_id');
    }
    public function size(){
        return $this->hasMany('App\Size','id','size_id');
    }
}
