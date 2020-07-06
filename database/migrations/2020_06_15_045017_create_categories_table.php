<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
 

    # Create Categories
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('description');
            $table->string('child');
            $table->timestamps();
        });
    }

   # Drop Categories
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
