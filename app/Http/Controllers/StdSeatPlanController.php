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
        $activeBoard = BoardCandidate::where('status', 1)->first();

        if (empty($activeBoard)){ // ----- For no active board
            $output['messege'] = 'No active board, Please create board first';
            $output['msgType'] = 'danger';
            return redirect()->back()->with($output);
        }

        $data = array();

        $candidates = Candidates::where('seat_no', '!=', 0)->where('board_no',$activeBoard->board_name)->get();

        $data['total_candidate'] = $activeBoard->total_candidate;


        // where('board_no', 'one')
        foreach ($candidates as $key => $candidate) {
            $data["candidate_$candidate->seat_no"] = $candidate->is_logged_in;
        }
        $data['total_live'] = Candidates::where('seat_no', '!=', 0)->where(['is_logged_in'=> 1,'board_no'=>101])->count();


        // dd($data);
        return view('conductOfficer.seatPlan.list', $data);
    }
}
