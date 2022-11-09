<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate_exams', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('candidate_id')->comment('FK:candidates.id')->nullable();
            $table->integer('board_id')->comment('FK:boards.id')->nullable();
            $table->date('exam_date')->comment('Exam Date')->nullable();
            $table->integer('exam_duration')->comment('Exam Duration by Minutes')->nullable();
            $table->time('start_time')->comment('Exam Start Time')->nullable();
            $table->time('end_time')->comment('Exam End Time')->nullable();
            $table->time('running_exam_time')->comment('Running Exam time')->nullable();
            $table->integer('remaining_exam_duration')->comment('Remaining Exam Duration by Minutes')->nullable();
            $table->tinyInteger('exam_status')->default(0)->comment('0=Not Running, 1=Running, 2=Finished/Completed, 3=Hold');
            $table->tinyInteger('status')->default(1)->comment('1=Active, 0=Inactive');
            $table->string('created_by')->comment('FK:candidates.id')->nullable();
            $table->string('updated_by')->comment('FK:candidates.id')->nullable();
            $table->string('deleted_by')->comment('FK:candidates.id')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('candidate_exams');
    }
}
