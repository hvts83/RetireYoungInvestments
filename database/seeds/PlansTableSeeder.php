<?php

use Illuminate\Database\Seeder;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('plans')->insert([
            'name' => 'Premium $1.5k',
            'price' => 1500,
            'time' => 180,
            'referal_earning' => 0.1,
            'daily' => 10,
        ]);
    }
}
