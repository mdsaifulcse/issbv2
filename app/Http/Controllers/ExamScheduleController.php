<?php

namespace App\Http\Controllers;

use App\BoardCandidate;
use App\Candidates;
use App\ItemBank;
use DateTime;
use Auth;
use DateTimeZone;
use App\ExamConfig;
use App\ConfigInstruction;
use App\TestConfiguration;
use Illuminate\Http\Request;
use App\Http\Controllers\Candidate\CandidateExamController;

class ExamScheduleController extends Controller
{
    public function index()
    {
        $data['examConfigs']=ExamConfig::with('boardCandidate','testConfig','testConfig.testFor')
            ->where(['exam_configs.status'=>1,'exam_configs.preview_status'=>1])
            ->latest()->paginate(50);

        $activeBoard = BoardCandidate::where('status', 1)->first();
        $data['total_candidate'] = $activeBoard->total_candidate;
        $data['total_live'] = Candidates::where('seat_no', '!=', 0)->where(['is_logged_in'=> 1,'board_no'=>$activeBoard->board_name])->count();

        return view('conductOfficer.examSchedule.listData', $data);
    }
    public function examInstruction(Request $request)
    {

         $data['examId'] = $request->examId;
        $examConfig = ExamConfig::find($request->examId);

        if($request->prestart==1){

            // Make Prestart exam Upcoming before making another exam running
            $preStartExam=ExamConfig::where(['exam_status'=>4,'preview_status'=>1,'status'=>1])->first();
            if (!empty($preStartExam)){
                $preStartExam->update([
                    'exam_status' => 0, // Upcoming -------
                    'updated_at'  => date('Y-m-d H:i:s'),
                    'updated_by'  => Auth::id()]);
            }

        }

        // find instruction which candidate can see
        $instruction = ConfigInstruction::where(['test_config_id'=>$examConfig->test_config_id,'can_candidate_see'=>1])->orderBy('sequence','ASC')->latest()->first();


        // find instruction to make it visible to candidate ------
        $data['configInstruction'] = $configInstruction = ConfigInstruction::where(['test_config_id'=>$examConfig->test_config_id,'can_candidate_see'=>0])->orderBy('sequence','ASC')->latest()->first();
        if (!empty($configInstruction)) {
            // Make candidate see ---------------------
            $configInstruction->update(['can_candidate_see'=>1,'updated_by'  => Auth::id(),'updated_at'=>date('Y-m-d H:i:s')]);
            // make exam config prestart state --------
            $examConfig->update([
                'exam_status' => 4, // 4= PreStart
                'updated_at'  => date('Y-m-d H:i:s'),
                'updated_by'  => Auth::id(),
            ]);

            // FOR CHECKING NEXT INSTRUCTION
            $isNextConfigInstruction = ConfigInstruction::where('test_config_id', $examConfig->test_config_id)
                ->where('id', '>=', $configInstruction->id)
                ->orderBy('id', 'ASC')
                ->count();
            // dd($isNextConfigInstruction);
            if ($isNextConfigInstruction == 0) {
                $data['instructionEndStatus']  = 0;
            } else {
                $data['instructionEndStatus']  = 1;
            }
        }
        //  make it invisible to candidate ------
        if (!empty($instruction)){
            $instruction->update(['can_candidate_see'=>0,'updated_by'  => Auth::id(),'updated_at'=>date('Y-m-d H:i:s')]);
        }
        return view('conductOfficer.examSchedule.instruction', $data);
    }
    public function nextInstruction(Request $request)
    {

        $data['examId'] = $request->examId;
        $instrucId = $request->instrucId;
        $examConfig = ExamConfig::find($request->examId);

        // find instruction which candidate can see
        $instruction = ConfigInstruction::where(['test_config_id'=>$examConfig->test_config_id,'can_candidate_see'=>1])->orderBy('sequence','ASC')->latest()->first();


        $configInstruction = ConfigInstruction::where(['test_config_id'=>$examConfig->test_config_id,'can_candidate_see'=>0])
            ->where('id', '>', $instrucId)
            ->orderBy('id', 'ASC')
            ->first();
        if (!empty($configInstruction)){

            $configInstruction->update(['can_candidate_see'=>1,'updated_by'  => Auth::id(),'updated_at'=>date('Y-m-d H:i:s')]);
        }

        $data['instrucId']  = $configInstruction->id;
        $data['text']  = $configInstruction->text;
        $data['image']  = $configInstruction->image;

        // FOR CHECKING NEXT INSTRUCTION
        $isNextConfigInstruction = ConfigInstruction::where('test_config_id', $examConfig->test_config_id)
            ->where('id', '>', $configInstruction->id)
            ->orderBy('id', 'ASC')
            ->count();

        if ($isNextConfigInstruction <= 0) {
            $data['instructionEndStatus']  = 0;
        } else {
            $data['instructionEndStatus']  = 1;
            // $examConfig->update([
            //     'exam_status' => 4, // 4= PreStart
            //     'updated_at'  => date('Y-m-d H:i:s'),
            //     'updated_by'  => Auth::id(),
            // ]);
        }

        //  make it invisible to candidate ------
        if (!empty($instruction)){
            $instruction->update(['can_candidate_see'=>0,'updated_by'  => Auth::id(),'updated_at'=>date('Y-m-d H:i:s')]);
        }
        return response()->json($data);
    }

