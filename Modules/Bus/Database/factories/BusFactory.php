<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Modules\Bus\Models\Bus;

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

$factory->define(Bus::class, function (Faker $faker) {
    // For simplicity, just randomise bus number, the rest is ok to be fixed
    return [
        'service_number'         => $faker->unique()->randomNumber(3),
        'direction_a_start_time' => '07:00',
        'direction_a_end_time'   => '23:00',
        'direction_b_start_time' => '07:00',
        'direction_b_end_time'   => '23:00',
    ];
});
