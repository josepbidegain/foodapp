<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    public function restaurant(){
        return $this->belongsTo(\App\Restaurant::class);
    }
}
