<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCostsTable extends Migration
{
    #  Create Costs Table
    public function up()
    {
        Schema::create('costs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('generator')->unsigned();
            $table->integer('project_id')->unsigned()->nullable();
            $table->integer('contractor_id')->unsigned()->nullable();
            $table->string('title');
            $table->text('description');
            $table->integer('money_paid')->unsigned();
            $table->enum('status', ['paid', 'unpaid']);
            $table->string('type')->nullable();
            $table->timestamps();
        });
    }

    #  Drop Costs Table
    public function down()
    {
        Schema::dropIfExists('costs');
    }
}
