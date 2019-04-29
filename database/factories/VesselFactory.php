<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Vessel;
use Faker\Generator as Faker;

$factory->define(Vessel::class, function (Faker $faker) {
    return [
        'name'              => $faker->company,
        //'slug' => $faker->slug(3,false),
        'nickname'          => $faker->firstName,
        'vessel_type_id'    => function () {
            return factory(App\VesselType::class)->create()->id;
        },
        //'vessel_type_id' => $faker->numberBetween(1,4),
        'operator_id'       => function () {
            return factory(App\Operator::class)->create()->id;
        },
        //'operator_id' => $faker->numberBetween(1,10),
        'captain_id'        => function () {
            return factory(App\Captain::class)->create()->id;
        },
        'description'       => $faker->sentence,
        'body'              => $faker->sentences(3, true),
        'in_service'        => $faker->boolean,
        'capacity'          => $faker->numberBetween(10, 200),
        'operational_since' => $faker->date(),
        'picture'           => $faker->word . '.png',
    ];
});
