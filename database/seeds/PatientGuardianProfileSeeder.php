<?php

use Illuminate\Database\Seeder;

class PatientGuardianProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('patient_guardian_profiles')->insert([
            'first_name' => 'Amos',
            'last_name' => 'Jensen',
            'ic_number' => '872203021212',
            'relations' => '01',
            'contact' => '0123456789',
            'address_one' => '32, Jalan Desa Permai',
            'address_two' => 'Taman Desa Permai',
            'postcode' => '04550',
            'state' => '01',
            'city' => 'Kajang',
            'patient_profiles_id' => 1
        ]);
    }
}
