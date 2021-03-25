<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\UserProfile;
use Faker\Generator as Faker;

$factory->define(UserProfile::class, function (Faker $faker) {
    return [
        //
        'first_name' => $faker->firstName($gender = null),
        'last_name' => $faker->lastName(),
        'ic_number' => '990292023390',
        'gender' => 'F',
        'contact' => '0123456789',
        'role' => '01',
        'email' => $faker->email(),
        'hospital_code' => 'J002',
    ];
});