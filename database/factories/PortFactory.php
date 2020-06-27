<?php

/* @var $factory Factory */

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(App\Port::class, function (Faker $faker) {
    return [
        'name'           => $faker->company,
        //'slug' => $faker->slug(3,false),
        'email'          => $faker->unique()->safeEmail,
        'city_id'        => $faker->randomElement([153, 1183, 1173, 976, 438]),
        'address1'       => $faker->streetName,
        'contact_nr'     => $faker->phoneNumber,
        'contact_name'   => $faker->name,
        'emergency_nr'   => $faker->phoneNumber,
        'emergency_name' => $faker->name,
        'url'            => $faker->url,
        'body'           => $faker->sentences(3, true),
    ];
});
