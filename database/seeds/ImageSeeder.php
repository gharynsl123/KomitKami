<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $images = [
            ['file_name' => 'gudang.jpeg', 'title' => 'gudang '],
            ['file_name' => 'chemical-room.jpeg', 'title' => 'chemicalroom '],
            ['file_name' => 'komitkami-trainig.jpeg', 'title' => 'komitkamitrainig '],
            ['file_name' => 'laboratorium-micro.jpeg', 'title' => 'laboratoriummicro '],
            ['file_name' => 'mixing-room.jpeg', 'title' => 'mixingroom '],
            ['file_name' => 'parkir.jpeg', 'title' => 'parkir '],
            ['file_name' => 'produki-3.jpeg', 'title' => 'produki3 '],
            ['file_name' => 'produksi-3.jpeg', 'title' => 'produksi3 '],
            ['file_name' => 'produksi-4.jpeg', 'title' => 'produksi4 '],
            ['file_name' => 'produksi-5.jpeg', 'title' => 'produksi5 '],
            ['file_name' => 'quality-control.jpeg', 'title' => 'qualitycontrol '],
            ['file_name' => 'raw-meterial.jpeg', 'title' => 'rawmeterial '],
            ['file_name' => 'reiceiving.jpeg', 'title' => 'reiceiving '],
            ['file_name' => 'where-house.jpeg', 'title' => 'wherehouse '],
            ['file_name' => 'waste-things.jpeg', 'title' => 'wastethings '],

        ];

        foreach ($images as $image) {
            // Dapatkan path lengkap gambar di storage/app/public/images
            $path = 'images/' . $image['file_name'];

            DB::table('images')->insert([
                'file_name' => $image['file_name'],
                'title' => $image['title'],
                'path' => $path,
            ]);
        }

    }
}