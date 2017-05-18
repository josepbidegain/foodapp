<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialAccount extends Model
{
    protected $fillable = ['social_id', 'provider', 'nickname', 'avatar'];

    function user(){
    	return $this->belongsTo(User::class);
    }
}
