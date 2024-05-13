<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMappingVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mapping_videos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('video_id')->unsigned()->index();
            $table->foreign('video_id')->references('id')->on('videos');
            $table->unsignedBigInteger('employee_id')->unsigned()->index();
            $table->foreign('employee_id')->references('id')->on('employees');
            $table->unsignedBigInteger('department_id')->unsigned()->index();
            $table->foreign('department_id')->references('id')->on('departments');
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
        Schema::dropIfExists('mapping_videos');
    }
}
