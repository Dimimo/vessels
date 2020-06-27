<?php

/* @var $factory Factory */

use App\Departure;
use App\Reservation;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Reservation::class, function (Faker $faker) {
    $departure = Departure::all()->random(1)->first();
    return [
        'reservee_id'  => $faker->numberBetween(1, 20),
        'departure_id' => $departure->id,
        'operator_id'  => $departure->from_port,
        'confirmed'    => $faker->boolean(80),
        'confirmed_at' => $faker->dateTimeBetween(now(), '+20 days'),
        'accepted'     => $faker->boolean(60),
        'accepted_at'  => $faker->dateTimeBetween('+5 days', '+20 days'),
        'departed'     => $faker->boolean(40),
        'departed_at'  => $faker->dateTimeBetween('+5 days', '+20 days'),
    ];
});
