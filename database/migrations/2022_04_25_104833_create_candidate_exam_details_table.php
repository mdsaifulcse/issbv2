<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidateExamDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate_exam_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('sl_no')->comment('serial_no')->nullable();
            $table->integer('candidate_exam_id')->comment('FK:candidate_exams.id')->nullable();
            $table->integer('candidate_id')->comment('FK:candidates.id')->nullable();
            $table->integer('item_bank_id')->comment('FK:item_banks.id')->nullable();
            $table->integer('sub_item_bank_id')->comment('FK:item_banks.sub_questions.index')->nullable();
            $table->tinyInteger('question_status')->default(0)->comment('0=Main Question, 1=Sub-Questions');
            $table->integer('item_type')->comment('comment pending')->nullable();
            $table->integer('option_type')->comment('comment pending')->nullable();
            $table->text('question')->nullable();
            $table->text('options')->nullable();
            $table->integer('correct_answer_id')->comment('Options Array index id 0,1,2..')->nullable();
            $table->integer('answer_id')->comment('Options Array index id 0,1,2..')->nullable();
            $table->tinyInteger('answer_status')->default(1)->comment('1=Correct Answer, 0=In-Correct Answer');
            $table->tinyInteger('running_question_status')->default(1)->comment('1=Yes, 0=No');
            $table->tinyInteger('status')->default(0)->comment('0=Pending, 1=Answered');
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
        Schema::dropIfExists('candidate_exam_details');
    }
}
