<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/
use Illuminate\Support\Str;
/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'lastname' => $faker->lastname,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
        'address_number' => $faker->randomNumber(4),
        'corner' => $faker->address,
        'active' => $faker->boolean,
        'type' => $faker->randomElement(['user','admin']),
        'remember_token' => str_random(10),
    ];
});
$factory->define(App\Category::class, function (Faker\Generator $faker) {
    
    $name = $faker->sentence(2);
    return [
        'restaurant_id' => 1,
        'name' => $name,
        'slug' => Str::slug($name),
        'active' => $faker->boolean        
    ];
});

$factory->define(App\Restaurant::class, function (Faker\Generator $faker) {

    return [
        'user_id' => User::inRandomOrder()->get()[0],
        'category_id' => factory(App\Category::class)->create()->id,
        'name' => $faker->name,
        'slug' => $faker->slug,
        'address' => $faker->address,
        'open_hour' => $faker->time,
        'close_hour' => $faker->time,
        'phone' => $faker->phone,
        'city' => $faker->city,
        'zip' => $faker->zip,
        'logo' => $faker->image,
        'active' => $faker->boolean        
    ];
});



$factory->define(App\Product::class, function (Faker\Generator $faker) {
    
    return [
        'restaurant_id' => factory(App\User::class)->create()->id,
        'category_id' => factory(App\Category::class)->create()->id,
        'title' => $faker->title,
        'description' => $faker->paragraph,
        'image' => $faker->image,
        
    ];
});