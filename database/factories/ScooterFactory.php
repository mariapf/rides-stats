<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

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

$factory->define(Scooter::class, function (Faker $faker) {
    return [
        'id'=> $faker->numberBetween()->unique(),
        'name'              => $faker->name,
        'lat'             => $faker->latitude,
        'lng' => $faker->longitude,
        'battery' => $faker->$faker->numberBetween(1, 100),
        'type'          => $faker->$faker->numberBetween(1, 10)
    ];
});
