<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCostStaticsTable extends Migration
{
  
    # Create Cost Static Table
    public function up()
    {
        Schema::create('cost_statics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->integer('child')->unsigned()->default(0);
            $table->timestamps();
        });
    }

    # Drop Cost Static Table
    public function down()
    {
        Schema::dropIfExists('cost_statics');
    }
}
