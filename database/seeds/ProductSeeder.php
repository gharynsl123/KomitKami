<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product')->insert([
            'name' => 'handphone',
            'price' => '2500000',
            'stok' => '10',
            'code' => 'CU032',
            'brand_id' => 3,
            'created_at' => Carbon::now(),
        ]);
        DB::table('product')->insert([
            'name' => 'calender',
            'price' => '150000',
            'stok' => '25',
            'code' => 'CU012',
            'brand_id' => 3,
            'created_at' => Carbon::now(),
        ]);
        DB::table('product')->insert([
            'name' => 'botol taperware',
            'price' => '200000',
            'stok' => '90',
            'code' => 'CU090',
            'brand_id' => 2,
            'created_at' => Carbon::now(),
        ]);
    }
}
