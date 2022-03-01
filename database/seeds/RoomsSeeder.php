<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 14; $i++) {
            DB::table('properties')->insert([
                'investment_id' => 1,
                'floor_id' => rand(1, 2),
                'name' => 'Mieszkanie '.rand(3, 10),
                'rooms' => rand(1, 3),
                'area' => rand(10, 50),
                'type' => 0,
                'status' => rand(1, 4)
            ]);
        }
    }
}
