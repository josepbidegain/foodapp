<?php

use Illuminate\Database\Seeder;

class generate_users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert([
        	factory(App\User::class)->create()
        ])
	
    }
}
