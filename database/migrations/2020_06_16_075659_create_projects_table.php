<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');

            //Dependency Data
            $table->integer('project_creator'); // admin create project
            $table->integer('taskmaster');
            $table->string('unique_id')->unique()->index();

            // Detail
            $table->string('title')->index();
            $table->string('description');
            $table->integer('price');

            // Contract
            $table->integer('contract_image');
            $table->integer('contract_started');

            //Status & Progress
            $table->enum('status', ['waiting', 'ongoing', 'finished']);
            $table->integer('progress');

            //Date Data
            $table->date('date_start');
            $table->integer('complete_after');
            $table->timestamps();
        });

        Schema::create('project_category', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('project_id');
            $table->integer('category_id');
        });

        Schema::create('project_contractor', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('project_id');
            $table->integer('contractor_id');
            $table->integer('progress_access');
            $table->integer('progress');
        });

        Schema::create('project_taskmaster', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('lastname');
            $table->string('father_name');
            $table->string('meli_code');
            $table->string('meli_image');
            $table->string('phone');
            $table->string('address');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
        Schema::dropIfExists('project_category');
        Schema::dropIfExists('project_contractors');
        Schema::dropIfExists('project_taskmaster');
    }
}
