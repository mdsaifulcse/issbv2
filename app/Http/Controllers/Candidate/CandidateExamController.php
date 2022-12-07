<?php

namespace App\Http\Controllers\Candidate;

use DateTime;
use App\ItemBank;
use DateTimeZone;
use App\Candidates;
use App\ExamConfig;
use App\TestGroups;
use App\BoardConfig;
use App\QuestionSet;
use App\CandidateExam;
use App\ConfigInstruction;
use App\TestConfiguration;
use App\CandidateExamDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CandidateExamController extends Controller
{
    public function candidateExamConfigure(Request $request)
    {
        $data['examId']     = $examId = $request->examId;
        $data['step_id']    = $step_id = $request->step_id;
        $currentDate        = date('Y-m-d');
        $cTime              = new DateTime( "now", new DateTimeZone( "Asia/Dhaka" ) );
        $currentTime        = $cTime->format( 'H:i:s' );
        $examConfigDetails  = ExamConfig::find($examId);


        $data = self::examConfigStartFun($examConfigDetails, $step_id);

        return response($data);
    }


    //START CANDIDATE EXAM START
    public function candidateExamStart(Request $request)
    {
        $data['examId']             = $examId = $request->examId;
        $data['authId']             = $candidate_id = Auth::guard('candAuth')->id();
        $data['userInfo']           = $userInfo = Candidates::find($candidate_id);
        $currentDate                = date('Y-m-d');
        $cTime                      = new DateTime( "now", new DateTimeZone( "Asia/Dhaka" ) );
        $currentTime                = $cTime->format( 'H:i:s' );
        $examConfigDetails          = ExamConfig::find($examId);

        $data['candidateExam']      = $candidateExam = CandidateExam::where('candidate_id', $candidate_id)->where('exam_config_id', $examConfigDetails->id)->where('exam_status', '!=', 2)->first();

        if($candidateExam){
            $data['examQuestions'] = CandidateExamDetail::where('candidate_exam_id', $candidateExam->id)->get()->pluck('id');
            $data['examConfigureStatus'] = 1; //0=No, 1=Yes

            //UPDATE EXAM START TIME
            $candidateExam->update([
                "running_exam_time"     => $currentTime,
                "exam_status"           => 1, //1=Exam Running
            ]);

            $data['examRemainingTime']             = self::examRemainingTime($candidateExam->exam_config_id);
            // dd($data);
            if ($candidateExam->exam_status==2) {
                return view('candidates.candidateNotice', $data);
            } else {
                return view('candidates.exam.examQuestion', $data);
            }
        } else {
            $data['examConfigureStatus'] = 0; //0=No, 1=Yes
            $data['configuredExam'] = $configuredExam = ExamConfig::whereIn('exam_status', [1,4])->where('exam_date', $currentDate)->where('status', 1)->first();

            $data['upcomingExamStatus'] = 0;

            return view('candidates.welcome', $data);
        }
    }
    //END CANDIDATE EXAM START


    //START EXAM SUBMIT
    public function candidateExamSubmit(Request $request)
    {
        $cTime                          = new DateTime( "now", new DateTimeZone( "Asia/Dhaka" ) );
        $currentTime                    = $cTime->format( 'H:i:s' );
        $submittedQuestion              = CandidateExamDetail::find($request->question_id);
        $candidateExam                  = CandidateExam::find($submittedQuestion->candidate_exam_id);
        $data['examStatus']             = $examStatus = ExamConfig::find($candidateExam->exam_config_id)->status;

        $submittedQuestion->update([
            'answer_id'                 => $request->answer,
            'answer_status'             => ($submittedQuestion->correct_answer_id==(int)$request->answer?1:0),
            'running_question_status'   => 0,
            'status'                    => 1,
            'updated_by'                => 1,
        ]);

        //CANDIDATE EXAM UPDATE
        $candidateExam->update([
            'running_exam_time'         => $currentTime,
            'remaining_exam_duration'   => self::examRemainingTime($candidateExam->exam_config_id)
        ]);

        if ($submittedQuestion->sl_no==$request->total_questions) {
                $data['sl_no'] = $submittedQuestion->sl_no==$request->total_questions? $submittedQuestion->sl_no:1;
                $nextQuestion = CandidateExamDetail::where('candidate_exam_id', $submittedQuestion->candidate_exam_id)->where('sl_no', $submittedQuestion->sl_no)->first();

                $submittedQuestion->update([
                    'running_question_status'   => 1,
                ]);

                $data['total_questions']    = $total_questions = CandidateExamDetail::where('candidate_exam_id', $submittedQuestion->candidate_exam_id)->count();
                $data['sl_no']              = $nextQuestion->sl_no;
                $data['exam_id']            = $nextQuestion->candidate_exam_id;
                $data['question_id']        = $nextQuestion->id;
                $data['answer_id']          = $nextQuestion->answer_id;
                $data['question']           = $nextQuestion->question;
                $data['options']            = explode('||', $nextQuestion->options);

                $data['nextBtnStatus']      = 0; //0=disable/hide
                $data['previousBtnStatus']  = 1; //0=disable/hide

                $data['status']             = 1;
                $data['message']            = "Your Question Submitted!";
        } else {
            //NEXT QUESTION'S RUNNING STATUS UPDATE
            $data['sl_no'] = $submittedQuestion->sl_no==$request->total_questions? 1:$submittedQuestion->sl_no+1;
            $nextQuestion = CandidateExamDetail::where('candidate_exam_id', $submittedQuestion->candidate_exam_id)->where('sl_no', $submittedQuestion->sl_no+1)->first();

            if ($submittedQuestion->sl_no<=$request->total_questions) {
                $nextQuestion->update([
                    'running_question_status'   => 1,
                ]);
            }

            $data['total_questions']    = $total_questions = CandidateExamDetail::where('candidate_exam_id', $submittedQuestion->candidate_exam_id)->count();
            $data['sl_no']              = $nextQuestion->sl_no;
            $data['exam_id']            = $nextQuestion->candidate_exam_id;
            $data['question_id']        = $nextQuestion->id;
            $data['answer_id']          = $nextQuestion->answer_id;
            $data['question']           = $nextQuestion->question;
            $data['options']            = explode('||', $nextQuestion->options);

            $data['nextBtnStatus']      = ($nextQuestion->sl_no==$total_questions? 0:1); //0=disable/hide
            $data['previousBtnStatus']  = ($nextQuestion->sl_no==1? 0:1); //0=disable/hide


            $data['status']             = 1;
            $data['message']            = "Your Question Submitted!";
        }

        $data['examRemainingTime']             = self::examRemainingTime($candidateExam->exam_config_id);

        return response($data);
    }
    //END EXAM SUBMIT


    //START CANDIDATE EXAM PREVIOUS QUESTION
    public function canExamPreviousQuestion(Request $request) {
        $previousQuestion = CandidateExamDetail::where('candidate_exam_id', $request->exam_id)->where('sl_no', $request->sl_no-1)->find($request->question_id-1);

        $currentQuestion = CandidateExamDetail::find($request->question_id)->first();

        $data['total_questions']    = $total_questions = CandidateExamDetail::where('candidate_exam_id', $previousQuestion->candidate_exam_id)->count();

        $candidateExam = CandidateExam::find($previousQuestion->candidate_exam_id);

        if ($request->sl_no>0) {
            $currentQuestion->update([
                'running_question_status'   => 0,
            ]);

            $previousQuestion->update([
                'running_question_status'   => 1,
            ]);

            $data['sl_no']              = $previousQuestion->sl_no;
            $data['exam_id']            = $previousQuestion->candidate_exam_id;
            $data['question_id']        = $previousQuestion->id;
            $data['answer_id']          = $previousQuestion->answer_id;
            $data['question']           = $previousQuestion->question;
            $data['item_type']          = $previousQuestion->item_type;
            $data['options']            = explode('||', $previousQuestion->options);
            $data['option_type']        = $previousQuestion->option_type;

            $data['nextBtnStatus']      = ($currentQuestion->sl_no==$total_questions? 0:1); //0=disable/hide
            $data['previousBtnStatus']  = ($previousQuestion->sl_no==1? 0:1); //0=disable/hide

            $data['status']             = 1;
            $data['message']            = "Your exam already configured!";
        } else {
            $data['status']             = 0;
            $data['nextBtnStatus']      = 0; //0=disable/hide
            $data['previousBtnStatus']  = 0; //0=disable/hide

        }

        $data['examRemainingTime']             = self::examRemainingTime($candidateExam->exam_config_id);

        return response($data);
    }
    //END CANDIDATE EXAM PREVIOUS QUESTION


    //START CANDIDATE EXAM INSTRUCTION
    public function examInstruction(Request $request)
    {

        $data['examId']             = $examId = $request->examId;
        $data['step_id']            = $step_id = $request->step_id;
        $authId                     = Auth::guard('candAuth')->id();
        $data['userInfo']           = $userInfo = Candidates::find($authId);
        $authBoard                  = $userInfo->board_no;
        $currentDate                = date('Y-m-d');
        $cTime                      = new DateTime( "now", new DateTimeZone( "Asia/Dhaka" ) );
        $currentTime                = $cTime->format( 'H:i:s' );
        $examConfigDetails          = ExamConfig::find($examId);

        $candidateExamInfo          = CandidateExam::where('candidate_id', $authId)->where('exam_config_id', $examConfigDetails->id)
           //->where('exam_date', $examConfigDetails->exam_date)
           ->latest()->first(); // latest() added by Md.Saiful Islam
        $data['configInstruction']  = $configInstruction= ConfigInstruction::where('test_config_id', $examConfigDetails->test_config_id)->first();

        // FOR CHECKING NEXT INSTRUCTION
        $isNextConfigInstruction = ConfigInstruction::where('test_config_id', $examConfigDetails->test_config_id)
            ->where('id', '>', $configInstruction->id)
            ->orderBy('id', 'ASC')
            ->count();
            // dd($isNextConfigInstruction);

            if ($authBoard != 'preview') {
                if ($isNextConfigInstruction == 0) {
                    $data['instructionEndStatus']  = 0;
                } else {
                    $data['instructionEndStatus']  = 1;
                }
            } else {
                $data['instructionEndStatus']  = 0;
            }
        if($candidateExamInfo){
            if ($candidateExamInfo->instruction_seen_status==0) {
                // $candidateExamInfo->update([
                //     'instruction_seen_status' => 1,
                // ]);

                return view('candidates.intructionDemoExam.instruction', $data);
            } elseif ($candidateExamInfo->instruction_seen_status==1 && $candidateExamInfo->demo_exam_status==0) {

                return view('candidates.intructionDemoExam.examDemoQOne', $data);
            } else {
                $output['messege'] = 'Exam has been start';
                $output['msgType'] = 'success';

                return view('candidates.intructionDemoExam.startMainExam', $output);
            }

        } else {
            self::examConfigStartFun($examConfigDetails, $step_id);

            $candidateExamInfo  = CandidateExam::where('candidate_id', $authId)->where('exam_config_id', $examConfigDetails->id)
                //->where('exam_date', $examConfigDetails->exam_date)
                ->latest()->first(); // latest() added by Md.Saiful Islam

            if ($authBoard != 'preview') {
                $candidateExamInfo->update([
                    'instruction_seen_status' => 1,
                ]);
            }

            // $data['examId']     = 1;
            // $data['userInfo']   = $userInfo = Candidates::find($authId);

            return view('candidates.intructionDemoExam.instruction', $data);
        }
    }

    public function getInstruction(Request $request)
    {
        $data['examId']     = $examId = $request->examId;
        $instrucId          = $request->instrucId;
        $authId             = Auth::guard('candAuth')->id();
        $userInfo           = Candidates::find($authId);
        $authBoard          = $userInfo->board_no;
        $examConfigDetails  = ExamConfig::find($examId);

        if (!empty($examConfigDetails)) {
            $data['configInstruction'] = $configInstruction = ConfigInstruction::where('test_config_id', $examConfigDetails->test_config_id)
                ->where('id', '>', $instrucId)
                ->orderBy('id', 'ASC')
                ->first();
            // dd($configInstruction);
            $data['instrucId']  = $configInstruction->id;
            $data['text']  = $configInstruction->text;
            $data['image']  = $configInstruction->image;

            // FOR CHECKING NEXT INSTRUCTION
            $isNextConfigInstruction = ConfigInstruction::where('test_config_id', $examConfigDetails->test_config_id)
                ->where('id', '>', $configInstruction->id)
                ->orderBy('id', 'ASC')
                ->count();

            if ($authBoard != 'preview') {
                if ($isNextConfigInstruction == 0) {
                    $data['instructionEndStatus']  = 0;
                } else {
                    $data['instructionEndStatus']  = 1;

                    $candidateExamInfo  = CandidateExam::where('candidate_id', $authId)->where('exam_config_id', $examId)->where('exam_date', $examConfigDetails->exam_date)->first();
                    $candidateExamInfo->update([
                        'instruction_seen_status' => 1,
                    ]);
                }
            } else {
                $data['instructionEndStatus']  = 0;
            }

        } else {
            $data['examId']     = $examId = $request->examId;
            $data['instrucId']  = $instrucId = $request->instrucId;
        }
        return response()->json($data);


    }
    //END CANDIDATE EXAM INSTRUCTION

    public function examDemoQOne(Request $request)
    {
        $data['examId'] = $request->examId;
        return view('candidates.intructionDemoExam.examDemoQOne', $data);
    }
    public function examDemoQTwo(Request $request)
    {
        $data['examId'] = $request->examId;
        return view('candidates.intructionDemoExam.examDemoQTwo', $data);
    }
    public function examDemoQThree(Request $request)
    {
        $data['examId'] = $request->examId;
        return view('candidates.intructionDemoExam.examDemoQThree', $data);
    }

    public function examDemoFinish(Request $request)
    {
        $data['examId']             = $examId = $request->examId;
        $authId                     = Auth::guard('candAuth')->id();
        $currentDate                = date('Y-m-d');
        $cTime                      = new DateTime( "now", new DateTimeZone( "Asia/Dhaka" ) );
        $currentTime                = $cTime->format( 'H:i:s' );
        $examConfigDetails          = ExamConfig::find($examId);

        $candidateExamInfo          = CandidateExam::where('candidate_id', $authId)->where('exam_config_id', $examConfigDetails->id)->where('exam_date', $examConfigDetails->exam_date)->first();

        $candidateExamInfo->update([
            'demo_exam_status' => 1,
        ]);
        $data['examConfigRunningStatus'] = $examConfigDetails->exam_status;
        return view('candidates.intructionDemoExam.examDemoFinish', $data);
    }

    public static function examConfigStartFun($examConfigDetails, $step_id) {
        $candidate_id       = Auth::guard('candAuth')->id();
        $currentDate        = date('Y-m-d');
        $cTime              = new DateTime( "now", new DateTimeZone( "Asia/Dhaka" ) );
        $currentTime        = $cTime->format( 'H:i:s' );
        $board_id           = 0;
        $examConfigId       = $examConfigDetails->id;
        $exam_duration      = $examConfigDetails->exam_duration; //By Minutes;
        $start_time         = $examConfigDetails->exam_start_time;
        $end_time           = $examConfigDetails->exam_end_time;

        $testConfigId       = $examConfigDetails->test_config_id;
        $data['candidateExamInfo'] = $candidateExamInfo  = CandidateExam::where('candidate_id', $candidate_id)->where('exam_config_id', $examConfigDetails->id)->where('exam_date', $examConfigDetails->exam_date)->first();


        if (empty($candidateExamInfo)) {

            $storeExam = CandidateExam::create([
                'candidate_id'              => $candidate_id,
                'exam_config_id'            => $examConfigDetails->id,
                'board_id'                  => $board_id,
                'exam_date'                 => $currentDate,
                'exam_duration'             => $exam_duration, //By Minutes
                'start_time'                => $start_time,
                'end_time'                  => $end_time,
                'running_exam_time'         => '00:00',
                'remaining_exam_duration'   => $exam_duration*60,//By Sec
                'created_by'                => $candidate_id,
            ]);

            if ($storeExam) {
                $data['sl_no']          = $sl_no = 1;
                $data['exam_id']        = $storeExam->id;

                $testConfig = TestConfiguration::find($testConfigId);

                if ($testConfig->set_id =='' || $testConfig->set_id==NULL) {
                    $questionIds = explode('||', $testConfig->item_id);
                    $questions = ItemBank::whereIn('id', $questionIds)->get();
                } else {
                    $questionIds = explode('||', QuestionSet::find($testConfig->set_id)->questions_id);
                    $data['questions'] = $questions = ItemBank::whereIn('id', $questionIds)->get();
                }

                foreach($questions as $key=>$question) {
                    if ($question->sub_question_status=='' || $question->sub_question_status==NULL) {

                        $candidateExamDetail = CandidateExamDetail::create([
                            'sl_no'                     => $sl_no,
                            'candidate_exam_id'         => $storeExam->id,
                            'candidate_id'              => $candidate_id,
                            'item_bank_id'              => $question->id,
                            'question_status'           => 1, // 1=Main Question
                            'item_type'                 => $question->item_type,
                            'option_type'               => $question->option_type,
                            'question'                  => $question->item,
                            'options'                   => $question->options,
                            'correct_answer_id'         => $question->correct_answer,
                            'running_question_status'   => ($sl_no==1? 1:0),
                            'created_by'                => $candidate_id,
                            'item_status'               => $question->item_status
                        ]);
                        $sl_no +=1;

                    } else {
                        $subQuestions           = explode('||', $question->sub_question);
                        $subOptions             = explode('~~', $question->sub_options);
                        $sub_correct_answers    = explode('||', $question->sub_correct_answer);

                        foreach ($subQuestions as $subQuestionId => $subQuestion) {
                            $candidateExamDetail = CandidateExamDetail::create([
                                'sl_no'                     => $sl_no,
                                'candidate_exam_id'         => $storeExam->id,
                                'candidate_id'              => $candidate_id,
                                'item_bank_id'              => $question->id,
                                'question_status'           => 2, //2=Sub-Question
                                'sub_item_bank_id'          => $subQuestionId,
                                'item_type'                 => $question->sub_question_type,
                                'option_type'               => $question->sub_option_type,
                                'question'                  => $subQuestion,
                                'options'                   => $subOptions[$subQuestionId],
                                'correct_answer_id'         => $sub_correct_answers[$subQuestionId],
                                'running_question_status'   => ($sl_no==1? 1:0),
                                'created_by'                => $candidate_id,
                                'item_status'               => $question->item_status
                            ]);

                            $sl_no +=1;
                        }
                    }
                }


                $data['examDetails']    = $examDetails = CandidateExamDetail::where('candidate_exam_id', $storeExam->id)->where('running_question_status', 1)->orderBy('id', 'asc')->first();

                $data['total_questions']    = $total_questions = CandidateExamDetail::where('candidate_exam_id', $storeExam->id)->count();
                $data['question_id']        = $examDetails->id;
                $data['answer_id']          = $examDetails->answer_id;
                $data['question']           = $examDetails->question;
                $data['options']            = explode('||', $examDetails->options);

                $data['question_status']    = $examDetails->question_status;
                $data['item_type']          = $examDetails->item_type;
                $data['option_type']        = $examDetails->option_type;

                $data['nextBtnStatus']      = ($examDetails->sl_no==$total_questions? 0:1); //0=disable/hide
                $data['previousBtnStatus']  = ($examDetails->sl_no==1?0:1); //0=disable/hide


                $data['examRemainingTime']             = self::examRemainingTime($examConfigDetails->id);
                $data['status']             = 1;
                $data['message']            = "Your exam configured!";
                // dd('done');
            } else {
                // dd(0);
                $data['status'] = 0;
                $data['message'] = "Something wrong!";
            }
        } else {

            if ($candidateExamInfo->exam_status==2) {
                $data['status'] = 2;
                $data['message'] = "Your exam already finished!";
            } else {
                $examStepQuestion = CandidateExamDetail::where('candidate_exam_id', $candidateExamInfo->id)->where('running_question_status', 1)->orderBy('id', 'asc')->first();
                // dd($examStepQuestion);
                if ($step_id) {
                    $examStepQuestion->update([
                        'running_question_status'=> 0,
                    ]);

                    $examQuestion = CandidateExamDetail::where('candidate_exam_id', $candidateExamInfo->id)->find($step_id);

                    $examQuestion->update([
                        'running_question_status'=> 1,
                    ]);
                } else {
                    $examQuestion = $examStepQuestion;
                }

                if ($examQuestion) {
                    $data['examDetails']    = $examDetails = $examQuestion;
                } else {
                    $data['examDetails']    = $examDetails = CandidateExamDetail::where('candidate_exam_id', $candidateExamInfo->id)->orderBy('id', 'asc')->first();
                }

                $data['total_questions']    = $total_questions = CandidateExamDetail::where('candidate_exam_id', $candidateExamInfo->id)->count();
                $data['sl_no']              = $examDetails->sl_no;
                $data['exam_id']            = $candidateExamInfo->id;
                $data['question_id']        = $examDetails->id;
                $data['answer_id']          = $examDetails->answer_id;
                $data['question']           = $examDetails->question;
                $data['options']            = explode('||', $examDetails->options);

                $data['question_status']    = $examDetails->question_status;
                $data['item_type']          = $examDetails->item_type;
                $data['option_type']        = $examDetails->option_type;

                $data['nextBtnStatus']      = ($examDetails->sl_no==$total_questions? 0:1); //0=disable/hide
                $data['previousBtnStatus']  = ($examDetails->sl_no==1? 0:1); //0=disable/hide

                $data['examRemainingTime']             = self::examRemainingTime($examConfigDetails->id);
                $data['status']             = 1;
                $data['message']            = "Your exam already configured!";
            }
        }

        return $data;
    }


    public static function examRemainingTime($examConfigId){
        $authId             = Auth::guard('candAuth')->id();
        $cTime              = new DateTime( "now", new DateTimeZone( "Asia/Dhaka" ) );
        $cTimeArray         = explode(':', $cTime->format( 'H:i:s' ));
        $hToSec             = ($cTimeArray[0]*60)*60;
        $mToSec             = ($cTimeArray[1]*60);
        $sToSec             = $cTimeArray[2];
        $totalCurrentSec    = $hToSec+$mToSec+$sToSec;

        $configuredExam     = CandidateExam::where('candidate_id', $authId)->where('exam_config_id', $examConfigId)->first();

        $rTimeArray         = explode(':', $configuredExam->running_exam_time);
        $rHToSec            = ($rTimeArray[0]*60)*60;
        $rMToSec            = ($rTimeArray[1]*60);
        $rSToSec            = $rTimeArray[2];
        $totalExamEndSec    = $configuredExam->remaining_exam_duration+$rHToSec+$rMToSec+$rSToSec;

        // dd($configuredExam->running_exam_time);


        $remainingExamTimeSec = $totalExamEndSec-$totalCurrentSec;
        if ($remainingExamTimeSec>0) {
            return $remainingExamTime = $remainingExamTimeSec;
        } else {
            return $remainingExamTime = 0;
        }
    }

    public static function timeToSec($time){
        $cTimeArray         = explode(':', $time);
        $hToSec             = ($cTimeArray[0]*60)*60;
        $mToSec             = ($cTimeArray[1]*60);
        $sToSec             = $cTimeArray[2];
        return $totalSec    = $hToSec+$mToSec+$sToSec;
    }

    //CANDIDATE EXAM INFO UPDATE
    public function canExamInfoUpdate(Request $request){
        $authId                 = Auth::guard('candAuth')->id();
        $userInfo               = Candidates::find($authId);
        $authBoard              = $userInfo->board_no;
        $cTime                  = new DateTime( "now", new DateTimeZone( "Asia/Dhaka" ) );
        $currentTime            = $cTime->format( 'H:i:s' );
        $exam_id                = $request->exam_id;
        $exam_remaining_time    = $request->exam_remaining_time;
        $candidateExam          = CandidateExam::where('candidate_id', $authId)->find($exam_id);
        $output['examStatus']   = ExamConfig::find($candidateExam->exam_config_id)->status;

        if ($candidateExam) {
            if ($authBoard != 'preview') {
                $updateInfo = $candidateExam->update([
                    'running_exam_time'         => $currentTime,
                    'remaining_exam_duration'   => self::timeToSec($exam_remaining_time)
                ]);

                if ($updateInfo) {
                    $output['status']           = 1;
                    $output['message']          = "Update success";
                } else {
                    $output['status']           = 0;
                    $output['message']          = "Something wrong!";
                }
            } else {
                $output['status']           = 0;
                $output['message']          = "Something wrong!";
            }
        } else {
            $output['status']           = 0;
            $output['message']          = "Something wrong!";
        }


        return $output;

    }

    public function autoCandidateExamSubmit(Request $request){
        $exam_id                = $request->exam_id;
        $authId                 = Auth::guard('candAuth')->id();
        $userInfo               = Candidates::find($authId);
        $authBoard              = $userInfo->board_no;

        $dueQuestions = CandidateExamDetail::where('candidate_exam_id', $exam_id)->where('status', 0)->get()->pluck('id');

        if ($authBoard!='preview') {
            $candidateExam = CandidateExam::find($exam_id)->update([
                'exam_status' => 2
            ]);

            if ($candidateExam) {
                foreach($dueQuestions as $dueQuesId){
                    CandidateExamDetail::find($dueQuesId)->update([
                        "answer_status" => 0,
                        "status"        => 1
                    ]);
                }
            }
        }

        return $data['status'] = 1;;
    }
}
