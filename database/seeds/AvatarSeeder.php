<?php

use Illuminate\Database\Seeder;
use App\Common;
use Carbon\Carbon;

class AvatarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        foreach(Common::$avatars as $name => $cost){
            DB::table('avatars')->insert([
                'name' => $name,
                'cost' => $cost,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
        
        
    }
}
