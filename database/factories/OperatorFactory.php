<?php

/* @var $factory Factory */

use App\Operator;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Operator::class, function (Faker $faker) {
    return [
        'name'           => $faker->company,
        //'slug' => $faker->slug(3,false),
        'company_name'   => $faker->company,
        'email'          => $faker->unique()->safeEmail,
        'city_id'        => $faker->randomElement([153, 1183, 1173, 976, 438]),
        'address1'       => $faker->address,
        'contact_nr'     => $faker->phoneNumber,
        'contact_name'   => $faker->name,
        'emergency_nr'   => $faker->phoneNumber,
        'emergency_name' => $faker->name,
        'url'            => $faker->url,
        'logo'           => $faker->word . '.png',
        'body'           => $faker->sentences(3, true),
        'lat'            => $faker->latitude,
        'lng'            => $faker->longitude,
    ];
});
