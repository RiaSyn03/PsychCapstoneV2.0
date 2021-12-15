<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Approvedappointment;
use DB;

class Myapprovedappointments extends Controller
{
    public function index()
    {

        $appointments = DB::table('timeslots')
        ->join('approvedappointments as approved', 'approved.timeslot_id', '=', 'timeslots.id')
        ->join('timeslots as time', 'approved.timeslot_id', '=', 'time.id')
        ->select('time.id as time_id','time.user_idnum as user_idnum','time.user_fname as user_name', 'time.time as timeslot_time', 'time.date as timeslot_date', 'approved.councilour_name as councilour_name')
        ->get()->toArray();
        
        return view('admin.users.councilour.listofapprovedappointments')->with(['appointments' => $appointments]);
    }

    public function store(Request $request)
    {
        $approvedappointment = new Approvedappointment;     
        $approvedappointment->timeslot_id = $request->id;
        $approvedappointment->councilour_name = $request->user()->fname;
        $approvedappointment->save();

        
        
        

        return redirect()->route('listofapprovedappointments')->with('success','Appointment Added !');
    }
}
