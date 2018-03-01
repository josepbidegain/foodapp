<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;
use App\Category;

class CreateModelAndGenerateActivityLogTest extends TestCase
{
    //use DatabaseTransactions;	    

    function test_create_model_and_create_activity_log()
    {   
    	$loginUser = User::inRandomOrder()->get()[0];

    	$this->actingAs($loginUser);

		$user = factory(User::class)->create(['name'=>'jose']);        

		$this->assertDatabaseHas('users',[
			'id' => $user->id
		]);
		
        $this->assertDatabaseHas('audits', [
        	'event' => 'created',
        	'auditable_type' => get_class($user),
        	'auditable_id' => $user->id,
        	'user_id' => $loginUser->id
        ]);
    }

    function test_create_category_and_save_activity_log(){
		
        $loginUser = User::inRandomOrder()->get()[0];

    	$this->actingAs($loginUser);

    	$category = Category::create([
    		'restaurant_id' => 1,
    		'name' => 'empanadas',
    		'slug' => 'empanadas',
    		'active' => 1
    	]);    	

    	$this->assertDatabaseHas('categories',[
			'name' => $category->name
		]);

		$this->assertDatabaseHas('audits', [
        	'event' => 'created',
        	'auditable_type' => get_class($category),
        	'auditable_id' => $category->id,
        	'user_id' => $loginUser->id
        ]);
        
    }

    function test_delete_category_and_save_activity_log(){
		
		$loginUser = User::inRandomOrder()->get()[0];

    	$this->actingAs($loginUser);

    	$category = factory(Category::class)->create();    	

    	$this->assertDatabaseHas('categories',[
			'id' => $category->id
		]);

		$this->assertDatabaseHas('audits', [
        	'event' => 'created',
        	'auditable_type' => get_class($category),
        	'auditable_id' => $category->id,
        	'user_id' => $loginUser->id
        ]);

    	$category = Category::where('id',$category->id)->get();
    	
    	$cat_id = $category[0]->id;

    	Category::destroy($category[0]->id);
		
    	$this->assertDatabaseMissing('categories',[
			'id' => $cat_id
		]);

		$this->assertDatabaseHas('audits', [
        	'event' => 'deleted',
        	'auditable_type' => get_class($category[0]),
        	'auditable_id' => $cat_id,
        	'user_id' => $loginUser->id
        ]);
    }

    function test_update_category_and_save_activity_log(){
		
		$loginUser = User::inRandomOrder()->get()[0];

    	$this->actingAs($loginUser);

    	$category = Category::first();    	

    	$category->name='cambio cat name';
    	$category->save();

		$this->assertDatabaseHas('audits', [
        	'event' => 'updated',
        	'auditable_type' => get_class($category),
        	'auditable_id' => $category->id,
        	'user_id' => $loginUser->id
        ]);
	}
}
