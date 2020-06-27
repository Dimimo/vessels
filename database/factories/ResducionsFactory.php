<?php

/* @var $factory Factory */

use App\Reduction;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Reduction::class, function (Faker $faker) {
    return [
        'name'       => $faker->words(2, true),
        'percentage' => $faker->numberBetween(5, 20),
        'min_age'    => $faker->numberBetween(0, 13),
        'max_age'    => $faker->numberBetween(50, 80),
        'optional'   => false,
        'global'     => false,
    ];
});
