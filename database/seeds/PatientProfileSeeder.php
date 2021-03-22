<?php

use Illuminate\Database\Seeder;

class PatientProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('patient_profiles')->insert([
            'first_name' => 'Amis',
            'last_name' => 'Bolder',
            'ic_number'=> '991130103292',
            'gender' => 'F',
            'age' => 9,
            'cancer' => '01',
            'user_profiles_id' => 1,
        ]);
    }
}
