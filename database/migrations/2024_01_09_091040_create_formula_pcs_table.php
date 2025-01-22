<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormulaPcsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formula_pcs', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('product')->onDelete('cascade');
            
            $table->unsignedBigInteger('inventory_id')->unsigned()->nullable();
            $table->foreign('inventory_id')->references('id')->on('inventory')->onDelete('cascade');
            
            $table->unsignedBigInteger('formula_id')->unsigned()->nullable();
            $table->foreign('formula_id')->references('id')->on('formula')->onDelete('cascade');

            $table->string('nama_bahan_baku');
            $table->enum('satuan', ['pcs', 'gram'])->nullable();
            $table->string('jumlah');

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
        Schema::dropIfExists('formula_pcs');
    }
}
