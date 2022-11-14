<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionSet extends Model
{
    protected $table = 'question_set';

    public function setFor(){
        return $this->belongsTo(\App\TestList::class,'item_set_for','id');
    }
}
