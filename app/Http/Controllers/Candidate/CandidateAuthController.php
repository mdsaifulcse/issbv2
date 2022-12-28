<?php

namespace App\Http\Controllers\Candidate;

use Carbon\Carbon;
use Session;
use App\ItemBank;
use App\Candidates;
use App\ExamConfig;
use App\QuestionSet;
use App\CandidateExam;
use App\BoardCandidate;
use App\TestConfiguration;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CandidateAuthController extends Controller
{
    public function getLogin()
    {
        if(Auth::guard('candAuth')->check()){
            return redirect()->route('candidate.dashboard');
        } else {
            $data['boardInfo'] = BoardCandidate::where('status', 1)->first();

            return view('candidates.login', $data);
        }
    }

    public function candidateVerify(Request $request) {
        $this->validate($request, [
            'name'              => 'required',
            'roll_no'           => 'required',
            'chest_no'          => 'required',
        ]);

        $boardInfo      = BoardCandidate::where('status', 1)->first();
        $canExist       = Candidates::where(['chest_no'=>$request->chest_no,'board_no'=>$boardInfo->board_name])->first();

        if (!empty($canExist)) {
            $canExist->update([
                'name'          => $request->name,
                'roll_no'       => $request->roll_no,
                'seat_no'       => $request->chest_no,
                'board_no'      => $boardInfo->board_name,
            ]);

            $data['userInfo'] = Candidates::find($canExist->id);
            $data['status'] = 1;

            return view('candidates.candidate_verify', $data);
        } else {
            return redirect()->route('candidate.login')->with('error', 'Something wrong');
        }


    }

    public function postLogin(Request $request)
    {

        $this->validate($request, [
            'candidate_id'      => 'required',
            'secret_key'        => 'required',
        ]);

        $data['candidate_id']   = $candidate_id = $request->candidate_id;
        $data['secret_key']     = $secret_key = $request->secret_key;
        $activeBoard=BoardCandidate::where('status', 1)->first();
        $isExist = Candidates::where(['secret_key'=>$secret_key,'board_no'=>$activeBoard->board_name])->find($candidate_id);

        if (!empty($isExist)) {
            $isExist->update([
                'is_logged_in' => 1
            ]);

            if (Auth::guard('candAuth')->loginUsingId($isExist->id)) {
                return redirect()->route('candidate.dashboard');
            } else {
                $data['status'] = 0;
                return redirect()->route('candidate.login')->with('error', 'Something wrong');
            }
        } else {
            $data['status'] = 0;
            $data['userInfo'] = Candidates::find($candidate_id);

            return view('candidates.candidate_verify', $data);
        }
    }

    public function dashboard(Request $request)
    {
        if(Auth::guard('candAuth')->check()){

//            $currentDate            = date('Y-m-d');
//            $currentTime            = date('h:i:s');
            $data['authId']         = $authId = Auth::guard('candAuth')->id();
            $data['userInfo']       = Candidates::find($authId);

            $data['configuredExam'] = $configuredExam = ExamConfig::whereIn('exam_status', [1,4])
                //->where('exam_date', $currentDate)
                ->latest()->where('status', 1)->first(); // latest() added by Md.Saiful Islam

            if (!empty($configuredExam)) {
                $data['candidateExamInfo'] = CandidateExam::where(['candidate_id'=>$authId,'exam_config_id'=>$configuredExam->id])
                  ->latest()->first(); // latest() added by Md.Saiful Islam
                $data['upcomingExamStatus'] = 1;
            } else {
                $data['candidateExamInfo'] = '';
                $data['upcomingExamStatus'] = 0;
            }

            //return $data;


            return view('candidates.welcome', $data);
        } else {
            return redirect()->route('candidate.login');
        }
    }

    public function secretKeyModal(Request $request)
    {
        return view('candidates.secretKeyModal');
    }

    public function secretKeyCheck(Request $request)
    {
        $authId = Auth::guard('candAuth')->id();
        $userInfo = Candidates::find($authId);
        if (!empty($userInfo)) {
            if ($userInfo->secret_key == $request->secret_key) {
                return redirect()->route('candidate.dashboard');
            } else {

                $insert = Candidates::find($authId);
                $insert->is_logged_in = 0;
                $insert->seat_no = 0;
                $insert->save();
                Auth::guard('candAuth')->logout();
                return redirect()->route('candidate.login');
            }
        } else {
            $insert = Candidates::find($authId);
            $insert->is_logged_in = 0;
            $insert->seat_no = 0;
            $insert->save();
            Auth::guard('candAuth')->logout();
            return redirect()->route('candidate.login');
        }
    }

    public function verifyUser(Request $request)
    {

        $activeBoard=BoardCandidate::where('status', 1)->first();
        $c_chest_no = $request->c_chest_no;
        $userInfo = Candidates::where(['chest_no'=>$c_chest_no,'board_no'=>$activeBoard->board_name])->first();

        if (!empty($userInfo)) {
            $output['userInfo'] = $userInfo;
            $output['status'] = 1;
        } else {
            $output['status'] = 0;
            $output['message'] = 'Automated verification failed!';
        }
        return response()->json($output);
    }

    public function startMainExam(Request $request)
    {
        ExamConfig::find($request->examId)->update([
            'exam_status' => 1, // 1= Running
            'updated_at'  => date('Y-m-d H:i:s'),
            'updated_by'  => Auth::id(),
        ]);

        $output['messege'] = 'Exam has been start';
        $output['msgType'] = 'success';

        return view('candidates.intructionDemoExam.startMainExam', $output);
    }

    public function logout()
    {
        if(Auth::guard('candAuth')->check()) {
            $id = Auth::guard('candAuth')->id();
            $authInfo = Candidates::find($id);
            $authInfo->is_logged_in = 0;
            $authInfo->save();
            Session::flush();
            Auth::guard('candAuth')->logout();
            return redirect()->route('candidate.login');
        } else {
            return redirect()->route('candidate.login');
        }
    }

    public function tractCandidateLastAction(){
        $authCandidate= Auth::guard('candAuth')->user();

        $authCandidate->update(['updated_at'=>Carbon::now()]);
        return Carbon::now();
    }
}
