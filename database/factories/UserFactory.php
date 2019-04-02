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

$factory->define(App\Models\User::class, function (Faker $faker) {
    return [
        'name' => $faker->userName,
        'email' => $faker->unique()->safeEmail,
        'password' => Hash::make(123456),
        'remember_token' => str_random(10),
        'address' => $faker->address,
        'website' => $faker->domainName,
        'country' => $faker->country,
        'description' => $faker->sentence(50),
        'facebook_account' => $faker->unique()->domainName,
        'twitter_account' => $faker->unique()->domainName,
        'github_account' => $faker->unique()->domainName,
        'googleplus_account' => $faker->unique()->domainName,
        'created_at' => new DateTime(),
        'updated_at' => new DateTime(),

    ];
});
