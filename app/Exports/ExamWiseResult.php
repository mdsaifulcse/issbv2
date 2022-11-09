<?php

namespace App\Exports;

use Request;
use App\Candidates;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromView;

class ExamWiseResult implements FromView
{
    public function __construct($candidates)
    {
        $this->candidates = $candidates;
    }

    public function view(): View
    {
        $data['candidates'] = $this->candidates;

        return view('reports.exam_wise_result.result', $data);
    }
}
