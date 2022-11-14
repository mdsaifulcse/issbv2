<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionSet extends Model
{
    protected $table = 'question_set';

    public function itemFor(){
        return $this->belongsTo(\App\TestList::class,'item_set_for','id');
    }

    public function candidateType(){
        return $this->belongsTo(CandidateType::class,'candidate_type','id');
    }
}
