<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Events\DoAction;

class Restaurant extends Model
{
	protected $table = 'restaurants';
    protected $fillable = ['user_id', 'category_id', 'name', 'slug', 'address', 'open_hour', 'close_hour','phone', 'city', 'zip', 'logo', 'active'];


    public function products(){
    	return $this->hasMany(Product::class);
    }

    public function categories(){
    	return $this->hasMany(Category::class);
    }

    public function orders(){
    	return $this->belongsTo(Order::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function discounts(){
        return $this->hasMany(Discount::class);
    }

    public function getActiveDiscount(){
        $now = \Carbon\Carbon::now()->toDateString();
        $matchThese = array(  ['active', '=', true],
                              ['start_date', '<=', $now],
                              ['end_date', '>=', $now]
                            );
        return $this->discounts()->where($matchThese)->get();
    }

    public function promotions(){
        return $this->hasMany(Promotion::class);
    }

}
