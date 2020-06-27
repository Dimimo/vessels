<?php

/* @var $factory Factory */

use App\VesselType;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(VesselType::class, function (Faker $faker) {
    return [
        'name'        => $faker->unique()->randomElement(['RoRo', 'SuperCat', 'Fast Ferry', 'Ferry']),
        'description' => $faker->sentence,
        'picture'     => $faker->word . '.png',
    ];
});
