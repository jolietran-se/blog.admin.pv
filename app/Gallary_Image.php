<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallary_Image extends Model
{
	protected $table = 'gallary_images';
    protected $fillable = [
        'link', 'product_id','name' 
    ];
    public function product(){
    	return $this->belongsTo()('App\Product','id','product_id');
    }

    public static function storeData($data) {
    	return Gallary_image::create($data);
    }
}
