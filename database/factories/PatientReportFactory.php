<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PatientReport;
use Faker\Generator as Faker;

$factory->define(PatientReport::class, function (Faker $faker) {
    return [
        'body_part' => $faker->word(),
        'level' => $faker->numberBetween(1, 10),
        'description' => $faker->randomElement(['Stabbing','Burning']),
        'duration' => $faker->numberBetween(0,60),
        'mood' => $faker->numberBetween(0,5),
        'patient_accounts_id' => $faker->numberBetween(1,9),
        'patient_profiles_id' =>$faker->numberBetween(1,9)
    ];
});

// protected $fillable = ['body_part','level','description','duration','mood','patient_accounts_id','patient_profiles_id'];