    public function examDemoItemPreview(Request $request)
    {
        $data['examId'] = $request->examId;

        $examConfig = ExamConfig::with('testConfig')->find($request->examId);

        $itemFor=$examConfig->testConfig?$examConfig->testConfig->test_for:null;

        $skip=$request->skip?$request->skip:1;
        // item_status =5 (Demo test)
        if ($request->next_demo_question_id && $request->skip){
            $skip=$skip+1;
            $itemDetails = ItemBank::where(['item_for'=>$itemFor,'item_status'=>5]);

            $itemDetails=$itemDetails->where('id',$request->next_demo_question_id);
            $itemDetails=$itemDetails->orderBy('id','ASC')->first();
        }else{
            $data['itemDetails'] = $itemDetails = ItemBank::where(['item_for'=>$itemFor,'item_status'=>5])
                ->orderBy('id','ASC')->first();
        }

        $data['skip']=$skip;
        $data['itemDetails']=$itemDetails;

        // Identify the next question ------ skip the previous question by skip -----
        $nextDemoQuestion=ItemBank::where(['item_for'=>$itemFor,'item_status'=>5])
            ->skip($skip)->orderBy('id','ASC')->first();

        if (empty($itemDetails)){
            $data['messege'] = 'There is no demo question ';
            $data['msgType'] = 'error';
            return back()->with($data);
        }

        if (empty($nextDemoQuestion)) {
            $data['next_demo_question_id']  = 0;
        } else {
            $data['next_demo_question_id'] = $nextDemoQuestion->id;
        }

        $data['status'] = $itemDetails->item_status;

        return view('conductOfficer.examSchedule.demo_item_preview', $data);
    }

    public function examDemoQOne(Request $request)
    {
        $data['examId'] = $request->examId;
        return view('conductOfficer.examSchedule.examDemoQOne', $data);
    }

    public function examDemoQTwo(Request $request)
    {
        $data['examId'] = $request->examId;
        return view('conductOfficer.examSchedule.examDemoQTwo', $data);
    }
    public function examDemoQThree(Request $request)
    {
        $data['examId'] = $request->examId;
        return view('conductOfficer.examSchedule.examDemoQThree', $data);
    }
    public function examDemoFinish(Request $request)
    {
        $examConfig=ExamConfig::find($request->examId);
        $data['examId'] = $request->examId;
        $activeBoard = BoardCandidate::where('status', 1)->first();
        $data['total_candidate'] = $activeBoard->total_candidate;
        $data['total_live'] = Candidates::where('seat_no', '!=', 0)->where(['is_logged_in'=> 1,'board_no'=>$activeBoard->board_name])->count();
        return view('conductOfficer.examSchedule.examDemoFinish', $data);
    }


