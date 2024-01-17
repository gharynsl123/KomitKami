<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CostumerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Nadia Alina',
            'username' => 'linda',
            'level' => 'Customer',
            'email' => 'nadia@gmail.com',
            'address' => 'pramata',
            'phone_number' => '0871623423',
            'password' => Hash::make('nadia123'),
            'view_pass' => 'nadia123',
            'created_at' => Carbon::now(),
        ]);
    }
}
