<?php
/* @var $factory Factory */

use App\Reservee;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
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
$factory->define(Reservee::class, function (Faker $faker) {
    return [
        'name'              => $faker->name,
        'email'             => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password'          => Hash::make('secret'),
        'remember_token'    => Str::random(10),
        'city_id'           => $faker->randomElement([153, 1183, 1173, 976, 438]),
        'contact_nr'        => $faker->phoneNumber,
        'contact_name'      => $faker->name,
        'title'             => 'Mr.',
        'description'       => $faker->sentences(2, true),
        'status'            => true,
    ];
});
