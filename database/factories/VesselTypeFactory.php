<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\VesselType;
use Faker\Generator as Faker;

$factory->define(VesselType::class, function (Faker $faker) {
    return [
        'name'        => $faker->company,
        'slug'        => $faker->slug(3, false),
        'description' => $faker->sentence,
        'picture'     => $faker->word . '.png',
    ];
});
