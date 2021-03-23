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
            DB::table('badges')->insert([
                'name' => 'C1',
                'type' => 1, 
                'target' => 50,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);

            DB::table('badges')->insert([
                'name' => 'C2',
                'type' => 1, 
                'target' => 100,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);

            DB::table('badges')->insert([
                'name' => 'C3',
                'type' => 1, 
                'target' => 150,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);

            DB::table('badges')->insert([
                'name' => 'R1',
                'type' => 2, 
                'target' => 5,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);

            DB::table('badges')->insert([
                'name' => 'R2',
                'type' => 2, 
                'target' => 8,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);

            DB::table('badges')->insert([
                'name' => 'R3',
                'type' => 2, 
                'target' => 10,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);

            DB::table('badges')->insert([
                'name' => 'A1',
                'type' => 3, 
                'target' => 3,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);

            DB::table('badges')->insert([
                'name' => 'A2',
                'type' => 3, 
                'target' => 5,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);

            DB::table('badges')->insert([
                'name' => 'A3',
                'type' => 3, 
                'target' => 7,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
    }
}
