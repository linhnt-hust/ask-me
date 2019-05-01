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

$factory->define(App\Models\BlogUploaded::class, function (Faker $faker) {
    return [
        'blog_id' => App\Models\Blog::all()->random()->id,
        'filename' => $faker->image($dir='public/upload/blogs', $width=640, $height=480,null, false),
        'created_at' => new DateTime(),
        'updated_at' => new DateTime(),
    ];
});
