<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBagianKebersihanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bagian_kebersihan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ruang_produksi_id');
            $table->string('nama_bagian'); // Contoh: "Timbangan", "Lantai", dll.
            $table->foreign('ruang_produksi_id')->references('id')->on('ruang_produksi')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bagian_kebersihan');
    }
}
