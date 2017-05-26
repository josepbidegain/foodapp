<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FoodTaste extends Model
{
	protected $table = 'food_tastes';
    protected $fillable = ['product_id', 'name', 'slug', 'active'];


    public function product(){
    	return $this->belongsTo(Product::class);
    }
}
