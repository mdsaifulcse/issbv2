<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PsyModule;

class PsyModuleController extends Controller
{
    /*session calender*/
    public function sessionCalenderList()
    {
        $data = PsyModule::where('type', 'session_calender')->paginate(10);
        return view('psycologist.session_calender.list', compact('data'));
    }

    public function createSessionCalender()
    {
        return view('psycologist.session_calender.create');
    }

    public function storeSessionCalender(Request $request)
    {
        $insert = new PsyModule;

        $insert->title = $request->title;
        if ($request->hasFile('item_img')) {
            $file = $request->file('item_img');
            $file_name = rand(3,3) . '_' . $file->getClientOriginalName();
            $file->move(public_path('/assets/uploads/psy_module/'), $file_name);
            $insert->file = $file_name;
            $insert->extension = $file->getClientOriginalExtension();
        }

        $insert->details = $request->picture_details;
        $insert->type = "session_calender";
        $insert->order = $request->order;
        $insert->status = 1;
        $insert->save();

        return redirect('session-calender-list');
    }

    public function editSessionCalender($id)
    {
        $data = PsyModule::findOrFail($id);
        return view('psycologist.session_calender.edit')->with('data', $data);
    }

    public function updateSessionCalender(Request $request)
    {
        $fid = $request->fid;
        $insert = PsyModule::findOrFail($fid);

        $insert->title = $request->title;
        if ($request->hasFile('item_img')) {
            $file = $request->file('item_img');
            $file_name = str_random(3) . '_' . $file->getClientOriginalName();
            $file->move(public_path('/assets/uploads/psy_module/'), $file_name);
            $insert->file = $file_name;
            $insert->extension = $request->picture_details;
        }

        $insert->details = $request->picture_details;
        $insert->type = "session_calender";
        $insert->order = $request->order;
        $insert->save();

        return redirect('session-calender-list');
    }

    public function destroySessionCalender($id)
    {
        $delete = PsyModule::findOrFail($id);
        $file_path = public_path('/assets/uploads/psy_module/') . $delete->file;
        if (file_exists($file_path)) {
            unlink($file_path);
        }

        $delete->delete();
        return ('success');
    }
    /*session calender ends*/

    /* tat bl */
    public function tatBlList()
    {
        $data = PsyModule::where('type', 'tat_bl')->paginate(10);
        return view('psycologist.tat_bl.list', compact('data'));
    }

    public function createTatBl()
    {
        return view('psycologist.tat_bl.create');
    }

    public function storeTatBl(Request $request)
    {
        $insert = new PsyModule;

        $insert->title = $request->title;
        if ($request->hasFile('item_img')) {
            $file = $request->file('item_img');
            $file_name = str_random(3) . '_' . $file->getClientOriginalName();
            $file->move(public_path('/assets/uploads/psy_module/'), $file_name);
            $insert->file = $file_name;
            $insert->extension = $file->getClientOriginalExtension();
        }

        $insert->details = $request->picture_details;
        $insert->type = "tat_bl";
        $insert->order = $request->order;
        $insert->status = 1;
        $insert->save();

        return redirect('tat-bl-list');
    }

    public function editTatBl($id)
    {
        $data = PsyModule::findOrFail($id);
        return view('psycologist.tat_bl.edit')->with('data', $data);
    }

    public function updateTatBl(Request $request)
    {
        $fid = $request->fid;
        $insert = PsyModule::findOrFail($fid);

        $insert->title = $request->title;
        if ($request->hasFile('item_img')) {
            $file = $request->file('item_img');
            $file_name = str_random(3) . '_' . $file->getClientOriginalName();
            $file->move(public_path('/assets/uploads/psy_module/'), $file_name);
            $insert->file = $file_name;
            $insert->extension = $request->picture_details;
        }

        $insert->details = $request->picture_details;
        $insert->type = "tat_bl";
        $insert->order = $request->order;
        $insert->save();

        return redirect('tat-bl-list');
    }

    public function destroyTatBl($id)
    {
        $delete = PsyModule::findOrFail($id);
        $file_path = public_path('/assets/uploads/psy_module/') . $delete->file;
        if (file_exists($file_path)) {
            unlink($file_path);
        }

        $delete->delete();
        return ('success');
    }
    /*tat bl ends*/

    /* course schedule */
    public function courseScheduleList()
    {
        $data = PsyModule::where('type', 'course_schedule')->paginate(10);
        return view('psycologist.course_schedule.list', compact('data'));
    }

    public function createCourseSchedule()
    {
        return view('psycologist.course_schedule.create');
    }

