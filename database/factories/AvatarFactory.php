<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Avatar;
use Faker\Generator as Faker;

$factory->define(Avatar::class, function (Faker $faker) {
    return [
        'name' => $faker->randomElement(['A','B','C']),
        'cost' => $faker->numberBetween(1, 100),
    ];
});


// protected $fillable = [
//     'name',
//     'cost'
// ];