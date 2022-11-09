<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PsyImages;

class TestingController extends Controller
{
    public function psyPictureList()
    {
        $data = PsyImages::paginate(10);
        return view('psy_images_list', compact('data'));
    }

    public function createPsyPictures()
    {
        return view('psy_images_create');
    }

    public function storePsyPictures(Request $request)
    {
        $insert = new PsyImages;

        $insert->title = $request->title;
        if ($request->hasFile('item_img')) {
            $file = $request->file('item_img');
            $file_name = str_random(3) . '_' . $file->getClientOriginalName();
            $file->move(public_path('/assets/uploads/psy_images/'), $file_name);
            $insert->picture = $file_name;
        }
        $insert->details = $request->picture_details;
        $insert->order = $request->order;
        $insert->save();

        return redirect('psy-picture-list');
    }

    public function destroyPsyPictures($id)
    {
        $delete = PsyImages::find($id);
        $file_path = public_path('/assets/uploads/psy_images/') . $delete->picture;
        if (file_exists($file_path)) {
            unlink($file_path);
        }

        $delete->delete();
        return ('success');
    }

    public function editPsyPictures($key)
    {
        $data = PsyImages::findOrFail($key);

        return view('psy_images_create');
    }

    public function tatblList()
    {
        return view('psycologist.tatbl');
    }
}
