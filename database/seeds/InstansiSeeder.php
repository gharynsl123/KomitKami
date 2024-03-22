<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class InstansiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('instansi')->insert([
            'name' => 'PT buana intiprima usaha',
            'alamat' => 'Jl. Daan Mogot VI No.3, RT.11/RW.6, Kalideres, Kec. Kalideres, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11840',
            'nomor_telepon' => '0812-5464-9951',
            'created_at' => Carbon::now(),
        ]);
        DB::table('instansi')->insert([
            'name' => 'PT prima alkesindo nusantara',
            'alamat' => 'Jl. Raya Gading Kirana No.12-15 Blok C, RT.18/RW.8, West Kelapa Gading, Kelapa Gading, North Jakarta City, Jakarta 14240',
            'nomor_telepon' => '(021) 4513875',
            'created_at' => Carbon::now(),
        ]);
        DB::table('instansi')->insert([
            'name' => 'PT. MEDIZA INSAN BATAVIA',
            'alamat' => 'Komp. Ruko Harapan Indah, Jl. Aster Indah 5 Blok FA-29, RT.004/RW.017, Pejuang, Kecamatan Medan Satria, Kota Bks, Jawa Barat 17131',
            'nomor_telepon' => '(021) 88882076',
            'created_at' => Carbon::now(),
        ]);
    }
}
