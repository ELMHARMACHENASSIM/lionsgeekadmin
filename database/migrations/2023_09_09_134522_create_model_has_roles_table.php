<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelHasRolesTable extends Migration
{
    public function up()
    {
        Schema::create('model_has_roles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('model_id');
            $table->string('model_type');
            $table->unsignedBigInteger('role_id');
            $table->timestamps();

            // Define foreign keys if needed
            // $table->foreign('model_id')->references('id')->on('your_related_table');
            // $table->foreign('role_id')->references('id')->on('roles');
        });
    }

    public function down()
    {
        Schema::dropIfExists('model_has_roles');
    }
}

