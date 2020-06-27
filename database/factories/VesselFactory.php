<?php

/* @var $factory Factory */

use App\Vessel;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Vessel::class, function (Faker $faker) {
    return [
        'name'              => $faker->company,
        'nickname'          => $faker->firstName,
        'vessel_type_id'    => $faker->numberBetween(1, 4),
        'operator_id'       => $faker->numberBetween(1, 10),
        'captain_id'        => $faker->numberBetween(1, 10),
        'description'       => $faker->sentence,
        'body'              => $faker->sentences(3, true),
        'in_service'        => $faker->boolean,
        'capacity'          => $faker->numberBetween(10, 200),
        'operational_since' => $faker->date(),
        'picture'           => $faker->word . '.png',
    ];
});
