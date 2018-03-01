<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    protected $table = 'audits';

    public function user()
    {
    	return $this->belongsTo(\App\User::class);
    }
}
