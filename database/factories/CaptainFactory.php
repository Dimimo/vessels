<?php

/* @var $factory Factory */

use App\Captain;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Captain::class, function (Faker $faker) {
    return [
        'user_id'     => function () {
            return factory(App\User::class)->create(['is_captain' => 1])->id;
        },
        'operator_id' => $faker->unique()->numberBetween(1, 10),
    ];
});
