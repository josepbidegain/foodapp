<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_Promotion extends Model
{
	protected $table = "product_promotion";
	protected $fillable = ['product_id', 'promotion_id'];
	/*
    public function promotion(){
    	return $this->belongsTo(\App\Promotion::class);
    }

    public function product(){
    	return $this->belongsTo(\App\Product::class);
    }*/
}
