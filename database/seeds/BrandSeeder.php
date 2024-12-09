<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;


class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('brand')->insert([
            'name' => 'Alkessi',
            'id_user' => '1',
            'created_at' => Carbon::now(),
        ]);
        DB::table('brand')->insert([
            'name' => 'Chrona Care            ',
            'id_user' => '2',
            'created_at' => Carbon::now(),
        ]);
        DB::table('brand')->insert([
            'name' => 'Medizsisma',
            'id_user' => '3',
            'created_at' => Carbon::now(),
        ]);
    }
}
