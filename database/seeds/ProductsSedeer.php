<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ProductsSedeer extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product')->insert([
            'name' => 'Cleanzyme 5L',
            'price' => 'Rp 611.943,00',
            'code' => 'ALK-CLE-5000-306',
            'stok' => '',
            'photo' => '',
            'brand_id' => '1',
            'created_at' => Carbon::now(),
        ]);
        DB::table('product')->insert([
            'name' => 'DesAS 2L',
            'price' => '',
            'code' => 'ALK-DIS-2000-301',
            'stok' => '',
            'photo' => '',
            'brand_id' => '1',
            'created_at' => Carbon::now(),
        ]);
        DB::table('product')->insert([
            'name' => 'DesAS 5L',
            'price' => 'Rp 306.915,00',
            'code' => 'ALK-RUB-5000-302',
            'stok' => '',
            'photo' => '',
            'brand_id' => '1',
            'created_at' => Carbon::now(),
        ]);
        DB::table('product')->insert([
            'name' => 'DesCleanzyme 5L',
            'price' => 'Rp 1.070.040,00',
            'code' => 'ALK-DSCL-5000-307',
            'stok' => '',
            'photo' => '',
            'brand_id' => '1',
            'created_at' => Carbon::now(),
        ]);
        DB::table('product')->insert([
            'name' => 'Dessurf 5L',
            'price' => 'Rp 765.900,00',
            'code' => 'ALK-DSUR-5000-310',
            'stok' => '',
            'photo' => '',
            'brand_id' => '1',
            'created_at' => Carbon::now(),
        ]);
        DB::table('product')->insert([
            'name' => 'Glu 5L',
            'price' => 'Rp 166.333,50',
            'code' => 'ALK-GLU-5000-309',
            'stok' => '',
            'photo' => '',
            'brand_id' => '1',
            'created_at' => Carbon::now(),
        ]);
        DB::table('product')->insert([
            'name' => 'Hand Rub 500ML',
            'price' => 'Rp 8.547,00',
            'code' => 'ALK-RUB-500-303',
            'stok' => '',
            'photo' => '',
            'brand_id' => '1',
            'created_at' => Carbon::now(),
        ]);
        DB::table('product')->insert([
            'name' => 'Hand Rub 5L',
            'price' => 'Rp 36.630,00',
            'code' => 'ALK-RUB-5000-302',
            'stok' => '',
            'photo' => '',
            'brand_id' => '1',
            'created_at' => Carbon::now(),
        ]);
        DB::table('product')->insert([
            'name' => 'Hand Scrub 500ML',
            'price' => 'Rp 76.590,00',
            'code' => 'ALK-SCR-500-305',
            'stok' => '',
            'photo' => '',
            'brand_id' => '1',
            'created_at' => Carbon::now(),
        ]);
        DB::table('product')->insert([
            'name' => 'Hand Scrub 5L',
            'price' => 'Rp 572.760,00',
            'code' => 'ALK-SCR-5000-304',
            'stok' => '',
            'photo' => '',
            'brand_id' => '1',
            'created_at' => Carbon::now(),
        ]);
        DB::table('product')->insert([
            'name' => 'Rinse Aid 5L',
            'price' => '',
            'code' => 'ALK-RIN-5000-312',
            'stok' => '',
            'photo' => '',
            'brand_id' => '1',
            'created_at' => Carbon::now(),
        ]);
        DB::table('product')->insert([
            'name' => 'Surf 500ML',
            'price' => 'Rp 46.620,00',
            'code' => 'ALK-SUR-500-311',
            'stok' => '',
            'photo' => '',
            'brand_id' => '1',
            'created_at' => Carbon::now(),
        ]);
        DB::table('product')->insert([
            'name' => 'Surf 750ML',
            'price' => 'Rp 94.350,00',
            'code' => 'ALK-SUR-750-308',
            'stok' => '',
            'photo' => '',
            'brand_id' => '1',
            'created_at' => Carbon::now(),
        ]);
        DB::table('product')->insert([
            'name' => 'Disinfectan 2L',
            'price' => 'Rp 131.646,00',
            'code' => 'MIB-DIS-2000-024',
            'stok' => '',
            'photo' => '',
            'brand_id' => '2',
            'created_at' => Carbon::now(),
        ]);
        DB::table('product')->insert([
            'name' => 'Disinfectan 5L',
            'price' => '',
            'code' => 'MIB-DIS-5000-025',
            'stok' => '',
            'photo' => '',
            'brand_id' => '2',
            'created_at' => Carbon::now(),
        ]);
        DB::table('product')->insert([
            'name' => 'Hand Rub Cair 100ML',
            'price' => 'Rp 10.920,18',
            'code' => 'MIB-RUB-100-013',
            'stok' => '',
            'photo' => '',
            'brand_id' => '2',
            'created_at' => Carbon::now(),
        ]);
        DB::table('product')->insert([
            'name' => 'Hand Rub Cair 500ML',
            'price' => 'Rp 37.416,99',
            'code' => 'MIB-RUB-500-003',
            'stok' => '',
            'photo' => '',
            'brand_id' => '2',
            'created_at' => Carbon::now(),
        ]);
        DB::table('product')->insert([
            'name' => 'Hand Rub Cair 5L',
            'price' => 'Rp 248.968,56',
            'code' => 'MIB-RUB-5000-004',
            'stok' => '',
            'photo' => '',
            'brand_id' => '2',
            'created_at' => Carbon::now(),
        ]);
        DB::table('product')->insert([
            'name' => 'Hand Rub Gel 100ML',
            'price' => '',
            'code' => 'MIB-RUBG-100-014',
            'stok' => '',
            'photo' => '',
            'brand_id' => '2',
            'created_at' => Carbon::now(),
        ]);
        DB::table('product')->insert([
            'name' => 'Hand Rub Gel 500ML',
            'price' => 'Rp 36.052,80',
            'code' => 'MIB-RUBG-500-007',
            'stok' => '',
            'photo' => '',
            'brand_id' => '2',
            'created_at' => Carbon::now(),
        ]);
        DB::table('product')->insert([
            'name' => 'Hand Rub Gel 5L',
            'price' => 'Rp 118.140,63',
            'code' => 'MIB-RUBG-5000-008',
            'stok' => '',
            'photo' => '',
            'brand_id' => '2',
            'created_at' => Carbon::now(),
        ]);
        DB::table('product')->insert([
            'name' => 'Hand Scrub 100ML',
            'price' => '',
            'code' => 'MIB-SCRB-100-016',
            'stok' => '',
            'photo' => '',
            'brand_id' => '2',
            'created_at' => Carbon::now(),
        ]);
        DB::table('product')->insert([
            'name' => 'Hand Scrub 500ML',
            'price' => 'Rp 48.786,72',
            'code' => 'MIB-SCRB-500-011',
            'stok' => '',
            'photo' => '',
            'brand_id' => '2',
            'created_at' => Carbon::now(),
        ]);
        DB::table('product')->insert([
            'name' => 'Hand Scrub 5L',
            'price' => 'Rp 304.316,49',
            'code' => 'MIB-SCRB-5000-012',
            'stok' => '',
            'photo' => '',
            'brand_id' => '2',
            'created_at' => Carbon::now(),
        ]);
        DB::table('product')->insert([
            'name' => 'Hand Scrub 75ML',
            'price' => '',
            'code' => 'MIB-SCRB-75-009',
            'stok' => '',
            'photo' => '',
            'brand_id' => '2',
            'created_at' => Carbon::now(),
        ]);
        DB::table('product')->insert([
            'name' => 'Hand Rub 100ML',
            'price' => '',
            'code' => 'CHR-RUB-100-100',
            'stok' => '',
            'photo' => '',
            'brand_id' => '3',
            'created_at' => Carbon::now(),
        ]);
        DB::table('product')->insert([
            'name' => 'Hand Rub 500ML',
            'price' => 'Rp 27.499,99',
            'code' => 'CHR-RUB-500-101',
            'stok' => '',
            'photo' => '',
            'brand_id' => '3',
            'created_at' => Carbon::now(),
        ]);
        DB::table('product')->insert([
            'name' => 'Hand Rub 5L',
            'price' => 'Rp 177.600,00',
            'code' => 'CHR-RUB-5000-102',
            'stok' => '',
            'photo' => '',
            'brand_id' => '3',
            'created_at' => Carbon::now(),
        ]);
        DB::table('product')->insert([
            'name' => 'Hand Scrub 100ML',
            'price' => '',
            'code' => 'CHR-SCRB-100-103',
            'stok' => '',
            'photo' => '',
            'brand_id' => '3',
            'created_at' => Carbon::now(),
        ]);
        DB::table('product')->insert([
            'name' => 'Hand Scrub 500ML',
            'price' => 'Rp 43.480,92',
            'code' => 'CHR-SCRB-500-104',
            'stok' => '',
            'photo' => '',
            'brand_id' => '3',
            'created_at' => Carbon::now(),
        ]);
        DB::table('product')->insert([
            'name' => 'Hand Scrub 5L',
            'price' => 'Rp 309.931,98',
            'code' => 'CHR-SCRB-5000-105',
            'stok' => '',
            'photo' => '',
            'brand_id' => '3',
            'created_at' => Carbon::now(),
        ]);
    }
}
