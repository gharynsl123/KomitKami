<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class MarkomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Yufus Qullah',
            'username' => 'yusur',
            'level' => 'Marketing Communication',
            'email' => 'yufus.qullah@gharyn.com',
            'address' => 'none',
            'phone_number' => '0812897367453',
            'password' => Hash::make('Yufus Qullah'),
            'view_pass' => 'Yufus Qullah',
            'created_at' => Carbon::now(),
        ]);
    }
}
