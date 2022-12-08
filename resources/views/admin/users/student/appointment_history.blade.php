@extends('layouts.app')

@section('content')
<link href="{{ asset('css/calendar.css') }}" rel="stylesheet">
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
                <li><a href="{{ url('category') }}" >Category</a></li>
                <li><a href="{{ url('appointment_history') }}"class="active">Appointments</a></li>
                <li><a href="{{ url('exams_history') }}" >Exam History</a></li>
             <li><a href="{{ url('home') }}" >Home</a></li>
         </ul>
<<<<<<< HEAD
     </header>        
                <div class="card-body"> 
=======
     </header>
     @include('partials.alerts')
                <div class="card-body">
>>>>>>> 33b7eb8c8db5e89cd5c449eb468993a959b8b6da
                  <br><br><br><br>
                <div class="tabbed">
    <input type="radio" name="tabs" id="tab-nav-1" checked>
    <label for="tab-nav-1">Create</label>
    <input type="radio" name="tabs" id="tab-nav-2">
    <label for="tab-nav-2">Pending</label>
    <input type="radio" name="tabs" id="tab-nav-3">
    <label for="tab-nav-3">All Appointments</label>
    <input type="radio" name="tabs" id="tab-nav-4">
    <label for="tab-nav-4">Completed </label>
    <div class="tabs">
      <div>
      <body class="light">
    <center>
    <div class="calendar" id="blur">
        <div class="calendar-header">
            <span class="month-picker" id="month-picker">February</span>
            <div class="year-picker">
                <span class="year-change" id="prev-year">
                    <pre><</pre>
                </span>
                <span id="year">2021</span>
                <span class="year-change" id="next-year">
                    <pre>></pre>
                </span>
            </div>
        </div>
        <div class="calendar-body">
            <div class="calendar-week-day">
                <div style='color:red'>Sun</div>
                <div>Mon</div>
                <div>Tue</div>
                <div>Wed</div>
                <div>Thu</div>
                <div>Fri</div>
                <div>Sat</div>
            </div>
            <div class="calendar-days" ></div>
        </div>
        <div class="month-list"></div>
        </div>
    <div id="popup">
        <h2><div><center>Description</center></div></h2>
        <div id="appointmentDate" min="12/8/2022"></div>
       <br>
        <h3><div><center>Want to make an Appointment ?</center></div></h3>
        <form method="post" action="appointment_history">
        @csrf
        <input type="hidden" name="date" id="appointdate"><br>
        <label>Time: </label>
        <select name="time">
        <!-- <optgroup>Morning</optgroup> -->
      <option value="9:00-10:00 AM">9:00-10:00 AM</option>
      <option value="10:00-11:00 AM">10:00-11:00 AM</option>
      <option value="11:00-12:00 PM">11:00-12:00 PM</option>
      <!-- <optgroup>Afternoon</optgroup> -->
      <option value="1:00-2:00 PM">1:00-2:00 PM</option>
      <option value="2:00-3:00 PM">2:00-3:00 PM</option>
      <option value="3:00-4:00 PM">3:00-4:00 PM</option>
    </select>
   <input type="text" id="status" name="status" value="pending" class="form-control" hidden>
   <input type="text" id="counselor_name" name="counselor_name" value="Not yet accepted" class="form-control" hidden>
  <button type="submit" class="confirm">Submit</button>
</form>

        <div onclick="toggle()"><center>Close</center></div>
    </div>


    <script src="js/calendar.js"></script>
</div>
<div>
      <table class="table table-striped">
   <thead>
   <div class="panel-body">
   <tr>
   <th colspan="5"><center><h2>Pending</h2></center></th>
</tr>
   <tr>
<td><center>Date </center></td>
<td><center>Time </center></td>
<td><center>Status </center></td>
<td><center>Action </center></td>
</tr>
  </thead>
  <tbody id="dynamic-row">
  @foreach($pending as $p)
<tr>
  @csrf
    <input type="hidden" class="btn_val_id" value="{{ $p->id }}">
