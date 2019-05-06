<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Project;
use Faker\Generator as Faker;

$factory->define(Project::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(5),
        'owner' => 'John Lowery',
        'type' => $faker->randomElement(['Work', 'Fluff', 'Other']),
        'business_unit' => $faker->randomElement(['Information Technology', 'Finance', 'Human Resources']),
        'publish_date' => $faker->dateTimeBetween($startDate = 'now', $endDate = '+3 months', $timezone = null),
    ];
});
