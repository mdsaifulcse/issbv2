<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamConfigStatus extends Model
{
    protected $fillable = [
        'sl_no',
        'status'
    ];

    protected $table = 'exam_config_statuses';


}
