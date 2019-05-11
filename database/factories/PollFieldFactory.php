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

$factory->define(App\Models\Poll::class, function (Faker $faker) {
    $poll = App\Models\Question::where('question_poll', '=', 1)->pluck('id')->toArray();
    return [
        'title' => $faker->sentence(3),
        'question_id' => $faker->randomElement($poll),
        'votes' => $faker->numberBetween(0,100),
        'created_at' => new DateTime(),
        'updated_at' => new DateTime(),
    ];
});
