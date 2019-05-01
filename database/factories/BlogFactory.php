<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019-03-26
 * Time: 14:56
 */
use Faker\Generator as Faker;

$factory->define(App\Models\Blog::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(15),
        'user_id' => App\Models\User::all()->random()->id,
        'type' => $faker->randomElement([1,2,3,4]),
        'approve_status' => $faker->randomElement([0,1,2]),
        'description' => $faker->paragraph(55),
        'url' => $faker->url,
        'created_at' => new DateTime(),
        'updated_at' => new DateTime(),
    ];
});
