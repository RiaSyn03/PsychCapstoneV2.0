<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use App\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth()->check() && (auth()->user()->role_id != 1)){
            Auth::logout();
            return redirect()->route('login')->with('message', 'Your account is restricted');
        }

        $roles = Role::all();
        $users = User::with(['role'])->get();
        $courses = Course::all();
        $numusers = User::count();
        return view('admin.users.index', compact('users', 'numusers', 'courses', 'roles'));

}

    public function create(Request $request)
    {
    $request->validate([
        'idnum'=>'required',
        'fname'=>'required',
        'mname'=>'required',
        'lname'=>'required',
        'course_id'=>'required',
        'year'=>'required',
        'role_id'=>'required',
        'email'=>'required|email',
        'password'=>'required',

    ]);
    $user = User::create([
        'idnum'=> $request->idnum,
        'fname'=> $request->fname,
        'mname'=> $request->mname,
        'lname'=> $request->lname,
        'course_id'=> $request->course_id,
        'year'=> $request->year,
        'role_id'=>$request->role_id,
        'email'=> $request->email,
        'password'=>bcrypt($request->password)

    ]);
        return redirect()->route('admin.users.index')->with('success','Student Added');
    }

    public function makecounselour(Request $request)
        {
            $request->validate([
                'idnum'=>'required',
                'fname'=>'required',
                'mname'=>'required',
                'lname'=>'required',
                'course_id'=>'required',
                'year'=>'required',
                'role_id'=>'required',
                'email'=>'required|email',
                'password'=>'required',

            ]);
            $user = User::create([
                'idnum'=> $request->idnum,
                'fname'=> $request->fname,
                'mname'=> $request->mname,
                'lname'=> $request->lname,
                'course_id'=> $request->course_id,
                'year'=> $request->year,
                'role_id'=>$request->role_id,
                'email'=> $request->email,
                'password'=>bcrypt($request->password)

            ]);
        return redirect()->route('admin.users.index')->with('success','Counselor Added');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->id == $id){
            return redirect()->route('admin.users.index')->with('warning', 'You are not allowed to edit yourself.');
        }

        return view('admin.users.edit')->with(['user'=>User::find($id)]);
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
        $request->validate([
            'idnum'=>'required',
            'fname'=>'required',
            'mname'=>'required',
            'lname'=>'required',
            'course_id'=>'required',
            'year'=>'required',
            'email'=>'required|email',
        ]);
        $users = User::find($id);

        $users->idnum = $request->input('idnum');
        $users->fname = $request->input('fname');
        $users->mname = $request->input('mname');
        $users->lname = $request->input('lname');
        $users->course_id = $request->input('course_id');
        $users->year = $request->input('year');
        $users->email = $request->input('email');

        $users->save();

        return redirect('/user')->with('success','Profile Updated');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->id == $id){
            return redirect('/user')->with('warning', 'You are not allowed to delete yourself.');
            }
        $user_delete = User::findorFail($id);
        $user_delete->delete();
        return redirect('/user')->with('success','User Deleted');
}
}
