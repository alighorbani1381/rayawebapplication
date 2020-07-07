<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{

    
    public function up()
    {
        # Create Project Tables
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');

            //Dependency Data
            $table->integer('project_creator'); // admin create project
            $table->integer('taskmaster');
            $table->string('unique_id')->unique()->index();

            // Detail
            $table->string('title')->index();
            $table->text('description');
            $table->integer('price')->unsigned();

            // Contract Data
            $table->string('contract_image')->default('default');
            $table->date('contract_started');
            $table->date('contract_ended');

            //Status
            $table->enum('status', ['waiting', 'ongoing', 'finished']);

            //Date Data
            $table->date('date_start');
            $table->integer('complete_after');
            $table->timestamps();
        });

        # Create Pivot Table Connect Category to Project
        Schema::create('project_category', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('project_id')->unsigned();
            $table->integer('category_id')->unsigned();
        });

        # Create Pivot Table Connect Contractor to Project
        Schema::create('project_contractor', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('project_id')->unsigned();
            $table->integer('contractor_id')->unsigned();
            $table->integer('progress_access')->unsigned()->nullable();
            $table->integer('progress')->unsigned()->nullable();
        });

        # Create Continue of Project Table save taskmasterinfo
        Schema::create('project_taskmaster', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('lastname');
            $table->string('father_name');
            $table->string('meli_code');
            $table->string('meli_image')->default('default');
            $table->string('phone');
            $table->string('address');
        });
    }


    # Drop Projects Table
    public function down()
    {
        Schema::dropIfExists('projects');
        Schema::dropIfExists('project_category');
        Schema::dropIfExists('project_contractor');
        Schema::dropIfExists('project_taskmaster');
    }
}