    public function storeCourseSchedule(Request $request)
    {
        $insert = new PsyModule;

        $insert->title = $request->title;
        if ($request->hasFile('item_img')) {
            $file = $request->file('item_img');
            $file_name = str_random(3) . '_' . $file->getClientOriginalName();
            $file->move(public_path('/assets/uploads/psy_module/'), $file_name);
            $insert->file = $file_name;
            $insert->extension = $file->getClientOriginalExtension();
        }

        $insert->details = $request->picture_details;
        $insert->type = "course_schedule";
        $insert->order = $request->order;
        $insert->status = 1;
        $insert->save();

        return redirect('course-schedule-list');
    }

    public function editCourseSchedule($id)
    {
        $data = PsyModule::findOrFail($id);
        return view('psycologist.course_schedule.edit')->with('data', $data);
    }

    public function updateCourseSchedule(Request $request)
    {
        $fid = $request->fid;
        $insert = PsyModule::findOrFail($fid);

        $insert->title = $request->title;
        if ($request->hasFile('item_img')) {
            $file = $request->file('item_img');
            $file_name = str_random(3) . '_' . $file->getClientOriginalName();
            $file->move(public_path('/assets/uploads/psy_module/'), $file_name);
            $insert->file = $file_name;
            $insert->extension = $request->picture_details;
        }

        $insert->details = $request->picture_details;
        $insert->type = "course_schedule";
        $insert->order = $request->order;
        $insert->save();

        return redirect('course-schedule-list');
    }

    public function destroyCourseSchedule($id)
    {
        $delete = PsyModule::findOrFail($id);
        $file_path = public_path('/assets/uploads/psy_module/') . $delete->file;
        if (file_exists($file_path)) {
            unlink($file_path);
        }

        $delete->delete();
        return ('success');
    }
    /*course schedule ends*/

    /* upcoming events */
    public function upcomingEventsList()
    {
        $data = PsyModule::where('type', 'upcoming_events')->paginate(10);
        return view('psycologist.upcoming_events.list', compact('data'));
    }

    public function createUpcomingEvents()
    {
        return view('psycologist.upcoming_events.create');
    }

    public function storeUpcomingEvents(Request $request)
    {
        $insert = new PsyModule;

        $insert->title = $request->title;
        if ($request->hasFile('item_img')) {
            $file = $request->file('item_img');
            $file_name = str_random(3) . '_' . $file->getClientOriginalName();
            $file->move(public_path('/assets/uploads/psy_module/'), $file_name);
            $insert->file = $file_name;
            $insert->extension = $file->getClientOriginalExtension();
        }

        $insert->details = $request->picture_details;
        $insert->type = "upcoming_events";
        $insert->order = $request->order;
        $insert->status = 1;
        $insert->save();

        return redirect('upcoming-events-list');
    }

    public function editUpcomingEvents($id)
    {
        $data = PsyModule::findOrFail($id);
        return view('psycologist.upcoming_events.edit')->with('data', $data);
    }

    public function updateUpcomingEvents(Request $request)
    {
        $fid = $request->fid;
        $insert = PsyModule::findOrFail($fid);

        $insert->title = $request->title;
        if ($request->hasFile('item_img')) {
            $file = $request->file('item_img');
            $file_name = str_random(3) . '_' . $file->getClientOriginalName();
            $file->move(public_path('/assets/uploads/psy_module/'), $file_name);
            $insert->file = $file_name;
            $insert->extension = $request->picture_details;
        }

        $insert->details = $request->picture_details;
        $insert->type = "upcoming_events";
        $insert->order = $request->order;
        $insert->save();

        return redirect('upcoming-events-list');
    }

    public function destroyUpcomingEvents($id)
    {
        $delete = PsyModule::findOrFail($id);
        $file_path = public_path('/assets/uploads/psy_module/') . $delete->file;
        if (file_exists($file_path)) {
            unlink($file_path);
        }

        $delete->delete();
        return ('success');
    }
    /*upcoming events ends*/

    /* testing schedule */
    public function testingScheduleList()
    {
        $data = PsyModule::where('type', 'testing_schedule')->paginate(10);
        return view('psycologist.testing_schedule.list', compact('data'));
    }

    public function createTestingSchedule()
    {
        return view('psycologist.testing_schedule.create');
    }

