<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class ExamController extends Controller
{
    public function candidateLogin()
    {
        return view('candidates.login');
    }

    public function candidateLoginProcess(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cboard' => 'required',
            'cchestno' => 'required',
            'fullname' => 'required',
            'roll_no' => 'required',
            'course' => 'required',
            'date' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        Session::put('cboard', $request->cboard);
        Session::put('cchestno', $request->cchestno);
        Session::put('cfullname', $request->fullname);
        Session::put('crollno', $request->roll_no);
        Session::put('ccourse', $request->course);
        Session::put('cdate', $request->date);

        $board = Session::get('cboard');
        $chestno = Session::get('cchestno');
        $fullname = Session::get('cfullname');
        $candidateroll = Session::get('crollno');
        $candidatecourse = Session::get('ccourse');
        $date = Session::get('cdate');

        return view('candidates.welcome')->with([
            'board' => $board,
            'chestno' => $chestno,
            'fullname' => $fullname,
            'candidateroll' => $candidateroll,
            'candidatecourse' => $candidatecourse,
            'date' => $date,
        ]);
    }

    public function candidateInstructions(Request $request)
    {
        $board = Session::get('cboard');
        $chestno = Session::get('cchestno');
        $fullname = Session::get('cfullname');
        $candidateroll = Session::get('crollno');
        $candidatecourse = Session::get('ccourse');
        $date = Session::get('cdate');

        if (!$request->session()->has('cchestno')) {
            return redirect('candidate/login');
        }

        return view('candidates.instructions')->with([
            'board' => $board,
            'chestno' => $chestno,
            'fullname' => $fullname,
            'candidateroll' => $candidateroll,
            'candidatecourse' => $candidatecourse,
            'date' => $date,
        ]);
    }

    public function sampleTest(Request $request)
    {
        $board = Session::get('cboard');
        $chestno = Session::get('cchestno');
        $fullname = Session::get('cfullname');
        $candidateroll = Session::get('crollno');
        $candidatecourse = Session::get('ccourse');
        $date = Session::get('cdate');

        if (!$request->session()->has('cchestno')) {
            return redirect('candidate/login');
        }

        return view('candidates.sample-test')->with([
            'board' => $board,
            'chestno' => $chestno,
            'fullname' => $fullname,
            'candidateroll' => $candidateroll,
            'candidatecourse' => $candidatecourse,
            'date' => $date,
        ]);
    }
}
