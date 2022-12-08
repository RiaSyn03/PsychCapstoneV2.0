@extends('layouts.app')

@section('content')
<section>

     <header>
     <div class="logo"><img src="{{ asset('img/logo.gif') }}"></div>
         <ul>
         <li>
                    <div class="dropdown">
                        <a class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->fname }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                      </div>
                </li>
                <li><a href="{{ url('viewtime') }}" class="active">Appointments</a></li>
                <li><a href="{{ url('viewquestions') }}">Questions</a></li>
             <li><a href="{{ url('home') }}" >Home</a></li>
         </ul>
     </header>
     @include('partials.alerts')
      <div class="card-body">
      <br><br><br><br>
    <div class="tabbed">
    <input type="radio" name="tabs" id="tab-nav-1" checked>
    <label for="tab-nav-1"> Lists</label>
    <input type="radio" name="tabs" id="tab-nav-2">
    <label for="tab-nav-2">Accepted</label>
    <input type="radio" name="tabs" id="tab-nav-3">
    <label for="tab-nav-3">Re-Schedule</label>
    <input type="radio" name="tabs" id="tab-nav-4">
    <label for="tab-nav-4">Completed</label>
    <div class="tabs">

      <div>
    <table class="table table-striped">
<thead>
<tr>

<td><center>ID Number </center></td>
<td> <center>Name</center> </td>
<td><center>Date</center> </td>
<td><center>Time </center></td>
<td> <center>Email</center> </td>
<td><center>Action</center></td>


</tr>
</thead>
<tbody id="dynamic-row">

@forelse($timescheds as $t)
<tr>
<input type="hidden" class="btn_val_id" value="{{ $t->id }}">
<td><center><input type="hidden" name="user_idnum" value="{{ $t->user_idnum }}" ><p>{{ $t->user_idnum }}</p></center></td>
<td><center><input type="hidden" name="user_fname" value="{{ $t->user_fname }} "><p>{{ $t->user_fname }}</p></center></td>
<td><center><input type="hidden" name="date" value="{{ $t->date }} "><p>{{ date('d F, Y', strtotime($t->date)) }}</p></center></td>
<td><center><input type="hidden" name="time" value="{{ $t->time }} "><p>{{ $t->time }}</p></center></td>
<td><center><input type="hidden" name="time" value="{{ $t->user_email }} "><p>{{ $t->user_email }}</p></center></td>
<input type="hidden" name="status" value="accepted "/>
<input type="hidden" name="counselor_name" value="{{ Auth::user()->fname }} "/>

<td>
</form>
@if ($t->status='pending')
  <a href="{{url ('change-status/'.$t->id) }}" class="btn btn-success" onclick="return confirm('Are you sure?')">Accept</a>
  @else
  <a href="{{url ('change-status/'.$t->id) }}" class="btn btn-danger">Pending</a>
  @endif
  <a href="/reschedule/{{$t->id}}" class="btn btn-warning" onclick="return confirm('Are you sure?')">Reschedule</a>
@empty
    <td colspan="6" class="text-center">No Data</td>
@endforelse

  <!-- Decline Modal -->
<div class="p-2">
       <div id="popup">
       <div class="wrapper" >
         <h2><div class="title"><center>Re-Scheduling</center></div></h2>
         <form method="POST" action="viewtime-email">
   @csrf
   <div class="box">
   <div class="row">
                                        <div class="col-8 col-sm-8">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Email</span>
                                            <input type="text" id="email" name="email" placeholder="Copy the Student's Email" class="form-control">
                                        </div>
                                        </div></div>
                                        <div class="col-8 col-sm-8">
                                            <input type="text" id="subject" name="subject" value="FOR RESCHEDULE" class="form-control" hidden>
                                        </div></div>
                                  <div class="col-6 col-sm-8">
                                        <div class="input-group mb-9">
                                            <span class="input-group-text">Re-Schedule Note</span>
                                            <textarea row="5" cols="80" id="body" name="body" placeholder="Reason or Note for reschedule" class="form-control"></textarea>
                                        </div>
   </div>
   <br><br><br>
   <center><button type="submit" class="submitbtn" name="sendmail">Submit</button></center>
 </form>

 <center> <div onclick="toggle()" class="submitbtn" >Close</div></center>
         </div>
        </div>
