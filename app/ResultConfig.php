<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResultConfig extends Model
{
   protected $table='result_configs';
   protected $fillable=['test_id','test_config_id','raw_score','estimated_score','pass_mark','created_at','created_by'];
}
