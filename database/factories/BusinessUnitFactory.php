<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\BusinessUnit;
use Faker\Generator as Faker;

$factory->define(BusinessUnit::class, function (Faker $faker) {
    return [
        'name' => $faker->randomElement(['Information Technology', 'Finance', 'Human Resources']),
        'color' => $faker->hexcolor,
    ];
});
