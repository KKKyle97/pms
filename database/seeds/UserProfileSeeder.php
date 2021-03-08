<?php

use Illuminate\Database\Seeder;

class UserProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_profiles')->insert([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'ic_number' => '890292023390',
            'gender' => 'M',
            'contact' => '0123456789',
            'role' => '01',
            'email' => 'test@gmail.com',
            'hospital_code' => 'J002',
        ]);
    }
}
