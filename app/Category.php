<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $fillable = ['restaurant_id','name','slug','active','created_at'];
    
    public function product(){
    	return $this->hasMany(\App\Product::class);
    }

    public function restaurant(){
    	return $this->belongsTo(\App\User::class);
    }
}
