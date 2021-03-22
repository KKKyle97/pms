<?php

use Illuminate\Database\Seeder;
use App\Common;
use Carbon\Carbon;

class AvatarUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
            DB::table('avatar_user')->insert([
                'avatar_id' => 1,
                'user_id' => 1,
            ]);

            DB::table('avatar_user')->insert([
                'avatar_id' => 2,
                'user_id' => 1,
            ]);
        
    }
}
