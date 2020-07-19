<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Modules\User\Models\User;

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

$factory->define(User::class, function (Faker $faker) {
    return [
        'name'              => $faker->name,
        'email'             => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token'    => Str::random(10),
    ];
});

/*
 * SET @lat1 = '1.376286';
SET @lon1 = '103.858153';
SET @lat2 = '1.375813';
SET @lon2 = '103.854771';

SELECT FLOOR(6371000 * acos(
    cos( radians( @lat1 ))
    * cos( radians( @lat2 ) )
    * cos( radians( @lon2 ) - radians( @lon1 ) )
    + sin( radians( @lat1 ) )
    * sin( radians( @lat2 ) )
));

SELECT FLOOR(6371000 * ACOS(
    COS( @lat1 * 0.017453292519943295)
    * COS( @lat2 * 0.017453292519943295 )
    * COS( (@lon2 * 0.017453292519943295) - (@lon1 * 0.017453292519943295) )
    + SIN( @lat1 * 0.017453292519943295 )
    * SIN( @lat2 * 0.017453292519943295 )
));
 */