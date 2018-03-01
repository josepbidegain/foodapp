<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Events\DoAction;

use App\Activity;
//use App\Traits\RecordsActivity;

use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Category extends Model implements AuditableContract
{
    
  //  use RecordsActivityTrait;
    use Auditable;

	protected $fillable = ['restaurant_id','name','slug','active','created_at'];
    /*
    protected $events = [
        'created' => DoAction::class,
        'deleted' => DoAction::class,
    ];*/

    public function product(){
    	return $this->hasMany(\App\Product::class);
    }

    public function restaurant(){
    	return $this->belongsTo(\App\User::class);
    }


/*
    public static function boot()
    {
        parent::boot();

        static::created(function($model) {
            
            Activity::record('create',$model);
            
        });

        static::updated(function($model) {
            
            Activity::record('update',$model);
            
        });

        static::deleted(function($model){

            Activity::record('delete',$model);
        });
    }*/

}
