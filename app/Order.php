<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['client_id', 'restaurant_id', 'confirmed', 'status'];

    public function restaurant(){
    	return $this->belongsTo(User::class);
    }

    public function client(){
    	return $this->belongsTo(User::class);
    }
}
