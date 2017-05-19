<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'user_id', 'name', 'address', 'active'
    ];

    public function User(){
    	return $this->belongsTo(\App\user::class);
    }
}
