<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'image_id' => 1,
            'username' => 'user',
            'email' => 'user@examplemail.com',
            'password' => bcrypt('secret'),
            'name' => 'John Doe',
            'birthday' => '2018-10-05',
            'country' => 2,
            'address' => str_random(30),
        ]);
    }
}
