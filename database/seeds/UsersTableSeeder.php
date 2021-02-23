<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            'name' => 'Aleksej',
            'email' => 'vasilenko75@gmail.com',
            'password' => bcrypt('Qwerty1!'),
            'role' => 10,
        ]);
    }
}
