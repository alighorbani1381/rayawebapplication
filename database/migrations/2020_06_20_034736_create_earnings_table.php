<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEarningsTable extends Migration
{

    # Create Earning Table
    public function up()
    {
        Schema::create('earnings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('generator')->unsigned();;
            $table->integer('project_id')->unsigned();
            $table->string('title');
            $table->text('description')->nullable();
            $table->integer('received_money');
            $table->enum('status', ['paid', 'unpaid'])->default('unpaid');
            $table->timestamps();
        });
    }

    # Drop Earning Table
    public function down()
    {
        Schema::dropIfExists('earnings');
    }
}
