<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\Permission;
use DB;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('admin.roles', compact('roles', 'permissions'));
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'display_name' => 'required',
            'description' => 'required',
            'permissions' => 'required',
        ]);

        $role = new Role();
        $role->name = $request->input('name');
        $role->display_name = $request->input('display_name');
        $role->description = $request->input('description');
        $role->save();

        foreach ($request->permissions as $value) {
            $role->attachPermission($value);
        }

        return ('success');
    }

    public function edit($id)
    {
        $role = Role::find($id);
        $rolePermissions = DB::table("permission_role")->where("permission_role.role_id", $id)
            ->lists('permission_role.permission_id');
        return compact('role', 'rolePermissions');
    }

    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'edit_display_name' => 'required',
            'edit_description' => 'required',
            'edit_permissions' => 'required',
        ]);

        $role = Role::find($id);
        $role->display_name = $request->input('edit_display_name');
        $role->description = $request->input('edit_description');
        $role->save();

        DB::table("permission_role")->where("permission_role.role_id", $id)
            ->delete();

        foreach ($request->edit_permissions as $value) {
            $role->attachPermission($value);
        }

        return ('success');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("roles")->where('id', $id)->delete();
        return;
    }
}