</div>
<!-- End of Modal -->
    </td>
</tr>
</tbody>
</table>
</div>
<div>
<form method="POST" action="viewtime-done" >
  @csrf
      <table class="table table-striped">
      <thead>
<tr>
<td><center>ID Number </center></td>
<td><center> Name </center></td>
<td><center>Date </center></td>
<td><center>Time </center></td>
<td><center>Action </center></td>
</tr>
</thead>
<tbody id="dynamic-row">
@forelse($acceptedlist as $a)
<tr>
<input type="hidden" class="btn_val_id" value="{{ $a->id }}">
<td><center><input type="hidden" name="user_idnum" value="{{ $a->user_idnum }}" ><p>{{ $a->user_idnum }}</p></center></td>
<td><center><input type="hidden" name="user_fname" value="{{ $a->user_fname }} "><p>{{ $a->user_fname }}</p></center></td>
<td><center><input type="hidden" name="date" value="{{ $a->date }} "><p>{{ date('d F, Y', strtotime($a->date)) }}</p></center></td>
<td><center><input type="hidden" name="time" value="{{ $a->time }} "><p>{{ $a->time }}</p></center></td>
<td>
</form>
@if ($a->status='accepted')
  <a href="{{url ('change-done/'.$a->id) }}" class="btn btn-success" onclick="return confirm('Are you sure?')">Done</a>
  @else
  <a href="{{url ('change-done/'.$a->id) }}" class="btn btn-danger">Accepted</a>
  @endif
    </td>
</tr>
@empty
    <td colspan="6" class="text-center">No Data</td>
@endforelse
</tbody>
</table>
</div>
<div>
      <table class="table table-striped">
      <thead>
<tr>
<td><center>ID Number </center></td>
<td><center> Name </center></td>
<td><center>Date </center></td>
<td><center>Time </center></td>
<td><center>Action </center></td>
</tr>
</thead>
<tbody id="dynamic-row">
@forelse($reschedule as $r)
<tr>
<input type="hidden" class="btn_val_id" value="{{ $r->id }}">
<td><center><input type="hidden" name="user_idnum" value="{{ $r->user_idnum }}" ><p>{{ $r->user_idnum }}</p></center></td>
<td><center><input type="hidden" name="user_fname" value="{{ $r->user_fname }} "><p>{{ $r->user_fname }}</p></center></td>
<td><center><input type="hidden" name="date" value="{{ $r->date }} "><p>{{ date('d F, Y', strtotime($r->date)) }}</p></center></td>
<td><center><input type="hidden" name="time" value="{{ $r->time }} "><p>{{ $r->time }}</p></center></td>
<td>
<a href="/updateschedule/{{$r->id}}" class="btn btn-success">Update Time & Date</a>
    </td>
</tr>
@empty
    <td colspan="6" class="text-center">No Data</td>
@endforelse
</tbody>
</table>
</div>
<div>
<table class="table table-striped">
<thead>
<tr>
<td><center>ID Number </center></td>
<td><center> Name </center></td>
<td><center>Date </center></td>
<td><center>Time </center></td>
</tr>
</thead>
<tbody id="dynamic-row">
@forelse($donelist as $d)
<tr>
<td><center><p>{{ $d->user_idnum }} </p></center></td>
<td><center><p>{{ $d->user_fname }}</p></center></td>
<td><center><p>{{ date('d F, Y', strtotime($d->date)) }}</p></center></td>
<td><center><p>{{ $d->time }}</p></center></td>
</tr>
@empty
    <td colspan="6" class="text-center">No Data</td>
@endforelse
</tbody>
</table>
</div>



<script>
  function toggle(){
    var popup = document.getElementById('popup');
    popup.classList.toggle('active');
    var editpopup = document.getElementById('editpopup');
    editpopup.classList.toggle('active');
  }
  </script>

@endsection
