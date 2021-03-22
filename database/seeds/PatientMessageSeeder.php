<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PatientMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('patient_messages')->insert([
            'score' => 7,
            'message'  => 'Pain at head',
            'is_solved'=> 0,
            'patient_accounts_id' => 1,
            'patient_profiles_id' =>1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('patient_messages')->insert([
            'score' => 3,
            'message'  => 'Pain at hand',
            'is_solved'=> 0,
            'patient_accounts_id' => 1,
            'patient_profiles_id' =>1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
