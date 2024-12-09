<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produksi', function (Blueprint $table) {
            $table->id();
            $table->string('batch_number');
            $table->string('batch_size');
            $table->date('tanggal_produksi');
            $table->string('tanggal_expired');
            $table->string('acuan_barang_jadi');
            $table->string('total_barang_jadi')->nullable();

            $table->enum('status', ['pending', 'open', 'confirm', 'on-going', 'close', 'failed']);

            $table->unsignedBigInteger('brand_id')->unsigned();
            $table->foreign('brand_id')->references('id')->on('brand')->onDelete('cascade');

            $table->unsignedBigInteger('invoice_id')->nullable()->unsigned();
            $table->foreign('invoice_id')->references('id')->on('invoice')->onDelete('cascade');

            $table->unsignedBigInteger('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('product')->onDelete('cascade');

            $table->unsignedBigInteger('formula_id')->unsigned();
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
        Schema::dropIfExists('produksi');
    }
}
