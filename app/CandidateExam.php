<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CandidateExam extends Model
{
    protected $fillable = [
        'candidate_id',
        'exam_config_id',
        'instruction_seen_status',
        'demo_exam_status',
        'board_id',
        'exam_date',
        'exam_duration',
        'start_time',
        'end_time',
        'running_exam_time',
        'remaining_exam_duration',
        'exam_status',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $table = 'candidate_exams';
}
