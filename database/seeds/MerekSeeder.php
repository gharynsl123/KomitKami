<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class MerekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('brand')->insert([
            'name' => 'ataru',
            'id_instansi' => 2,
            'created_at' => Carbon::now(),
        ]);
        DB::table('brand')->insert([
            'name' => 'medetic',
            'id_instansi' => 1,
            'created_at' => Carbon::now(),
        ]);
        DB::table('brand')->insert([
            'name' => 'indah kencana',
            'id_instansi' => 1,
            'created_at' => Carbon::now(),
        ]);
    }
}
