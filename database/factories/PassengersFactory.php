<?php

/* @var $factory Factory */

use App\Passenger;
use App\Reservation;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Passenger::class, function (Faker $faker) {
    $reservation = Reservation::all()->random(1)->first();
    return [
        'reservee_id'    => $reservation->reservee->id,
        'reservation_id' => $reservation->id,
        'name'           => $faker->name,
        'age'            => $faker->numberBetween(0, 90),
        'nationality'    => $faker->randomElement(['Filipino', 'Belgium', 'Germany', 'US', 'Australia']),
        'reduction_id'   => $faker->numberBetween(1, 10),
        'wheelchair'     => false,
        'approved'       => false,
        'departed'       => false,
    ];
});
