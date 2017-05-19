<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('restaurants', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            //$table->foreign('user_id')->references('id')->on('users');
            $table->integer('category_id')->nullable();                       
            $table->string('name');
            $table->string('slug');
            $table->string('address');
            $table->string('open_hour')->nullable();
            $table->string('close_hour')->nullable();
            $table->string('phone');
            $table->string('city');
            $table->string('zip')->nullable();            
            $table->string('logo',60)->nullable();
            $table->boolean('active')->default(true);            
            //$table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restaurants');
    }
}
