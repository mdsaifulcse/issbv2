<?php

namespace App\Http\Controllers;

use DB;
use Redirect;
use App\Candidates;
use App\ExamConfig;
use App\Http\Requests;
use App\BoardCandidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StdSeatPlanController extends Controller
{
    public function index()
    {
        $data = array();
        $currentDate = date('Y-m-d');
        $candidates = Candidates::where('seat_no', '!=', 0)->get();

        $configuredExam = ExamConfig::whereIn('exam_status', [1,4])
            ->where('exam_date', $currentDate)
            ->where('status', 1)
            ->first();

        if (!empty($configuredExam)) {
            $data['total_candidate'] = BoardCandidate::find($configuredExam->board_candidate_id)->total_candidate;
        } else {
            $data['total_candidate'] = 0;
        }

        // where('board_no', 'one')
        foreach ($candidates as $key => $candidate) {
            $data["candidate_$candidate->seat_no"] = $candidate->is_logged_in;
        }
        $data['total_live'] = Candidates::where('seat_no', '!=', 0)->where('is_logged_in', 1)->count();


        // dd($data);
        return view('conductOfficer.seatPlan.list', $data);
    }
}
