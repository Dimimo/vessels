<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Departure;
use Faker\Generator as Faker;

$factory->define(Departure::class, function (Faker $faker) {
    return [
        'vessel_id'      => function () {
            return factory(App\Vessel::class)->create()->id;
        },
        //'vessel_id' => $faker->numberBetween(1,10),
        /*'captain_id' => function () {
            return factory(App\Captain::class)->create()->id;
        },*/
        'captain_id'     => $faker->numberBetween(1, 5),
        'departure'      => $faker->dateTimeBetween('+5 days', '+20 days'),
        /*'from_port_id' => function () {
            return factory(App\Port::class)->create()->id;
        },
        'to_port_id' => function () {
            return factory(App\Port::class)->create()->id;
        },*/
        'from_port_id'   => $faker->numberBetween(6, 10),
        'to_port_id'     => $faker->numberBetween(1, 5),
        'travel_time'    => '+' . $faker->numberBetween(20, 360) . ' minutes',
        'passengers'     => $faker->numberBetween(10, 200),
        'real_departure' => $faker->dateTimeBetween('+5 days', '+20 days'),
    ];
});
