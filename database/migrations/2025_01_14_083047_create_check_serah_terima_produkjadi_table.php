<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckSerahTerimaProdukjadiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_serah_terima_produkjadi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('produksi_id');
            $table->foreign('produksi_id')->references('id')->on('produksi')->onDelete('cascade');
            $table->unsignedBigInteger('serah_terima_id')->nullable();
            $table->foreign('serah_terima_id')->references('id')->on('serah_terima_produkjadi')->onDelete('cascade');
            $table->integer('nilai_actual');
            $table->string('operator')->nullable();
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
        Schema::dropIfExists('check_serah_terima_produkjadi');
    }
}
