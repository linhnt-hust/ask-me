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

$factory->define(App\Models\QuestionTag::class, function (Faker $faker) {
    return [
        'question_id' => App\Models\Question::all()->random()->id,
        'tag_id' => App\Models\Tag::all()->random()->id,
        'created_at' => new DateTime(),
        'updated_at' => new DateTime(),
    ];
});
