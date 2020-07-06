<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePivotPermission extends Migration
{

    # Create Permission Role
    public function up()
    {

        Schema::create('permission_role', function (Blueprint $table) {
            $table->integer('permission_id')->unsigned();
            $table->integer('role_id')->unsigned();


            $table->foreign('permission_id')
            ->references('id')
            ->on('permissions');

            $table->foreign('role_id')
            ->references('id')
            ->on('roles');

            $table->primary(['permission_id', 'role_id']);
        });

        Schema::create('role_user', function (Blueprint $table) {
            $table->integer('role_id')->unsigned();
            $table->integer('user_id')->unsigned();

            $table->foreign('role_id')
            ->references('id')
            ->on('roles');

            $table->foreign('user_id')
            ->references('id')
            ->on('users');

            $table->primary(['role_id', 'user_id']);
        });
    }

    # Drop Permission Role
    public function down()
    {
        Schema::dropIfExists('permission_role');
        Schema::dropIfExists('role_user');
    }
}
