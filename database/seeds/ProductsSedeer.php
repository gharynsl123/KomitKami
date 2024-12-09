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
        // HANDSCRUB
        DB::table('product')->insert([
            'name' => 'Alkessi Handscrub 100ML',
            'price'=> 'Rp 17.000,00',
            'code' => 'ALK-SCR-100-016',
            'stok' => '',
            'tipe' => 'botol',
            'photo' => '',
            'brand_id' => '1',
            'created_at' => Carbon::now(),
        ]);
        DB::table('product')->insert([
            'name' => 'Alkessi Handscrub 500ML',
            'price'=> 'Rp 69.000,00',
            'code' => 'ALK-SCR-500-011',
            'stok' => '',
            'tipe' => 'botol',
            'photo' => '',
            'brand_id' => '1',
            'created_at' => Carbon::now(),
        ]);
        DB::table('product')->insert([
            'name' => 'Alkessi Handscrub 5L',
            'price'=> 'Rp 516.000,00',
            'code' => 'ALK-SCR-5000-304',
            'stok' => '',
            'tipe' => 'jerigen',
            'photo' => '',
            'brand_id' => '1',
            'created_at' => Carbon::now(),
        ]);

        // CLEANZYME
        DB::table('product')->insert([
            'name' => 'Alkessi Cleanzyme 100ML',
            'price'=> 'Rp 9.000,00',
            'code' => 'ALK-CLE-100-001',
            'stok' => '',
            'tipe' => 'botol',
            'photo' => '',
            'brand_id' => '1',
            'created_at' => Carbon::now(),
        ]);
        DB::table('product')->insert([
            'name' => 'Alkessi Cleanzyme 5L',
            'price'=> 'Rp 551.300,00',
            'code' => 'ALK-CLE-5000-306',
            'stok' => '',
            'tipe' => 'jerigen',
            'photo' => '',
            'brand_id' => '1',
            'created_at' => Carbon::now(),
        ]);

        // DESCLEANZYME
        DB::table('product')->insert([
            'name' => 'Alkessi Descleanzyme 5L',
            'price'=> 'Rp 964.000,00',
            'code' => 'ALK-DSCL-5000-307',
            'stok' => '',
            'tipe' => 'jerigen',
            'photo' => '',
            'brand_id' => '1',
            'created_at' => Carbon::now(),
        ]);

        // GLU
        DB::table('product')->insert([
            'name' => 'Alkessi Glu 5L',
            'price'=> 'Rp 149.000,00',
            'code' => 'ALK-GLU-5000-309',
            'stok' => '',
            'tipe' => 'jerigen',
            'photo' => '',
            'brand_id' => '1',
            'created_at' => Carbon::now(),
        ]);

        // SURF
        DB::table('product')->insert([
            'name' => 'Alkessi Surf 750ML',
            'price'=> 'Rp 76.500,00',
            'code' => 'ALK-SUR-750-308',
            'stok' => '',
            'tipe' => 'botol',
            'photo' => '',
            'brand_id' => '1',
            'created_at' => Carbon::now(),
        ]);

        // DESSURF
        DB::table('product')->insert([
            'name' => 'Alkessi Dessurf 100ML',
            'price'=> 'Rp 23.000,00',
            'code' => 'ALK-DSUR-100-311',
            'stok' => '',
            'tipe' => 'botol',
            'photo' => '',
            'brand_id' => '1',
            'created_at' => Carbon::now(),
        ]);
        DB::table('product')->insert([
            'name' => 'Alkessi Dessurf 5L',
            'price'=> 'Rp 690.700,00',
            'code' => 'ALK-DSUR-5000-310',
            'stok' => '',
            'tipe' => 'jerigen',
            'photo' => '',
            'brand_id' => '1',
            'created_at' => Carbon::now(),
        ]);

        // HANDRUB
        DB::table('product')->insert([
            'name' => 'Alkessi Handrub 500ML',
            'price'=> 'Rp 7.700,00',
            'code' => 'ALK-RUB-500-303',
            'stok' => '',
            'tipe' => 'botol',
            'photo' => '',
            'brand_id' => '1',
            'created_at' => Carbon::now(),
        ]);
        DB::table('product')->insert([
            'name' => 'Alkessi Handrub 5L',
            'price'=> 'Rp 33.000,00',
            'code' => 'ALK-RUB-5000-302',
            'stok' => '',
            'tipe' => 'jerigen',
            'photo' => '',
            'brand_id' => '1',
            'created_at' => Carbon::now(),
        ]);

        // DESAS
        DB::table('product')->insert([
            'name' => 'Alkessi DesAS Campuran 5L',
            'price'=> 'Rp 208.700,00',
            'code' => 'ALK-RUB-5000-302',
            'stok' => '',
            'tipe' => 'jerigen',
            'photo' => '',
            'brand_id' => '1',
            'created_at' => Carbon::now(),
        ]);
        DB::table('product')->insert([
            'name' => 'Alkessi DesAS Komitkami 5L',
            'price'=> 'Rp 450.450,00',
            'code' => 'ALK-RUB-5000-303',
            'stok' => '',
            'tipe' => 'jerigen',
            'photo' => '',
            'brand_id' => '1',
            'created_at' => Carbon::now(),
        ]);

        // RINSE AID
        DB::table('product')->insert([
            'name' => 'Alkessi Rinse Aid 100ML',
            'price'=> 'Rp 5.400,00',
            'code' => 'ALK-RIN-5000-313',
            'stok' => '',
            'tipe' => 'botol',
            'photo' => '',
            'brand_id' => '1',
            'created_at' => Carbon::now(),
        ]);
        DB::table('product')->insert([
            'name' => 'Alkessi Rinse Aid 5L',
            'price'=> 'Rp 135.000,00',
            'code' => 'ALK-RIN-5000-312',
            'stok' => '',
            'tipe' => 'jerigen',
            'photo' => '',
            'brand_id' => '1',
            'created_at' => Carbon::now(),
        ]);

        // CHRONA CARE
        // HAND RUB
        DB::table('product')->insert([
            'name'=>'Chrona Care Hand Rub 500ML',
            'price' => 'Rp 28.681,00',
            'code' => 'CHR-RUB-500-102',
            'stok' => '',
            'tipe' => 'botol',
            'photo' => '',
            'brand_id' => '2',
            'created_at' => Carbon::now(),
        ]);
        DB::table('product')->insert([
            'name'=>'Chrona Care Hand Rub 5L',
            'price' => 'Rp 160.000,00',
            'code' => 'CHR-RUB-5000-102',
            'stok' => '',
            'tipe' => 'jerigen',
            'photo' => '',
            'brand_id' => '2',
            'created_at' => Carbon::now(),
        ]);

        // HAND SCRUB
        DB::table('product')->insert([
            'name'=>'Chrona Care Hand Scrub 500ML',
            'price' => 'Rp 43.480,92',
            'code' => 'CHR-SCRB-500-104',
            'stok' => '',
            'tipe' => 'botol',
            'photo' => '',
            'brand_id' => '2',
            'created_at' => Carbon::now(),
        ]);
        DB::table('product')->insert([
            'name'=>'Chrona Care Hand Scrub 5L',
            'price' => 'Rp 309.931,98',
            'code' => 'CHR-SCRB-5000-105',
            'stok' => '',
            'tipe' => 'jerigen',
            'photo' => '',
            'brand_id' => '2',
            'created_at' => Carbon::now(),
        ]);

        // MEDIZSISMA
        // HAND SCRUB
        DB::table('product')->insert([
            'name' => 'Medizsisma Hand Scrub 75ML',
            'price' => 'Rp 17.600,00',
            'code' => 'MIB-SCRB-500-011',
            'stok' => '',
            'tipe' => 'botol',
            'photo' => '',
            'brand_id' => '3',
            'created_at' => Carbon::now(),
        ]);
        DB::table('product')->insert([
            'name' => 'Medizsisma Hand Scrub 500ML',
            'price' => 'Rp 71.700,00',
            'code' => 'MIB-SCRB-500-011',
            'stok' => '',
            'tipe' => 'botol',
            'photo' => '',
            'brand_id' => '3',
            'created_at' => Carbon::now(),
        ]);
        DB::table('product')->insert([
            'name' => 'Medizsisma Hand Scrub 5L',
            'price' => 'Rp 560.100,00',
            'code' => 'MIB-SCRB-5000-012',
            'stok' => '',
            'tipe' => 'jerigen',
            'photo' => '',
            'brand_id' => '3',
            'created_at' => Carbon::now(),
        ]);

        // HAND RUB
        DB::table('product')->insert([
            'name' => 'Medizsisma Hand Rub 100ML',
            'price' => 'Rp 15.880,00',
            'code' => 'CHR-RUB-100-100',
            'stok' => '',
            'tipe' => 'botol',
            'photo' => '',
            'brand_id' => '3',
            'created_at' => Carbon::now(),
        ]);
        DB::table('product')->insert([
            'name' => 'Medizsisma Hand Rub 500ML',
            'price' => 'Rp 54.800,00',
            'code' => 'CHR-RUB-100-100',
            'stok' => '',
            'tipe' => 'botol',
            'photo' => '',
            'brand_id' => '3',
            'created_at' => Carbon::now(),
        ]);
        DB::table('product')->insert([
            'name' => 'Medizsisma Hand Rub 5L',
            'price' => 'Rp 331.700,00',
            'code' => 'CHR-RUB-100-100',
            'stok' => '',
            'tipe' => 'jerigen',
            'photo' => '',
            'brand_id' => '3',
            'created_at' => Carbon::now(),
        ]);

        // HAND RUB GEL
        DB::table('product')->insert([
            'name' => 'Medizsisma Hand Rub Gel 100ML',
            'price' => 'Rp 17.200,00',
            'code' => 'MIB-RUBG-5000-008',
            'stok' => '',
            'tipe' => 'botol',
            'photo' => '',
            'brand_id' => '3',
            'created_at' => Carbon::now(),
        ]);
        DB::table('product')->insert([
            'name' => 'Medizsisma Hand Rub Gel 500ML',
            'price' => 'Rp 61.100,00',
            'code' => 'MIB-RUBG-500-007',
            'stok' => '',
            'tipe' => 'botol',
            'photo' => '',
            'brand_id' => '3',
            'created_at' => Carbon::now(),
        ]);
        DB::table('product')->insert([
            'name' => 'Medizsisma Hand Rub Gel 5L',
            'price' => 'Rp 323.000,00',
            'code' => 'MIB-RUBG-5000-008',
            'stok' => '',
            'tipe' => 'jerigen',
            'photo' => '',
            'brand_id' => '3',
            'created_at' => Carbon::now(),
        ]);
    }
}
