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
            $table->string('photo')->nullable();
            $table->string('phone_number')->unique()->nullable();
            $table->string('address')->nullable();
            $table->enum('level', ['Customer', 'Production Manager', 'Inventory Manager', 'Seles', 'Supervisor', 'Producer', 'Admin'])->default('Producer');
            $table->string('email')->unique();
            $table->string('last_seen')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('view_pass');
            
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
