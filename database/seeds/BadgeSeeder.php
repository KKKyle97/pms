<?php

use Illuminate\Database\Seeder;
use App\Common;
use Carbon\Carbon;

class BadgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        foreach (Common::$badges as $name => $target) {
            DB::table('badges')->insert([
                'name' => $name,
                'target' => $target,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),

            ]);
        }
    }
}
