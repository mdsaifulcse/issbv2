<?php

namespace App\Imports;

use App\Candidates;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithValidation;

class UsersImport implements ToModel, WithValidation
{
     /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    use Importable;

    public function model(array $row)
    {
        $importData = [
            'chest_no'   => $row[0],
            'name'       => $row[1],
            'board_no'   => $row[2],
            'roll_no'    => $row[3],
        ];

        return $importData;
    }

    public function rules(): array
    {
        return [
            '0' => 'required',
            '2' => 'required'
        ];
    }
}
