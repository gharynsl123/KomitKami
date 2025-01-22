<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction', function (Blueprint $table) {
            $table->id();
            $table->string('vendor')->nullable();
            $table->string('no_invoice')->nullable();
            $table->string('no_bach')->nullable();
            $table->string('nomor_pengambilan')->nullable();
            $table->enum('jenis', ['in', 'out'])->nullable();
            $table->string('keterangan')->nullable();
            $table->string('tanggal_transaksi')->nullable();
            $table->string('tanggal_ed')->nullable();
            $table->string('jumlah_barang');

            $table->unsignedBigInteger('id_tiket')->unsigned()->nullable();
            $table->foreign('id_tiket')->references('id')->on('permintaan_material')->onDelete('cascade');

            $table->unsignedBigInteger('id_user')->unsigned()->nullable();
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            
            $table->unsignedBigInteger('inventory_id')->unsigned();
            $table->foreign('inventory_id')->references('id')->on('inventory')->onDelete('cascade');
            
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
        Schema::dropIfExists('transaction');
    }
}
