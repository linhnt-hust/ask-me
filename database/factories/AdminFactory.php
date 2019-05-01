<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\Admin::class, function (Faker $faker) {
    return [
        'name' => $faker->userName,
        'email' => $faker->unique()->safeEmail,
        'password' => Hash::make(123456),
        'remember_token' => str_random(10),
        'address' => $faker->address,
        'avatar' => $faker->image($dir='public/avatar/admins', $width=640, $height=480, null, false),
        'description' => $faker->sentence(50),
        'created_at' => new DateTime(),
        'updated_at' => new DateTime(),
    ];
});

