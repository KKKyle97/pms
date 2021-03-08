<?php

use Illuminate\Database\Seeder;

class GameUserInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('game_user_infos')->insert([
            'name' => 'acac',
            'coin' => 0,
            'highscore' => 0,
            'is_skipped' => 0,
            'avatars_id' => 1,
            'patient_accounts_id' => 1
        ]);
    }
}
