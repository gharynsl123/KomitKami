<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('phone_number')->unique();
            $table->string('address');
            $table->enum('level', ['Customer', 'Production Manager', 'Production QC', 'Marketing Communication', 'Production SPV', 'Employe', 'Admin'])->default('Employe');
            $table->string('email')->unique();
            $table->string('last_seen')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('view_pass');

            $table->unsignedBigInteger('id_instansi')->unsigned()->nullable();
            $table->foreign('id_instansi')->references('id')->on('instansi')->onDelete('cascade');

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
