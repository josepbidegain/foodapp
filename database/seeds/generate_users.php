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
        \DB::table('users')->insert(array (
			0 =>
			array (
				'id' => '1',
				'email' => 'admin@admin.com',
				'password' => '$2y$10$tUGCkQf/0NY3w1l9sobGsudt6UngnoVXx/lUoh9ElcSOD0ERRkK9C',
				'permissions' => NULL,
				'activated' => '1',
				'activation_code' => NULL,
				'activated_at' => NULL,
				'last_login' => NULL,
				'persist_code' => NULL,
				'reset_password_code' => NULL,
				'first_name' => NULL,
				'last_name' => NULL,
				'created_at' => '2013-06-11 07:47:40',
				'updated_at' => '2013-06-11 07:47:40',
			),
			1 =>
			array (
				'id' => '2',
				'email' => 'user@user.com',
				'password' => '$2y$10$ImNvsMzK/BOgNSYgpjs/3OjMKMHeA9BH/hjl43EiuBuLkZGPMuZ2W',
				'permissions' => NULL,
				'activated' => '1',
				'activation_code' => NULL,
				'activated_at' => NULL,
				'last_login' => '2013-06-11 07:54:57',
				'persist_code' => '$2y$10$C0la8WuyqC6AU2TpUwj0I.E3Mrva8A3tuVFWxXN5u7jswRKzsYYHK',
				'reset_password_code' => NULL,
				'first_name' => NULL,
				'last_name' => NULL,
				'created_at' => '2013-06-11 07:47:40',
				'updated_at' => '2013-06-11 07:54:57',
			)
		));
    }
}
