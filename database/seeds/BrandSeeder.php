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
            'id_instansi' => '1',
            'created_at' => Carbon::now(),
        ]);
        DB::table('brand')->insert([
            'name' => 'Chrona Care            ',
            'id_instansi' => '2',
            'created_at' => Carbon::now(),
        ]);
        DB::table('brand')->insert([
            'name' => 'Medizsisma',
            'id_instansi' => '3',
            'created_at' => Carbon::now(),
        ]);
    }
}
