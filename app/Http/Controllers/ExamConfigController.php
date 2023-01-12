<?php

namespace App\Http\Controllers;

use App\TestList;
use Auth;
use App\User;
use App\ItemBank;
use App\Candidates;
use App\ExamConfig;
use App\QuestionSet;
use App\BoardCandidate;
use App\TestConfiguration;
use App\ExamConfigStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Candidate\CandidateExamController;
use App\Http\Controllers\ExamScheduleController;

class ExamConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         $examConfigs= ExamConfig::with('boardCandidate','testConfig','testConfig.testFor');
         //->where(['exam_configs.status'=>1]); //,'exam_configs.preview_status'=>1

        if ($request->test_for){
            $examConfigs=$examConfigs->whereHas('testConfig', function ($query) use($request) {
                $query->where('test_config.test_for', $request->test_for);
            });
        }

        if ($request->all_active==1){
            $examConfigs=$examConfigs->where(['exam_configs.status'=>1,'exam_configs.preview_status'=>1]);
        }
//        else{
//            $examConfigs=$examConfigs->where(['exam_configs.status'=>1]);
//        }

        $examConfigs=$examConfigs->latest()->paginate(20);

        return view('testingOfficer.examConfig.listData',compact('examConfigs','request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $test='';
        $testConfigs = TestConfiguration::latest();
        if ($request->test_for){
            $testConfigs=$testConfigs->where('test_for',$request->test_for);

            $test=TestList::find($request->test_for);
        }
        $testConfigs = $testConfigs->get();
        $activeBoard = BoardCandidate::where('status', 1)->first();

        if (!empty($activeBoard) && count($testConfigs)>0){

            foreach ($testConfigs as $testConfig){
                $testConfig['test_name']=$activeBoard->board_name.$testConfig->test_name;
            }

        }


//        $examConfigs = ExamConfig::join('test_config', 'test_config.id', '=', 'exam_configs.test_config_id')
//            ->join('board_candidates', 'board_candidates.id', '=', 'exam_configs.board_candidate_id')
//            ->select('exam_configs.*', 'test_config.test_name', 'board_candidates.id', 'board_candidates.board_name', 'board_candidates.total_candidate', 'exam_configs.board_candidate_id')
//            ->whereIn('exam_configs.status', [0, 2])
//            ->paginate(10);

        return view('testingOfficer.examConfig.create', compact('testConfigs','test','request'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'test_config_id'      => 'required',
            'exam_date'           => 'required',
        ]);
        $activeBoard = BoardCandidate::where('status', 1)->first();
        $testConfig = TestConfiguration::find($request->test_config_id);

        $insert = new ExamConfig();
        $insert->test_config_id      = $request->test_config_id;
        $insert->exam_duration       = $testConfig->total_time;
        $insert->exam_date           = $request->exam_date;
        $insert->board_candidate_id  = $activeBoard->id;
        $insert->exam_status         = 0; // 0=Upcomming
        $insert->preview_status         = 1;//1= Active
        $insert->status              = 1; // 1=Active
        $insert->created_by          = Auth::id(); // 1=Active
        $insert->save();

        $output['messege'] = 'Exam Configuration has been created';
        $output['msgType'] = 'success';
        return redirect()->back()->with($output);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {
        if ($request->status==0){
            $status=0;
        }else{
            $status=1;
        }

        ExamConfig::find($id)->update([
            'preview_status'        => $status,
            'status'                => $status,
            'updated_at'            => date('Y-m-d H:i:s'),
            'updated_by'            => Auth::id(),
        ]);

        $output['messege'] = 'Exam Configuration has been updated';
        $output['msgType'] = 'success';
        return redirect()->back()->with($output);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
        $data['testConfigs'] = TestConfiguration::get();
        $data['questionSets'] = QuestionSet::get();
        $data['users'] = User::get();
        $data['examConfig'] = ExamConfig::find($id);

        $data['test']=TestList::find($request->test_for);

        return view('testingOfficer.examConfig.update', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'test_config_id'        => 'required',
            'exam_date'             => 'required',
            'status'                => 'required',
            'preview_status'        => 'required',
        ]);
        $activeBoard = BoardCandidate::where('status', 1)->first();
        $testConfig = TestConfiguration::find($request->test_config_id);

        ExamConfig::find($id)->update([
            'test_config_id'        => $request->test_config_id, //0       = Inactive
            'exam_date'             => $request->exam_date,
            'exam_duration'         => $testConfig->total_time,
            'board_candidate_id'    => $activeBoard->id,
            'preview_status'        => $request->preview_status,
            'status'                => $request->status,
            'updated_at'            => date('Y-m-d H:i:s'),
            'updated_by'            => Auth::id(),
        ]);

        $output['messege'] = 'Exam Configuration has been updated';
        $output['msgType'] = 'success';
        return redirect()->back()->with($output);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ExamConfig::find($id)->update([
            'status'     => 0, //0=Inactive
            'deleted_at' => date('Y-m-d H:i:s'),
            'deleted_by' => Auth::id(),
        ]);
        return ('success');
    }

    public function runningExamTimeRemain(Request $request)
    {
        $data['examId'] = $request->examId;
        $examConfig = ExamConfig::find($request->examId);

        if ($examConfig->exam_status == 1) {
            $data['exam_duration'] = (new ExamScheduleController)->examRemainingTimeSec($examConfig->exam_start_time, $examConfig->exam_end_time);
        } else {
            $data['exam_duration'] = 0;
        }

        $data['exam_name'] = TestConfiguration::where('id', $examConfig->test_config_id)->first()->test_name;
        
        return view('testingOfficer.examConfig.runningExamTime', $data);
    }

    public function examPreviewOld(Request $request) // Saif
    {
        if (Auth::user()->hasRole('conductingOfficer')) {
            $previewCandidate = Candidates::where('board_no', 'preview')->first();
            if(!empty($previewCandidate)) {
                if(Auth::guard('candAuth')->loginUsingId($previewCandidate->id)){
                    return redirect()->route('candidate.candidateExamStart', ['examId'=>$request->examId]);
                }
            } else {
                $output['messege'] = 'Please make sure your Preview feature';
                $output['msgType'] = 'danger';
                return redirect()->back()->with($output);
            }
        } else {

            $data['examId'] = $request->examId;
            $examConfig = ExamConfig::find($request->examId);
            $testConfig = TestConfiguration::find($examConfig->test_config_id);

            if ($testConfig->set_id =='' || $testConfig->set_id==NULL) {
                $questionIds = explode('||', $testConfig->item_id);
                $data['examQuestions'] = $examQuestions = ItemBank::whereIn('id', $questionIds)->select('id', 'sub_question_status', 'item', 'item_type', 'options', 'option_type', 'correct_answer', 'sub_question', 'sub_question_type', 'sub_correct_answer', 'sub_options', 'sub_option_type')->get();
            } else {
                $questionIds = explode('||', QuestionSet::find($testConfig->set_id)->questions_id);
                $data['examQuestions'] = $examQuestions = ItemBank::whereIn('id', $questionIds)->select('id', 'sub_question_status', 'item', 'item_type', 'options', 'option_type', 'correct_answer', 'sub_question', 'sub_question_type', 'sub_correct_answer', 'sub_options', 'sub_option_type')->get();
            }

            if (!empty($examQuestions)) {
                foreach ($examQuestions as $key => $question) {

                    if ($question->sub_question_status=='' || $question->sub_question_status==NULL) {
                        $question->question_title = $question->item;
                        $question->answerSet = explode('||', $question->options);
                        $question->true_answer = $question->correct_answer;

                    } else {
                        $question->sub_questions = $subQuestions        = explode('||', $question->sub_question);
                        // $subOptions          = explode('~~', $question->sub_options);
                        // $sub_correct_answers = explode('||', $question->sub_correct_answer);
                    }

                }
            }
            $data['exam_name'] = $testConfig->test_name;
            $data['preview_status'] = $examConfig->preview_status;

            return view('testingOfficer.examConfig.previewExamQ', $data);
        }
    }

     public function examPreview(Request $request) // uncomment Saif
     {

         $data['examId'] = $request->examId;
         $examConfig = ExamConfig::find($request->examId);
         $testConfig = TestConfiguration::find($examConfig->test_config_id);


         $nextIndex=$request->index?$request->index:0;
         $previousIndex=0;
         if ($testConfig->set_id =='' || $testConfig->set_id==NULL) {
             $questionIds = explode('||', $testConfig->item_id);

             $totalQuestionId= count($questionIds)-1;
             $data['examQuestions'] = $examQuestions = ItemBank::where('id', $questionIds[$nextIndex])
                 ->select('id', 'sub_question_status', 'item', 'item_type', 'options', 'option_type', 'correct_answer', 'sub_question',
                     'sub_question_type', 'sub_correct_answer', 'sub_options', 'sub_option_type')->get();

//             $data['examQuestions'] = $examQuestions = ItemBank::whereIn('id', $questionIds)
//                 ->select('id', 'sub_question_status', 'item', 'item_type', 'options', 'option_type', 'correct_answer', 'sub_question',
//                     'sub_question_type', 'sub_correct_answer', 'sub_options', 'sub_option_type')->get();
         } else {

             $questionIds = explode('||', QuestionSet::find($testConfig->set_id)->questions_id);
             $totalQuestionId= count($questionIds)-1;
             $data['examQuestions'] = $examQuestions = ItemBank::where('id', $questionIds[$nextIndex])
                 ->select('id', 'sub_question_status', 'item', 'item_type', 'options', 'option_type', 'correct_answer', 'sub_question',
                     'sub_question_type', 'sub_correct_answer', 'sub_options', 'sub_option_type')->get();
         }

         $nextButton=1;
         if ($totalQuestionId==$nextIndex){
             $nextButton=0;
         }
         $data['nextButton']=$nextButton;

         $data['previousIndex']=$nextIndex-1;
         $data['nextIndex']=$nextIndex+=1;

         //return $data;


         if (!empty($examQuestions)) {
             foreach ($examQuestions as $key => $question) {

                 if ($question->sub_question_status=='' || $question->sub_question_status==NULL) {
                     $question->question_title = $question->item;
                     $question->answerSet = explode('||', $question->options);
                     $question->true_answer = $question->correct_answer;

                 } else {
                     $question->sub_questions = $subQuestions        = explode('||', $question->sub_question);
                     // $subOptions          = explode('~~', $question->sub_options);
                     // $sub_correct_answers = explode('||', $question->sub_correct_answer);
                 }

             }
         }
         $data['exam_name'] = $testConfig->test_name;
         $data['preview_status'] = $examConfig->preview_status;

         if (Auth::user()->hasRole('conductingOfficer')) {
             return view('conductOfficer.examSchedule.previewExamQ', $data);
         }else{ // For testing Officer
             return view('testingOfficer.examConfig.previewExamQ', $data);
         }

     }

    public function activateExam(Request $request)
    {
        ExamConfig::find($request->examId)->update([
            'preview_status'    => 1, //1=Preview
            'updated_at'        => date('Y-m-d H:i:s'),
            'updated_by'        => Auth::id(),
        ]);
        $output['messege'] = 'Exam has been Activated';
        $output['msgType'] = 'success';
        return redirect()->route('examConfig.index')->with($output);
    }

    public function assessmentStatusUpdate(Request $request){
        $assessmentId           = $request->assignment_id;
        $examConfigDetails      = ExamConfig::find($assessmentId);
        $activeBoardId          = BoardCandidate::where('status', 1)->first()->id;
        
        $storeData = ExamConfig::create([
            "board_candidate_id"        => $activeBoardId,
            "exam_date"                 => date('Y-m-d'), //$examConfigDetails->exam_date,
            "exam_duration"             => $examConfigDetails->exam_duration,
            "guest_time_duration"       => $examConfigDetails->guest_time_duration,
            "test_config_id"            => $examConfigDetails->test_config_id,
            "assign_to"                 => $examConfigDetails->assign_to,
            "exam_status"               => $examConfigDetails->exam_status,
            "preview_status"            => 1, //1=Active,
            "status"                    => 1, //1=Active
            "created_by"                => Auth::id()
        ]);

        if ($storeData) {
            $output['messege'] = 'The assessment has been Copied!';
            $output['msgType'] = 'success';
        } else {
            $output['messege'] = 'Something wrong';
            $output['msgType'] = 'danger';
        }
        
        return $output;

    }

}
