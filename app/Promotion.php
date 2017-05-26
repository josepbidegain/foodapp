<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
	protected $table = 'promotions';
    protected $fillable = ['restaurant_id','price','start_date','end_date','active'];

    public function products(){
        return $this->belongsToMany(Product::class)->withTimestamps();
    }

    public function restaurant(){
    	return $this->belongsTo(Restaurant::class);
    }
}
