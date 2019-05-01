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

$factory->define(App\Models\Comment::class, function (Faker $faker) {
    $commentable = [
        App\Models\Question::class,
        App\Models\Blog::class,
    ];
    return [
        'user_id' => App\Models\User::all()->random()->id,
        'parent_id' => $faker->boolean(45) ? random_int(1,100) : null,
        'body' => $faker->sentence(15),
        'commentable_id' => App\Models\Question::all()->random()->id,
        'commentable_type' => $faker->randomElement($commentable),
        'created_at' => new DateTime(),
        'updated_at' => new DateTime(),
    ];
});
