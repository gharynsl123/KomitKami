<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembelianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelian', function (Blueprint $table) {
            $table->id();
            $table->string('Nomor_PO');
            $table->string('quantity');
            $table->string('catatan');
            $table->enum('type', ['cair', 'kering', 'kemasan']);
            $table->enum('satuan', ['liter', 'kilo gram', 'pieces']);

            $table->unsignedBigInteger('brand_id')->unsigned();
            $table->foreign('brand_id')->references('id')->on('brand')->onDelete('cascade');

            $table->unsignedBigInteger('instansi_id')->unsigned();
            $table->foreign('instansi_id')->references('id')->on('instansi')->onDelete('cascade');

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
        Schema::dropIfExists('pembelian');
    }
}
