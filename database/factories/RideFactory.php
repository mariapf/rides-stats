<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\Ride;
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

$factory->define(Ride::class, function (Faker $faker) {
    return [
        'scooter_id' => $faker->numberBetween(1, 1000),
    ];
});
