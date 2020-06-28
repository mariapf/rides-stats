<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\Ride;
use App\Entities\Scooter;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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
        'scooter_id'=> $faker->numberBetween()->unique()
    ];
});
