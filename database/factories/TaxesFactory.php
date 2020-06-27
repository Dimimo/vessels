<?php

/* @var $factory Factory */

use App\Tax;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Tax::class, function (Faker $faker) {
    return [
        'name'     => $faker->words(2, true),
        'port_id'  => $faker->numberBetween(1, 10),
        'tax_at'   => $faker->randomElement(['departure', 'arrival']),
        'amount'   => $faker->numberBetween(20, 100),
        'optional' => false,
        'global'   => false,
    ];
});
