<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PatientReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('patient_reports')->insert([
            'body_part' => 'head',
            'level' => 3,
            'description' => 'Stabbing',
            'duration' => 30,
            'mood' => 2,
            'patient_accounts_id' => 1,
            'patient_profiles_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('patient_reports')->insert([
            'body_part' => 'head',
            'level' => 5,
            'description' => 'Burning',
            'duration' => 30,
            'mood' => 5,
            'patient_accounts_id' => 1,
            'patient_profiles_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('patient_reports')->insert([
            'body_part' => 'hand',
            'level' => 9,
            'description' => 'Burning',
            'duration' => 10,
            'mood' => 2,
            'patient_accounts_id' => 1,
            'patient_profiles_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
