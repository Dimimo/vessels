<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Captain;
use Faker\Generator as Faker;

$factory->define(Captain::class, function (Faker $faker) {
    return [
        'user_id'     => function () {
            return factory(App\User::class)->create(['is_captain' => 1])->id;
        },
        'operator_id' => function () {
            return factory(App\Operator::class)->create()->id;
        },
    ];
});
