<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\UserProfile;
use Faker\Generator as Faker;

$factory->define(UserProfile::class, function (Faker $faker) {
    return [
        //
        'first_name' => $faker->firstName($gender = null),
        'last_name' => $faker->lastName(),
        'gender' => 'F',
        'contact' => '0123456789',
        'role' => '01',
        'email' => $faker->email(),
        'hospital_code' => 'J002',
    ];
});

// protected $fillable = ['first_name',
// 'last_name',
// 'ic_number',
// 'gender',
// 'contact',
// 'role',
// 'email',
// 'hospital_code',
// ];
