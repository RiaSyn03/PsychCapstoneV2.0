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
        $users = User::with(['role', 'course'])->get();
        // dd($users);
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


    public function editAccount($id)
    {
        $user = User::where('id', $id)->with(['role', 'course'])->first();

        $roles = Role::all();
        // dd($user);
        $courses = Course::all();
        return view('admin.users.edit', compact('courses', 'roles', 'user'));

    }


    public function updateAccount($id, Request $request)
    {
        $request->validate([
            'idnum'=>'required',
            'fname'=>'required',
            'lname'=>'required',
            'course_id'=>'required',
            'year'=>'required',
            'email'=>'required|email',
        ]);
        // dd($request->all());
        $user = User::find($id);

        $user->idnum = $request->input('idnum');
        $user->fname = $request->input('fname');
        $user->lname = $request->input('lname');
        $user->course_id = $request->input('course_id');
        $user->year = $request->input('year');
        $user->email = $request->input('email');

        $user->update();

        return redirect('/user')->with('success','Account Updated');

        // $roles = Role::all();
        // $users = User::with(['role', 'course'])->get();
        // // dd($users);
        // $courses = Course::all();
        // $numusers = User::count();
        // return view('admin.users.index', compact('users', 'numusers', 'courses', 'roles'))->with('success','Account Updated');
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
