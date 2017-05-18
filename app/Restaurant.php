<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
	protected $table = 'restaurants';
    protected $fillable = ['user_id', 'category_id', 'name', 'slug', 'address', 'phone', 'city', 'zip', 'logo', 'active'];

    public function products(){
    	return $this->hasMany(\App\Product::class);
    }

    public function categories(){
    	return $this->hasMany(\App\Category::class);
    }

    public function orders(){
    	return $this->belongsTo(\App\Order::class);
    }

    public function user(){
        return $this->belongsTo(\App\User::class);
    }

}
