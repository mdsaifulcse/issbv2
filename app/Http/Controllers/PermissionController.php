<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permission;
use DB;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions=Permission::all();
        return view('admin.permissions',compact('permissions'));
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|unique:permissions,name',
            'display_name' => 'required',
            'description' => 'required',
        ]);

        $permission = new Permission();
        $permission->name = $request->input('name');
        $permission->display_name = $request->input('display_name');
        $permission->description = $request->input('description');
        $permission->save();


        return ('success');
    }

    public function edit($id)
    {
        $permission = Permission::find($id);
        return compact('permission');
    }

    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'edit_display_name' => 'required',
            'edit_description' => 'required',
        ]);

        $permission = Permission::find($id);
        $permission->display_name = $request->input('edit_display_name');
        $permission->description = $request->input('edit_description');
        $permission->save();

        return ('success');
    }


    public function destroy($id)
    {
        Permission::where('id',$id)->delete();
        return;
    }
}
