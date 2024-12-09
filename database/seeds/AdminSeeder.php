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
            'name' => 'PT PRIMA ALKESINDO',
            'username' => 'alkesi',
            'level' => 'Customer',
            'email' => 'prima@gmail.com',
            'address' => 'none',
            'password' => Hash::make('prima1'),
            'view_pass' => 'prima1',
            'created_at' => Carbon::now(),
        ]);
        DB::table('users')->insert([
            'name' => 'PT BUANA INTIPRIMA USAHA',
            'username' => 'chrona',
            'level' => 'Customer',
            'email' => 'chrona@gmail.com',
            'address' => 'none',
            'password' => Hash::make('buana1'),
            'view_pass' => 'buana1',
            'created_at' => Carbon::now(),
        ]);
        DB::table('users')->insert([
            'name' => 'PT MEDIZA INSAN BATAVIA',
            'username' => 'medisisma',
            'level' => 'Customer',
            'email' => 'mediza@gmail.com',
            'address' => 'none',
            'password' => Hash::make('mediza1'),
            'view_pass' => 'mediza1',
            'created_at' => Carbon::now(),
        ]);
        DB::table('users')->insert([
            'name' => 'PT KOMITKAMI INTINUSA GEMILANG',
            'username' => 'KING',
            'level' => 'Customer',
            'email' => 'komitkami@gmail.com',
            'address' => 'none',
            'password' => Hash::make('komitkami1'),
            'view_pass' => 'komitkami1',
            'created_at' => Carbon::now(),
        ]);
        DB::table('users')->insert([
            'name' => 'ANANDA GHARYN',
            'username' => 'Admin',
            'level' => 'admin',
            'email' => 'persolna1243@gmail.com',
            'address' => 'none',
            'password' => Hash::make('password123'),
            'view_pass' => 'password123',
            'created_at' => Carbon::now(),
        ]);
        DB::table('users')->insert([
            'name' => 'Employer',
            'username' => 'employe',
            'level' => 'employe',
            'email' => 'employe@gmail.com',
            'address' => 'none',
            'password' => Hash::make('employe123'),
            'view_pass' => 'employe123',
            'created_at' => Carbon::now(),
        ]);
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
        DB::table('users')->insert([
            'name' => 'nila sara',
            'username' => 'sara',
            'level' => 'production manager',
            'email' => 'okoklatinan@gmail.com',
            'address' => 'none',
            'phone_number' => '081289736934',
            'password' => Hash::make('nila sara'),
            'view_pass' => 'nila sara',
            'created_at' => Carbon::now(),
        ]);
        DB::table('users')->insert([
            'name' => 'Yuda Nusiro',
            'username' => 'spvuser',
            'level' => 'production spv',
            'email' => 'spvuser@gmail.com',
            'address' => 'none',
            'phone_number' => '0812736934',
            'password' => Hash::make('spvuser123'),
            'view_pass' => 'spvuser123',
            'created_at' => Carbon::now(),
        ]);
        DB::table('users')->insert([
            'name' => 'adnan khairull',
            'username' => 'inventory',
            'level' => 'inventory manager',
            'email' => 'inventory@gmail.com',
            'address' => 'none',
            'phone_number' => '081232736934',
            'password' => Hash::make('inventory234'),
            'view_pass' => 'inventory234',
            'created_at' => Carbon::now(),
        ]);
    }
}