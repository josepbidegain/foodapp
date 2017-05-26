<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
	protected $table = 'discounts';
    protected $fillable = ['restaurant_id', 'start_date', 'end_date', 'percent', 'range_limit', 'min_value', 'max_value', 'active'];


    public function restaurant(){
        return $this->belongsTo(\App\Restaurant::class);
    }
}
