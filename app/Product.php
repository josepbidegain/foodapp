<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    
    protected $table = 'products';
    protected $fillable = ['restaurant_id', 'category_id', 'title', 'description', 'image', 'recomendated', 'price', 'active'];

    public function restaurant(){
    	return $this->belongsTo(Restaurant::class);
    }

    public function category(){
    	return $this->belongsTo(Category::class);
    }

    public function promotions(){
    	return $this->belongsToMany(Promotion::class)->withTimestamps();
    }

    public function tastes(){
        return $this->hasMany(FoodTaste::class);
    }

}
