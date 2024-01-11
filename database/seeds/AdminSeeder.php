<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Ananda Gharyn',
            'username' => 'gharyn',
            'level' => 'Admin',
            'email' => 'gharyn@gharyn.com',
            'password' => Hash::make('password123'),
        ]);
    }
}
