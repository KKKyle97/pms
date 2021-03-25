<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PatientMessage;
use Faker\Generator as Faker;

$factory->define(PatientMessage::class, function (Faker $faker) {
    return [
        'score' => $faker->numberBetween(1,10),
        'message'  => $faker->sentence(),
        'is_solved'=> $faker->numberBetween(0,1),
        'solution' => $faker->sentence(),
        'patient_accounts_id' => $faker->numberBetween(1,9),
        'patient_profiles_id' =>$faker->numberBetween(1,9)
    ];
});
