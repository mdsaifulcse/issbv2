<?php

namespace App\Http\Controllers;

use App\BoardCandidate;
use App\Candidates;
use App\ExamConfig;
use App\Http\Requests;
use Carbon\Carbon;
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


        $data['activeTest'] = ExamConfig::with('testConfig')->where(['exam_configs.status'=>1,'exam_configs.exam_status'=>1])->latest()->first();


        $data['total_live'] = Candidates::where('seat_no', '!=', 0)->where(['is_logged_in'=>1,'board_no'=>$data['activeBoard']->board_name])->count();

        $data['examConfigs']= ExamConfig::with('boardCandidate','testConfig','testConfig.testFor')
            ->where(['exam_configs.status'=>1,'exam_configs.preview_status'=>1])
            ->latest()->paginate(20);


        // ------

        // Detect users whose close browser or logout  AND change is_logged_in value
        $loginCandidates = Candidates::where('seat_no', '!=', 0)->where('board_no',$data['activeBoard']->board_name)->get();

        foreach ($loginCandidates as $loginCandidate){
            $currentTime=Carbon::now();

            $candidateUpdatedTime=New Carbon($loginCandidate->updated_at);
            //return date('Y-m-d h:i:s',strtotime($candidateUpdatedTime));
            $differentTime=$candidateUpdatedTime->diffInSeconds($currentTime);

            if ($differentTime>30){ // in second
                $loginCandidate->update(['is_logged_in'=>0,'seat_no'=>0,'exam_start'=>0]);
            }
        }


        $candidates = Candidates::where('seat_no', '!=', 0)->where('board_no',$data['activeBoard']->board_name)->get();

        $data['total_candidate'] = $data['activeBoard']->total_candidate;


        // where('board_no', 'one')
        foreach ($candidates as $key => $candidate) {
            $data["candidate_$candidate->seat_no"] = $candidate->is_logged_in;
            $data["exam_start_$candidate->seat_no"] = $candidate->exam_start;
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
