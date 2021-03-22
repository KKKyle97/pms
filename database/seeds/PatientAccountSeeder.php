<?php

use Illuminate\Database\Seeder;

class PatientAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('patient_accounts')->insert([
            'username' => 'ac123',
            'password' => Hash::make('abcd1234'),
            'patient_profiles_id' => 1,
        ]);
    }
}
