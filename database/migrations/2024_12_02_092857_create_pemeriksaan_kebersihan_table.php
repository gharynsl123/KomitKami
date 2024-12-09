<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemeriksaanKebersihanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemeriksaan_kebersihan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('produksi_id');
            $table->unsignedBigInteger('bagian_kebersihan_id');
            $table->enum('hasil', ['Bersih', 'Kurang Bersih', 'Kotor']); // Enum: "Bersih", "Kurang Bersih", "Kotor"
            $table->enum('status', ['diterima', 'ditolak', 'menunggu'])->default('menunggu');
            $table->string('dibersihkan_oleh'); // Nama petugas
            $table->string('diperiksa_oleh')->nullable(); // Nama QC
            $table->foreign('produksi_id')->references('id')->on('produksi')->onDelete('cascade');
            $table->foreign('bagian_kebersihan_id')->references('id')->on('bagian_kebersihan')->onDelete('cascade');
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
        Schema::dropIfExists('pemeriksaan_kebersihan');
    }
}
