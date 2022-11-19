<?php

namespace App\Exports;

use App\Candidates;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $boardno;
    public function __construct($boardno){
        $this->boardno = $boardno;
    }

    public function collection()
    {
        $boardno = $this->boardno;
        return Candidates::select('chest_no', 'name', 'secret_key')->where('board_no', $boardno)->get();
    }
}
