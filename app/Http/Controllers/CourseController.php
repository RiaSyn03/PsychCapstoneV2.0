<?php

namespace App\Http\Controllers;

use App\Course;
use App\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::guest())
        {
            return redirect()->route('/');
        }
        // $courses = DB::table('courses')
        // ->join('departments', 'departments.id', '=', 'courses.dept_id')
        // ->select('courses.*', 'departments.dept_name')
        // ->get();

        // $courses = Course::with(['department'])->first();
        $department = Department::with(['courses'])->get();
        return view('admin.users.course', compact('department'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
            'course_name' => 'required',
            'dept_id' => 'required'
        ]);

        Course::create([
            'course_name' => $request->course_name,
            'dept_id' => $request->dept_id
        ]);

        return redirect()->route('department.index')->with('message', 'Course has been saved!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $request->validate([
            'course_name'=>'required',
        ]);

        $courses = Course::find($id);

        $courses->course_name = $request->input('course_name');

        $courses->update();

        return redirect()->back()->with('success', 'Course Updated');
    }

    public function destroy($id)
    {
        $courses = Course::find($id);
        $courses->delete();

        return redirect()->back()->with('message', 'This course has been deleted.');
    }


}
