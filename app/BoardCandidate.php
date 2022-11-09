<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BoardCandidate extends Model
{
    protected $table = 'board_candidates';
    protected $fillable = ['id', 'board_name', 'total_candidate', 'status', 'created_at', 'updated_at', 'deleted_at', 'deleted_by'];

}
