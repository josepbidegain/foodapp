<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'lastname', 'slug', 'email', 'password', 'phone', 'address', 'logo', 'active', 'type', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    function socialAccount(){
        return $this->hasMany(SocialAccount::class);
    }

    public function orders(){
        return $this->hasMany(\App\Order::class);
    }

    public function categories(){
        return $this->hasMany(\App\Category::class);
    }

    public function restaurants(){
        return $this->hasMany(\App\Restaurant::class);
    }

}