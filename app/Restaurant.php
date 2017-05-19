<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
	protected $table = 'restaurants';
    protected $fillable = ['user_id', 'category_id', 'name', 'slug', 'address', 'open_hour', 'close_hour','phone', 'city', 'zip', 'logo', 'active'];

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

    public function discounts(){
        return $this->hasMany(\App\Discount::class);
    }
/*
    public function getActiveDiscount(){
        $now = Carbon\Carbon::now()->toDateString();
        $matchThese = array(  ['active', '=', true],
                              ['start_date', '<=', $now],
                              ['end_date', '>=', $now]
                            );
        return $this->discount()->where($matchThese);
    }
*/
}
