<?php

namespace App;
use App\ItemLevel;

use Illuminate\Database\Eloquent\Model;

class ItemBank extends Model
{
    protected $table = 'item_bank';

    public function itemLevel(){
        return $this->belongsTo(ItemLevel::class,'level','id');
    }
}
