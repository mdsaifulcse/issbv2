<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConfigInstruction extends Model
{
    const LOGIN='Login';
    const TEST='Test';
    const PRACTICE='Practice';
    const GENERAL='General';
    const START='Start';

    protected $table = 'test_config_instructions';
    protected $fillable = ['id', 'test_config_id', 'text', 'image','instruction_type', 'created_by', 'created_at','updated_at', 'updated_by', 'deleted_at', 'deleted_by'];

    static public function instructionTypes(){
        return [
            self::LOGIN=>self::LOGIN,
            self::TEST=>self::TEST,
            self::PRACTICE=>self::PRACTICE,
            self::GENERAL=>self::GENERAL,
            self::START=>self::START,
        ];
    }

}
