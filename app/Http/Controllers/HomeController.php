<?php

namespace App\Http\Controllers;

use App\BoardCandidate;
use App\Candidates;
use App\ExamConfig;
use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function dashboard(){
        $activeBoard = BoardCandidate::where('status', 1)->first();

        $activeTest = ExamConfig::where(['exam_configs.status'=>1,'exam_configs.preview_status'=>1])->count();


        $configuredExam = ExamConfig::whereIn('exam_status', [1,4])
            ->where('exam_date', date('Y-m-d'))
            ->where('status', 1)
            ->first();

        if (!empty($configuredExam)) {
            $data['total_candidate'] = BoardCandidate::find($configuredExam->board_candidate_id)->total_candidate;
        } else {
            $data['total_candidate'] = 0;
        }

        $data['total_live'] = Candidates::where('seat_no', '!=', 0)->where('is_logged_in', 1)->count();
        return view('welcome',compact('activeBoard','activeTest','data'));

    }


    public function index()
    {
        return view('home');
    }
}
