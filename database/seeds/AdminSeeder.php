<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

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
            'address' => 'duta bumi satu',
            'phone_number' => '081232153',
            'password' => Hash::make('password123'),
            'view_pass' => 'password123',
            'created_at' => Carbon::now(),
        ]);
    }
}
