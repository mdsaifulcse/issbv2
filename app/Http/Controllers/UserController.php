<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\RoleUser;
use Illuminate\Support\Facades\Auth;
use DB;
use Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $data = User::has('roles')->get();
        $roles= Role::all();
        return view('admin.users',compact('data','roles'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::lists('display_name','id');
        return view('users.create',compact('roles'));
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm_password',
            'roles' => 'required'
        ]);


        $input = $request->all();
        $input['password'] = Hash::make($input['password']);


        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => $input['password'],
        ]);
        foreach ($request->roles as $role) {
            $user->attachRole($role);
        }


        return ('success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function show($id)
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }*/


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id','=',$id)->first();
        $userRole = DB::table('roles')->join('role_user','roles.id','=','role_user.role_id')->where('role_user.user_id','=',$id)->select('id','display_name')->get();
        return (compact('user','userRole'));
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
            'edit_name' => 'required',
            'edit_email' => 'required|email|unique:users,email,'.$id,
            'edit_password' => 'same:edit_confirm_password',
            'edit_roles' => 'required'
        ]);


        $input = $request->all();



        $user = User::find($id);
        $user->name=$request->edit_name;
        $user->email=$request->edit_email;
        if(!empty($input['edit_password'])) {
            $input['edit_password'] = Hash::make($input['edit_password']);
            $user->password = $input['edit_password'];
        }
        $user->save();


        DB::table('role_user')->where('user_id',$id)->delete();


        foreach ($request->edit_roles as $role) {
            $user->attachRole($role);
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
        User::find($id)->delete();
        return;
    }

}
