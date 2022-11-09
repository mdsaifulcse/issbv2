<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamConfig extends Model
{
    protected $table = 'exam_configs';
    protected $fillable = ['id', 'board_candidate_id', 'exam_date', 'exam_start_time', 'exam_end_time', 'exam_duration', 'running_time', 'guest_time_duration', 'test_config_id', 'assign_to', 'exam_status', 'preview_status', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by', 'deleted_at', 'deleted_by'];

}
