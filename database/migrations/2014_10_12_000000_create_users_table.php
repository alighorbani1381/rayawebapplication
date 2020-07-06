<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{


    # Create User Table
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('lastname');
            $table->string('phone')->unique()->nullable();
            $table->string('address')->nullable();
            $table->string('profile')->default('default');
            $table->enum('type', ['admin', 'contractor']);
            $table->string('username')->unique()->nullable();
            $table->string('password')->nullable();
            $table->timestamps();
        });
    }

    # Drop User Table
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
