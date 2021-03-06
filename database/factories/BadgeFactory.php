<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Badge;
use Faker\Generator as Faker;

$factory->define(Badge::class, function (Faker $faker) {
    return [
        'name' => $faker->randomElement(['A','R','C']).$faker->numberBetween(0,4),
        'type' => $faker->numberBetween(1, 3),
        'target' => $faker->numberBetween(1, 100),
    ];
});

// protected $fillable = [
//     'name',
//     'type',
//     'target'
// ];
