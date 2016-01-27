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

use Knoters\Models\Project;

$factory->define(Knoters\Models\Project::class, function ($faker) {
    return [
        'id' => $faker->randomDigit,
        'uuid' => $faker->uuid,
        'name' => $faker->word,
        'video_id' => 81160524,
        'source_id' => 2,
        'path' => 'https://vimeo.com/81160524',
        'status_id' => 1
    ];
});

$factory->define(Knoters\Models\User::class, function ($faker) {
    return [
        'id' => $faker->randomDigit,
        'uuid' => $faker->uuid,
        'email' => $faker->email,
        'firstname' => $faker->firstname,
        'name' => $faker->lastname,
        'registered' => 0
    ];
});

$factory->define(Knoters\Models\ProjectUser::class, function ($faker) {
    return [
        'project_id' => Project::all()->random()->id,
        'user_id' => $faker->numberBetween(1, 4),
        'is_host' => 0
    ];
});

$factory->define(Knoters\Models\Note::class, function ($faker) {
    return [
        'id' => $faker->randomDigit,
        'uuid' => $faker->uuid,
        'index'=> $faker->randomNumber,
        'project_id' => 1,
        'from_id' => 1,
        'note_type_id' => $faker->randomElement(['info', 'warning', 'error']),
        'message' => $faker->sentence
    ];
});
