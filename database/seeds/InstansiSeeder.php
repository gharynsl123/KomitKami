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
            'name' => 'PT. Prima Alkessindo Nusantara',
            'nomor_telepon' => '(021)4513875',
            'alamat' => 'Jl. Raya Gading Kirana No.12-15 Blok C, RT.18/RW.8, West Kelapa Gading, Kelapa Gading, North Jakarta City, Jakarta 14240',
            'created_at' => Carbon::now(),
        ]);
        DB::table('instansi')->insert([
            'name' => 'PT. Buana Intiprima Usaha',
            'nomor_telepon' => '(021)54342101',
            'alamat' => 'Pergudangan Green Sedayu Bizpark Daan Mogot Blok DM 6 No.3, Kel. Semanan, Kec. Kalideres',
            'created_at' => Carbon::now(),
        ]);
        DB::table('instansi')->insert([
            'name' => 'PT. Mediza Insan Batavia',
            'nomor_telepon' => '(021)88882076',
            'alamat' => 'Komp. Ruko Harapan Indah, Jl. Aster Indah 5 Blok FA-29, RT.004/RW.017, Pejuang, Kecamatan Medan Satria, Kota Bks, Jawa Barat 17131',
            'created_at' => Carbon::now(),
        ]);
    }
}