    public function startMainExam(Request $request)
    {
        $data['examId']     = $request->examId;
        $examConfig         = ExamConfig::find($request->examId);
        $time               = new DateTime();
        $currentTime        = $time->format('H:i:s');

        // Make Running exam complete before making another exam running
        $runningExam=ExamConfig::where(['exam_status'=>1,'preview_status'=>1,'status'=>1])->first();
        if (!empty($runningExam)){
            $runningExam->update(['exam_status' => 2, //  Complete ----
                'updated_at'  => date('Y-m-d H:i:s'),
                'updated_by'  => Auth::id()]); // 2= Complete
        }


        if ($examConfig->exam_start_time==null) {

            $examConfig->update([
                'exam_status'       => 1, // 1= Running
                'exam_start_time'   => $currentTime,
                'updated_at'        => date('Y-m-d H:i:s'),
                'updated_by'        => Auth::id(),
            ]);
        }

        $updateExamConfigInfo   = ExamConfig::find($request->examId);
        $updateExamConfigInfo->update([
            'exam_end_time'     => self::endTime($request->examId)
        ]);

        if ($examConfig->exam_status == 1) {
            $data['exam_duration'] = self::examRemainingTimeSec($updateExamConfigInfo->exam_start_time, self::endTime($request->examId));
        } else {
            $data['exam_duration'] = $examConfig->exam_duration * 60;
        }
        
        $data['exam_name'] = TestConfiguration::where('id', $examConfig->test_config_id)->first()->test_name;
        $data['messege'] = 'Assessment has been start';
        $data['msgType'] = 'success';

        return view('conductOfficer.examSchedule.startMainExam', $data);
    }
    public function updateMainExamTime(Request $request)
    {
        $current_remain_time = $request->current_remain_time;
        ExamConfig::find($request->exam_id)->update([
            'running_time'  => $current_remain_time,
            'updated_at'    => date('Y-m-d H:i:s'),
            'updated_by'    => Auth::id(),
        ]);
        return ($current_remain_time);
    }
    public function completeMainExam(Request $request)
    {
        $data['examId'] = $request->examId;
        ExamConfig::find($request->examId)->update([
            'exam_status' => 2, // 2= Completed
            'updated_at'  => date('Y-m-d H:i:s'),
            'updated_by'  => Auth::id(),
        ]);
        $data['messege'] = 'Assessment has been Completed';
        $data['msgType'] = 'success';

        return view('conductOfficer.examSchedule.mainExamFinish', $data);
    }


    public static function endTime($examConfigId){
        $authId             = Auth::guard('candAuth')->id();
        $cTime              = new DateTime( "now", new DateTimeZone( "Asia/Dhaka" ) );
        $cTimeArray         = explode(':', $cTime->format( 'H:i:s' ));
        $hToSec             = ($cTimeArray[0]*60)*60;
        $mToSec             = ($cTimeArray[1]*60);
        $sToSec             = $cTimeArray[2];
        $totalCurrentSec    = $hToSec+$mToSec+$sToSec;

        $configuredExam     = ExamConfig::find($examConfigId);

        $durationToSec      = $configuredExam->exam_duration*60;
        $rTimeArray         = explode(':', $configuredExam->exam_start_time);
        $rHToSec            = ($rTimeArray[0]*60)*60;
        $rMToSec            = ($rTimeArray[1]*60);
        $rSToSec            = $rTimeArray[2];
        $totalExamEndSec    = $durationToSec+$rHToSec+$rMToSec+$rSToSec;        

        $hours = floor($totalExamEndSec / 3600);
        $minutes = floor(($totalExamEndSec / 60) % 60);
        $seconds = $totalExamEndSec % 60;

        $end_time = $hours.':'.$minutes.':'.$seconds;
        
        return $end_time;
    }


    public static function examRemainingTimeSec($start_time, $end_time){
        $cTime                  = new DateTime( "now", new DateTimeZone( "Asia/Dhaka" ) );
        $cTimeArray         = explode(':', $cTime->format( 'H:i:s' ));
        $hToSec             = ($cTimeArray[0]*60)*60;
        $mToSec             = ($cTimeArray[1]*60);
        $sToSec             = $cTimeArray[2];
        $totalCurrentSec    = $hToSec+$mToSec+$sToSec;

        $rTimeArray         = explode(':', $start_time);
        $rHToSec            = ($rTimeArray[0]*60)*60;
        $rMToSec            = ($rTimeArray[1]*60);
        $rSToSec            = $rTimeArray[2];
        $totalExamStartSec    = $rHToSec+$rMToSec+$rSToSec; 

        $endTimeArray           = explode(':', $end_time);
        $endHToSec              = ($endTimeArray[0]*60)*60;
        $endMToSec              = ($endTimeArray[1]*60);
        $endSToSec              = $endTimeArray[2];
        $totalEndtimeSec        = $endHToSec+$endMToSec+$endSToSec;

        if ($totalCurrentSec >= $totalExamStartSec && $totalEndtimeSec > $totalCurrentSec) {
            $remaining_seconds = $totalEndtimeSec-$totalCurrentSec;
        } else {
            $remaining_seconds = 0;
        }

        return $remaining_seconds;
    }

    public function candidateExamStopByConductionOfficer(Request $request){

        $candidate=Candidates::find($request->candidate_id);

        $candidate->update(['is_logged_in'=>0,'seat_no'=>0,'exam_start'=>0]);
        return redirect('/stdSeatPlan');

    }
}
