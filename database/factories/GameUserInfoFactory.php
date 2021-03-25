<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\GameUserInfo;
use Faker\Generator as Faker;

$factory->define(GameUserInfo::class, function (Faker $faker) {
    return [
        'name' => $faker->userName(),
        'coin' => $faker->numberBetween(0, 10000),
        'highscore' => $faker->numberBetween(0, 10000),
        'is_skipped' => $faker->numberBetween(0, 1),
        'avatars_id' => $faker->numberBetween(1, 9),
        'patient_accounts_id' => $faker->numberBetween(1, 9)
    ];
});