    public function storeTestingSchedule(Request $request)
    {
        $insert = new PsyModule;

        $insert->title = $request->title;
        if ($request->hasFile('item_img')) {
            $file = $request->file('item_img');
            $file_name = str_random(3) . '_' . $file->getClientOriginalName();
            $file->move(public_path('/assets/uploads/psy_module/'), $file_name);
            $insert->file = $file_name;
            $insert->extension = $file->getClientOriginalExtension();
        }

        $insert->details = $request->picture_details;
        $insert->type = "testing_schedule";
        $insert->order = $request->order;
        $insert->status = 1;
        $insert->save();

        return redirect('testing-schedule-list');
    }

    public function editTestingSchedule($id)
    {
        $data = PsyModule::findOrFail($id);
        return view('psycologist.testing_schedule.edit')->with('data', $data);
    }

    public function updateTestingSchedule(Request $request)
    {
        $fid = $request->fid;
        $insert = PsyModule::findOrFail($fid);

        $insert->title = $request->title;
        if ($request->hasFile('item_img')) {
            $file = $request->file('item_img');
            $file_name = str_random(3) . '_' . $file->getClientOriginalName();
            $file->move(public_path('/assets/uploads/psy_module/'), $file_name);
            $insert->file = $file_name;
            $insert->extension = $request->picture_details;
        }

        $insert->details = $request->picture_details;
        $insert->type = "testing_schedule";
        $insert->order = $request->order;
        $insert->save();

        return redirect('testing-schedule-list');
    }

    public function destroyTestingSchedule($id)
    {
        $delete = PsyModule::findOrFail($id);
        $file_path = public_path('/assets/uploads/psy_module/') . $delete->file;
        if (file_exists($file_path)) {
            unlink($file_path);
        }

        $delete->delete();
        return ('success');
    }
    /*testing schedule ends*/

    /* announcement */
    public function announcementList()
    {
        $data = PsyModule::where('type', 'announcement')->paginate(10);
        return view('psycologist.announcement.list', compact('data'));
    }

    public function createAnnouncement()
    {
        return view('psycologist.announcement.create');
    }

    public function storeAnnouncement(Request $request)
    {
        $insert = new PsyModule;

        $insert->title = $request->title;
        if ($request->hasFile('item_img')) {
            $file = $request->file('item_img');
            $file_name = rand(3,3) . '_' . $file->getClientOriginalName();
            $file->move(public_path('/assets/uploads/psy_module/'), $file_name);
            $insert->file = $file_name;
            $insert->extension = $file->getClientOriginalExtension();
        }

        $insert->details = $request->picture_details;
        $insert->type = "announcement";
        $insert->order = $request->order;
        $insert->status = 1;
        $insert->save();

        return redirect('announcement-list');
    }

    public function editAnnouncement($id)
    {
        $data = PsyModule::findOrFail($id);
        return view('psycologist.announcement.edit')->with('data', $data);
    }

    public function updateAnnouncement(Request $request)
    {
        $fid = $request->fid;
        $insert = PsyModule::findOrFail($fid);

        $insert->title = $request->title;
        if ($request->hasFile('item_img')) {
            $file = $request->file('item_img');
            $file_name = str_random(3) . '_' . $file->getClientOriginalName();
            $file->move(public_path('/assets/uploads/psy_module/'), $file_name);
            $insert->file = $file_name;
            $insert->extension = $request->picture_details;
        }

        $insert->details = $request->picture_details;
        $insert->type = "announcement";
        $insert->order = $request->order;
        $insert->save();

        return redirect('announcement-list');
    }

    public function destroyAnnouncement($id)
    {
        $delete = PsyModule::findOrFail($id);
        $file_path = public_path('/assets/uploads/psy_module/') . $delete->file;
        if (file_exists($file_path)) {
            unlink($file_path);
        }

        $delete->delete();
        return ('success');
    }
    /*announcement ends*/


    /*Share Docs*/
    public function shareDocList()
    {
        $sharedocs = PsyModule::where('type', 'share_doc')->orderBy('id','DESC')->take(10)->get();
        return view('welcome', compact('sharedocs'));
    }


    public function storeShareDoc(Request $request)
    {
        $insert = new PsyModule;

        $insert->title = $request->title;
        if ($request->hasFile('item_img')) {
            $file = $request->file('item_img');
            $file_name = str_random(3). '_' . $file->getClientOriginalName();
            $file->move(public_path('/assets/uploads/psy_module/'), $file_name);
            $insert->file = $file_name;
            $insert->extension = $file->getClientOriginalExtension();
        }
        $insert->type = "share_doc";
        $insert->order = 0;
        $insert->status = 1;
        $insert->save();

        return view('welcome');
        //return redirect('session-calender-list');
    }
    /*Share Docs ends*/

}
