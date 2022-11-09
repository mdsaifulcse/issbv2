<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CandidateExamDetail extends Model
{
    protected $fillable = [
        'sl_no',
        'candidate_exam_id',
        'candidate_id',
        'item_bank_id',
        'sub_item_bank_id',
        'question_status',
        'item_type',
        'option_type',
        'question',
        'options',
        'correct_answer_id',
        'answer_id',
        'answer_status',
        'running_question_status',
        'status',
        'item_status',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $table = 'candidate_exam_details';
}
