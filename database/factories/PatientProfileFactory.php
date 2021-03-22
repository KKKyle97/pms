<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PatientProfile;
use Faker\Generator as Faker;

$factory->define(PatientProfile::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName($gender = null),
        'last_name' => $faker->lastName(),
        'ic_number'=> '9902330103392',
        'gender' => 'F',
        'age' => $faker->numberBetween(7,11),
        'cancer' => '01',
        'user_profiles_id' => 1,
    ];
});

// protected $fillable = ['first_name',
//                             'last_name',
//                             'ic_number',
//                             'gender',
//                             'age',
//                             'cancer',
//                             'user_profiles_id'
// ];