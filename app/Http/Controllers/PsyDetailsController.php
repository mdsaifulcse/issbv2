<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PsyModule;

class PsyDetailsController extends Controller
{
    public function sessionCalender()
    {
        $data = PsyModule::where('type', 'session_calender')->orderBy('order','ASC')->paginate(10);
        return view('psycologist.details.session_calender', compact('data'));
    }
    public function tatBl()
    {
        $data = PsyModule::where('type', 'tat_bl')->orderBy('order','ASC')->paginate(10);
        return view('psycologist.details.tat_bl', compact('data'));
    }
    public function courseSchedule()
    {
        $data = PsyModule::where('type', 'course_schedule')->orderBy('order','ASC')->paginate(10);
        return view('psycologist.details.course_schedule', compact('data'));
    }
    public function upcomingEvents()
    {
        $data = PsyModule::where('type', 'upcoming_events')->orderBy('order','ASC')->paginate(10);
        return view('psycologist.details.upcoming_events', compact('data'));
    }
    public function testingSchedule()
    {
        $data = PsyModule::where('type', 'testing_schedule')->orderBy('order','ASC')->paginate(10);
        return view('psycologist.details.testing_schedule', compact('data'));
    }
    public function announcement()
    {
        $data = PsyModule::where('type', 'announcement')->orderBy('order','ASC')->orderBy('order','ASC')->paginate(10);
        return view('psycologist.details.announcement', compact('data'));
    }
}
