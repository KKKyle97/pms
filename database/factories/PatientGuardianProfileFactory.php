<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PatientGuardianProfile;
use Faker\Generator as Faker;

$factory->define(PatientGuardianProfile::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName($gender = null),
        'last_name' => $faker->lastName(),
        'ic_number' => '991203029112',
        'relations' => '01',
        'contact' => '0123456789',
        'address_one' => $faker->address(),
        'address_two' => $faker->streetAddress(),
        'postcode' => $faker->postcode(),
        'state' => '01',
        'city' => $faker->city(),
        'patient_profiles_id' => $faker->numberBetween(1, 9),
    ];
});

// protected $fillable = ['first_name',
//                             'last_name',
//                             'ic_number',
//                             'relations',
//                             'contact',
//                             'address_one',
//                             'address_two',
//                             'postcode',
//                             'state',
//                             'city',
//                             'patient_profiles_id',
// ];