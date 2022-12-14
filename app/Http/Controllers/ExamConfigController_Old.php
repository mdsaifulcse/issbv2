<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\ItemBank;
use App\Candidates;
use App\ExamConfig;
use App\QuestionSet;
use App\BoardCandidate;
use App\TestConfiguration;
use Illuminate\Http\Request;
use App\Http\Controllers\Candidate\CandidateExamController;

class ExamConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['examConfigs'] = ExamConfig::join('test_config', 'test_config.id', '=', 'exam_configs.test_config_id')
            ->join('board_candidates', 'board_candidates.id', '=', 'exam_configs.board_candidate_id')
            ->select('exam_configs.*', 'test_config.test_name', 'board_candidates.board_name', 'board_candidates.total_candidate')
            ->where('exam_configs.status', 1)
            ->paginate(10);
        return view('testingOfficer.examConfig.listData', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['testConfigs'] = TestConfiguration::get();
        $data['questionSets'] = QuestionSet::get();
        $data['users'] = User::get();
        return view('testingOfficer.examConfig.create', $data);
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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['testConfigs'] = TestConfiguration::get();
        $data['questionSets'] = QuestionSet::get();
        $data['users'] = User::get();
        $data['examConfig'] = ExamConfig::find($id);
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
            'test_config_id'      => 'required',
            'exam_date'           => 'required',
            'total_candidate'     => 'required',
        ]);
        $activeBoard = BoardCandidate::where('status', 1)->first();
        $testConfig = TestConfiguration::find($request->test_config_id);

        ExamConfig::find($id)->update([
            'test_config_id'      => $request->test_config_id, //0       = Inactive
            'exam_date'           => $request->exam_date,
            'exam_duration'       => $testConfig->total_time,
            'board_candidate_id'  => $activeBoard->id,
            'updated_at'          => date('Y-m-d H:i:s'),
            'updated_by'          => Auth::id(),
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
            $data['exam_duration'] = isset($examConfig->running_time) ? CandidateExamController::timeToSec($examConfig->running_time) : $examConfig->exam_duration * 60;
        } else {
            $data['exam_duration'] = $examConfig->exam_duration * 60;
        }
        $data['exam_name'] = TestConfiguration::where('id', $examConfig->test_config_id)->first()->test_name;
        return view('testingOfficer.examConfig.runningExamTime', $data);
    }

    public function examPreview(Request $request)
    {

        if (Auth::user()->hasRole('conductingOfficer')) {
            $previewCandidate = Candidates::where('board_no', 'preview')->first();
            if(!empty($previewCandidate)) {
                if(Auth::guard('candAuth')->loginUsingId($previewCandidate->id)){
                    return redirect()->route('candidate.dashboard');
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
    // public function examPreview(Request $request)
    // {
    //     $data['examId'] = $request->examId;
    //     $examConfig = ExamConfig::find($request->examId);
    //     $testConfig = TestConfiguration::find($examConfig->test_config_id);

    //     if ($testConfig->set_id =='' || $testConfig->set_id==NULL) {
    //         $questionIds = explode('||', $testConfig->item_id);
    //         $data['examQuestions'] = $examQuestions = ItemBank::whereIn('id', $questionIds)->select('id', 'sub_question_status', 'item', 'item_type', 'options', 'option_type', 'correct_answer', 'sub_question', 'sub_question_type', 'sub_correct_answer', 'sub_options', 'sub_option_type')->get();
    //     } else {
    //         $questionIds = explode('||', QuestionSet::find($testConfig->set_id)->questions_id);
    //         $data['examQuestions'] = $examQuestions = ItemBank::whereIn('id', $questionIds)->select('id', 'sub_question_status', 'item', 'item_type', 'options', 'option_type', 'correct_answer', 'sub_question', 'sub_question_type', 'sub_correct_answer', 'sub_options', 'sub_option_type')->get();
    //     }

    //     if (!empty($examQuestions)) {
    //         foreach ($examQuestions as $key => $question) {

    //             if ($question->sub_question_status=='' || $question->sub_question_status==NULL) {
    //                 $question->question_title = $question->item;
    //                 $question->answerSet = explode('||', $question->options);
    //                 $question->true_answer = $question->correct_answer;

    //             } else {
    //                 $question->sub_questions = $subQuestions        = explode('||', $question->sub_question);
    //                 // $subOptions          = explode('~~', $question->sub_options);
    //                 // $sub_correct_answers = explode('||', $question->sub_correct_answer);
    //             }

    //         }
    //     }
    //     $data['exam_name'] = $testConfig->test_name;
    //     $data['preview_status'] = $examConfig->preview_status;
    //     return view('testingOfficer.examConfig.previewExamQ', $data);
    // }

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

}
