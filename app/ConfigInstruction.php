<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConfigInstruction extends Model
{
    protected $table = 'test_config_instructions';
    protected $fillable = ['id', 'test_config_id', 'text', 'image', 'created_at', 'created_by', 'updated_at', 'updated_by', 'deleted_at', 'deleted_by'];

}
