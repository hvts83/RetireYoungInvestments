<?php

use Illuminate\Database\Seeder;

class User_plansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_plans')->insert([
            'user_id' => 1,
            'plan_id' => 1,
            'daily' => 10,
            'first_payment' => '2018-04-10',
            'end_date' => '2018-07-14',
            'status' => 1
        ]);
    }
}
