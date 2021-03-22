<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'email' => 'test@gmail.com',
            'password' => Hash::make('abcd1234'),
            'sq_one_q' => '01',
            'sq_two_q' => '01',
            'sq_one_a' => 'bamm',
            'sq_two_a' => 'Alor Setar'
        ]);
    }
}
