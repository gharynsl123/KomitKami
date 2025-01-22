<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRekonsiliasiBahanKemasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekonsiliasi_bahan_kemas', function (Blueprint $table) {
            $table->id();            
            $table->unsignedBigInteger('produksi_id');
            $table->unsignedBigInteger('formula_id');
            $table->integer('terpakai');
            $table->string('keterangan');
            $table->string('operator');
            $table->foreign('produksi_id')->references('id')->on('produksi')->onDelete('cascade');
            $table->foreign('formula_id')->references('id')->on('formula')->onDelete('cascade');
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
        Schema::dropIfExists('rekonsiliasi_bahan_kemas');
    }
}
