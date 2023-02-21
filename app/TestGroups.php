<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestGroups extends Model
{
    protected $table = 'test_groups';

    const  INTELLIGENCETEST=1;
    const  PERSONALTYTEST=2;
    const  PSYMTEST=3;

    const GROUPNAMES=[1=>'Intelligence Test',2=>'Personality Test',3=>'PSYM Test'];


}
