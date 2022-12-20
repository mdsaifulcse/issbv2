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

        $data = array();
        $data['activeBoard'] = BoardCandidate::where('status', 1)->first();

        if (empty($data['activeBoard'])){ // ----- For no active board
            $output['messege'] = 'No active board, Please create board first';
            $output['msgType'] = 'danger';
            return redirect()->back()->with($output);
        }


        $data['activeTest'] = ExamConfig::where(['exam_configs.status'=>1,'exam_configs.preview_status'=>1])->count();


        $data['total_live'] = Candidates::where('seat_no', '!=', 0)->where(['is_logged_in'=>1,'board_no'=>$data['activeBoard']->board_name])->count();

        $data['examConfigs']= ExamConfig::with('boardCandidate','testConfig','testConfig.testFor')
            ->where(['exam_configs.status'=>1,'exam_configs.preview_status'=>1])
            ->latest()->paginate(20);


        // ------

        $candidates = Candidates::where('seat_no', '!=', 0)->where('board_no',$data['activeBoard']->board_name)->get();

        $data['total_candidate'] = $data['activeBoard']->total_candidate;


        // where('board_no', 'one')
        foreach ($candidates as $key => $candidate) {
            $data["candidate_$candidate->seat_no"] = $candidate->is_logged_in;
        }
        //return $data;


        return view('welcome',$data//compact('activeBoard','activeTest','data','examConfigs')
        );

    }


    public function index()
    {
        return view('home');
    }
}
