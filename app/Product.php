<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    
    protected $table = 'products';
    protected $fillable = ['restaurant_id', 'category_id', 'title', 'description', 'price', 'active'];

    public function restaurant(){
    	return $this->belongsTo(Restaurant::class);
    }

    public function category(){
    	return $this->belongsTo(Category::class);
    }

}
