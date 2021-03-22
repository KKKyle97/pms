<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PatientAccount;
use Faker\Generator as Faker;

$factory->define(PatientAccount::class, function (Faker $faker) {
    return [
        'username' => $faker->userName(),
        'password' => $faker->password(),
        'patient_profiles_id' => $faker->numberBetween(1,9),
    ];
});


// protected $fillable = ['username','password','patient_profiles_id'];