<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestConfiguration extends Model
{
    protected $table = 'test_config';



    public function testFor(){
        return $this->belongsTo(\App\TestList::class,'test_for','id');
    }

}
