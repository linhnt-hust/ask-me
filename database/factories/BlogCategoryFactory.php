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

$factory->define(App\Models\BlogCategory::class, function (Faker $faker) {
    return [
        'blog_id' => App\Models\Blog::all()->random()->id,
        'category_id' => App\Models\Category::all()->random()->id,
        'created_at' => new DateTime(),
        'updated_at' => new DateTime(),
    ];
});
