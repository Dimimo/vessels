<?php

/* @var $factory Factory */

use App\Departure;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Departure::class, function (Faker $faker) {
    return [
        'vessel_id'      => $faker->numberBetween(1, 20),
        'captain_id'     => $faker->numberBetween(1, 5),
        'departure'      => $faker->dateTimeBetween('+5 days', '+20 days'),
        'from_port_id'   => $faker->numberBetween(1, 5),
        'to_port_id'     => $faker->numberBetween(6, 10),
        'travel_time'    => '+' . $faker->numberBetween(20, 360) . ' minutes',
        'passengers'     => $faker->numberBetween(10, 200),
        'real_departure' => $faker->dateTimeBetween('+5 days', '+20 days'),
        'price'          => $faker->numberBetween(220, 550),
    ];
});
