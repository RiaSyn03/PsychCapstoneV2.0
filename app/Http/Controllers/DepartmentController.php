<?php

namespace App\Http\Controllers;

use App\Department;
use App\Course;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::with(['courses'])->get();
        // $degrees = Course::where('dept_id', $departments->id)->with(['department'])->first();

        return view('admin.users.department', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
            'dept_name' => 'required',
        ]);

        Department::create([
            'dept_name' => $request->dept_name,
        ]);

        return redirect()->route('department.index')->with('success', 'Department has been saved!');
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

    public function show($id)
    {
        $department = Department::where('id', $id)->with(['courses'])->first();

        return view('admin.users.departmentshow', compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $department = Department::find($id);
        return response()->json($department);
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
            'department_name'=>'required',
        ]);
        // dd($request->all());
        $department = Department::find($id);

        $department->dept_name = $request->input('department_name');

        $department->update();

        return redirect('/department')->with('success','Department Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $departments, $id)
    {
        $departments = Department::find($id);
        $departments->delete();

        return redirect()->route('department.index')->with('message', 'This department has been deleted.');
    }
}
