<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = ['user_id','action','model','model_id'];

    public static function record($action, Model $model){

        
    	$activity = new Activity();
    	$activity->action = $action;

    	if($model){
    		$activity->model = get_class($model);
    		$activity->model_id = $model->id;
    	}
        //dd(auth()->user());

    	auth()->user()->activities()->save($activity);

    }

    public function User(){
        return $this->belongsTo(\App\User::class);
    }
}
