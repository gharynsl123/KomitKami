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
            'username' => 'alkessi',
            'level' => 'Customer',
            'email' => 'prima@gmail.com',
            'address' => 'none',
            'password' => Hash::make('prima'),
            'view_pass' => 'prima',
            'created_at' => Carbon::now(),
        ]);
        DB::table('users')->insert([
            'name' => 'PT BUANA INTIPRIMA USAHA',
            'username' => 'chronacare',
            'level' => 'Customer',
            'email' => 'chrona@gmail.com',
            'address' => 'none',
            'password' => Hash::make('buana'),
            'view_pass' => 'buana',
            'created_at' => Carbon::now(),
        ]);
        DB::table('users')->insert([
            'name' => 'PT MEDIZA INSAN BATAVIA',
            'username' => 'medizsisma',
            'level' => 'Customer',
            'email' => 'mediza@gmail.com',
            'address' => 'none',
            'password' => Hash::make('mediza'),
            'view_pass' => 'mediza',
            'created_at' => Carbon::now(),
        ]);
        DB::table('users')->insert([
            'name' => 'PT. FRISANSHA ANUGERAH ALKESINDO',
            'username' => 'frisansha',
            'level' => 'Customer',
            'email' => 'frisansha@gmail.com',
            'address' => 'none',
            'password' => Hash::make('dochem'),
            'view_pass' => 'dochem',
            'created_at' => Carbon::now(),
        ]);
        DB::table('users')->insert([
            'name' => 'PT Lami Indo Medika',
            'username' => 'medika',
            'level' => 'Customer',
            'email' => 'medika@gmail.com',
            'address' => 'none',
            'password' => Hash::make('lamiindo'),
            'view_pass' => 'lamiindo',
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
            'level' => 'Admin',
            'email' => 'persolna1243@gmail.com',
            'address' => 'none',
            'password' => Hash::make('password123'),
            'view_pass' => 'password123',
            'created_at' => Carbon::now(),
        ]);
        DB::table('users')->insert([
            'name' => 'Employer',
            'username' => 'employe',
            'level' => 'Producer',
            'email' => 'employe@gmail.com',
            'address' => 'none',
            'password' => Hash::make('employe123'),
            'view_pass' => 'employe123',
            'created_at' => Carbon::now(),
        ]);
        DB::table('users')->insert([
            'name' => 'Pak Bagus',
            'username' => 'bagus',
            'level' => 'Seles',
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
            'level' => 'Production Manager',
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
            'level' => 'Supervisor',
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
            'level' => 'Inventory Manager',
            'email' => 'inventory@gmail.com',
            'address' => 'none',
            'phone_number' => '081232736934',
            'password' => Hash::make('inventory234'),
            'view_pass' => 'inventory234',
            'created_at' => Carbon::now(),
        ]);
    }
}