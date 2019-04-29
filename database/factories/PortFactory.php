<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Port::class, function (Faker $faker) {
    return [
        'name'           => $faker->company,
        //'slug' => $faker->slug(3,false),
        'email'          => $faker->unique()->safeEmail,
        'city'           => $faker->city,
        'address1'       => $faker->streetName,
        'contact_nr'     => $faker->phoneNumber,
        'contact_name'   => $faker->name,
        'emergency_nr'   => $faker->phoneNumber,
        'emergency_name' => $faker->name,
        'url'            => $faker->url,
        'body'           => $faker->sentences(3, true),
    ];
});
