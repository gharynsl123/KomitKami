<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_invoice');
            $table->string('total_harga');
            
            $table->string('estimate_arrive')->nullable();
            $table->enum('status', ['pending', 'reject', 'settled', 'revisi', 'accept', 'process', 'packaging', 'On The Way', 'done'])->default('pending');
            
            $table->string('slug')->uniq();

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
        Schema::dropIfExists('invoice');
    }
}
