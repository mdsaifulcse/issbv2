<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class Candidates extends Authenticatable
{
    use EntrustUserTrait;
    protected $table = 'candidates';
    protected $fillable = ['id', 'chest_no', 'secret_key', 'roll_no', 'course', 'board_no', 'name', 'password', 'image', 'gender', 'dob', 'father_name', 'mother_name', 'valid', 'is_logged_in', 'seat_no'];
    protected $hidden = [
        'password',
    ];


}