<td><center><p>{{ date('d F, Y', strtotime($p->date)) }}</p></center></td>
<td><center><p>{{ $p->time }}</p></center></td>
<td><center><p>{{ $p->status }}</p></center></td>
<td><center><button type="button" class="btn btn-danger del">Cancel</button></center></td>
</tr>
@endforeach
</table>
</div>
      <div>
      <table class="table table-striped">
   <thead>
   <div class="panel-body">
   <tr>
   <th colspan="5"><center><h2>All Appointments</h2></center></th>
</tr>
   <tr>
<td><center>Date </center></td>
<td><center>Time </center></td>
<td><center>Status </center></td>
</tr>
  </thead>
  <tbody id="dynamic-row">
  @foreach($mylist as $history)
<tr>
  @csrf
    <input type="hidden" class="btn_val_id" value="{{ $history->id }}">
<td><center><p>{{ date('d F, Y', strtotime($history->date)) }}</p></center></td>
<td><center><p>{{ $history->time }}</p></center></td>
<td><center><p>{{ $history->status }}</p></center></td>
</tr>
@endforeach
</table>
</div>
      <div>
      <table class="table table-striped">
<thead>

   <tr>
   <th colspan="5"><center><h2>Finished Appointments</h2></center></th>
</tr>
<tr>
<td><center>Date </center></td>
<td> <center>Time</center></td>
<td><center>Councilour Name</center></td>
</tr>
</thead>
@foreach($donelist as $d)
<tr>
<td><center><p>{{ date('d F, Y', strtotime($d->date)) }} </p><center></td>
<td><center><p>{{ $d->time }} </p></center></td>
<td> <center><p>{{ $d->counselor_name }} </p></center></td>
</tr>
@endforeach
</tbody>
</table>
  </div>
  </div>
</div>
<!-- DELETE FOR PENDING -->
<script>
$(document).ready(function(){
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
  $('.del').click(function (e){
    e.preventDefault();
var delete_id = $(this).closest("tr").find('.btn_val_id').val();
const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success ml-3',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false
})

swalWithBootstrapButtons.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, delete it!',
  cancelButtonText: 'No, cancel!',
  reverseButtons: true
}).then((result) => {
  if (result.isConfirmed) {
    var data = {
      "_token": $('input[name=_token]').val(),
      "id": delete_id,
    };
    $.ajax({
      type: "DELETE",
      url: '/appointment-delete/'+delete_id,
      data: data,
      success: function (response) {
      swalWithBootstrapButtons.fire(
      'Deleted!',
      'Your schedule has been deleted.',
      'success'
    )
    .then((result) => {
      location.reload();
    });
      }
    });
<<<<<<< HEAD
    
=======


>>>>>>> 33b7eb8c8db5e89cd5c449eb468993a959b8b6da
  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {
    swalWithBootstrapButtons.fire(
      'Cancelled',
      'Your schedule is safe',
      'error'
    )
  }
})
   });
});
</script>
<!-- END FOR PENDING -->

<!-- FOR COMPLETED -->
<script>
$(document).ready(function(){
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
  $('.completed-delete').click(function (e){
    e.preventDefault();
var delete_id = $(this).closest("tr").find('.btn_val_id').val();
    const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false
})
swalWithBootstrapButtons.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, delete it!',
  cancelButtonText: 'No, cancel!',
  reverseButtons: true
}).then((result) => {
  if (result.isConfirmed) {
    var data = {
      "_token": $('input[name=_token]').val(),
      "id": delete_id,
    };
    $.ajax({
      type: "DELETE",
      url: '/completed-delete/'+delete_id,
      data: data,
      success: function (response) {
        swalWithBootstrapButtons.fire(
          response.status,
    )
    .then((result) => {
      location.reload();
    });
      }
    });


  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {
    swalWithBootstrapButtons.fire(
      'Cancelled',
      'Your imaginary file is safe :)',
      'error'
    )
  }
})
   });
});
</script>

<!-- END FOR COMPLETED -->
<<<<<<< HEAD

<!-- ALERT FOR SUBMIT -->
<!-- <script>
Swal.fire({
  position: 'top-mid',
  icon: 'success',
  title: 'Your work has been saved',
  showConfirmButton: false,
  timer: 1500
});

</script> -->

@endsection
=======
@endsection
>>>>>>> 33b7eb8c8db5e89cd5c449eb468993a959b8b6da
