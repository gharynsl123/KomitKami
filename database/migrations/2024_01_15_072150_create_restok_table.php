<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestokTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restok', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_po');
            $table->enum('jenis', ['kering', 'cair', 'kemasan']);
            $table->enum('satuan', ['liter', 'kilogram', 'gram']);
            $table->string('jumlah');
            $table->string('batch_number');
            $table->string('slug')->uniq();
            $table->string('catatan');

            $table->unsignedBigInteger('brand_id')->unsigned();
            $table->foreign('brand_id')->references('id')->on('brand')->onDelete('cascade');

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
        Schema::dropIfExists('restok');
    }
}
