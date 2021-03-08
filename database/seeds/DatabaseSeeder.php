<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $this->call([
            AvatarSeeder::class,
            BadgeSeeder::class,
            UserSeeder::class,
            UserProfileSeeder::class,
            PatientProfileSeeder::class,
            PatientAccountSeeder::class,
            GameUserInfoSeeder::class,
            PatientGuardianProfileSeeder::class,
            PatientReportSeeder::class,
            PatientMessageSeeder::class,
        ]);
    }
}
