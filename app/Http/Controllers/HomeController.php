<?php

namespace App\Http\Controllers;

use App\BoardCandidate;
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
        return view('welcome',compact('activeBoard'));

    }


    public function index()
    {
        return view('home');
    }
}
