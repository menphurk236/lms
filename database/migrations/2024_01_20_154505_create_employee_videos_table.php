<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_videos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id')->unsigned()->index();
            $table->foreign('employee_id')->references('id')->on('employees');
            $table->unsignedBigInteger('video_id')->unsigned()->index();
            $table->foreign('video_id')->references('id')->on('videos');
            $table->string('timespent');
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
        Schema::dropIfExists('employee_videos');
    }
}
