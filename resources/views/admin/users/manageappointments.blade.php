@extends('layouts.app')

@section('content')
<link href="{{ asset('css/calendar.css') }}" rel="stylesheet">
<section>
     <header>
     <div class="logo"><img src="{{ asset('img/logo.gif') }}"></div>
     <ul>
                    <li>
                        <div class="dropdown">
                            <a class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->fname }} <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </li>
                    <li><a href="{{ url('course') }}">Manage Course</a></li>
                    <li><a href="{{ url('manageappointments') }}" class="active">Manage Appointments</a></li>
                    <li><a href="{{ url('questions') }}">Manage Questions</a></li>
                    <li><a href="{{ url('user') }}">Manage Account</a></li>
                    <li><a href="{{ route('home') }} ">Dashboard</a></li>
                </ul>
     </header>
     @include('partials.alerts')
<br><br><br><br><br><br><br><br>
<div class="container">
                    <div class="row justify-content-center">
                        <div class="formcard">
                            <div class="course-body">
      <table class="table table-striped" id="datatable">
   <thead>
   <div class="panel-body">
   <tr>
   <th colspan="6"><center><h2>List of Appointments</h2></center></th>
</tr>
   <tr>
<td hidden><center>ID</center></td>
<td><center>Date </center></td>
<td><center>Time </center></td>
<td><center>Status </center></td>
<td><center>Counselor Name</center></td>
<td><center>Action </center></td>
</tr>
  </thead>
  <tbody id="dynamic-row">

  @foreach($alltime as $history)
<tr>
  @csrf
  <td hidden>{{ $history->id }}</td>
<td>{{ date('d F, Y', strtotime($history->date)) }}</td>
<td>{{ $history->time }}</td>
<td>{{ $history->status }}</td>
<td>{{ $history->counselor_name }}</td>
@if ($history->status == "Re-Schedule"||$history->status =="Accepted"){
<td><center><button type="button" class="btn btn-primary edit">Change Counselor</button></center></td>
}
@else{
    <td></td>
}
@endif

</tr>
<div class="modal fade">
</div>
 <!-- View & Edit Modal -->
 <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="viewModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="viewModalLabel">Change Counselor</h5>
                            </div>
                            <form action="/manageappointments-update" method="POST" id="editForm">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-8 col-sm-6">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">Counselor Name</span>
                                                <input type="text" id="counselor_name" name="counselor_name"
                                                    class="form-control" placeholder="Input Counselor Name" required>
                                            </div>
                                        </div>
                                            <div class="input-group mb-3">
                                                <label class="input-group-text"
                                                    for="status">{{ __('Status') }}</label>
                                                <select class="form-select" id="status" name="status">
                                                    <option value="Pending">Pending</option>
                                                    <option value="Re-Schedule">Re-Schedule</option>
                                                    <option value="Accepted">Accepted</option>
                                                    <option value="Done">Done</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade">
                </div>
                </form>
@endforeach
</table>
</div>
  </div>
</div>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript">
        $(document).ready(function() {
            var table = $('#datatable').DataTable();

            table.on('click', '.edit', function() {

                $tr = $(this).closest('tr');
                if ($($tr).hasClass('child')) {
                    $tr = $tr.prev('.parent');
                }

                var data = table.row($tr).data();
                console.log(table.row($tr));
                console.log(data);

                $('#counselor_name').val(data[4]);
                $('#status').val(data[3]);
                $('#editForm').attr('action', '/manageappointments-update/' + data[0]);
                $('#editModal').modal('show');

            });
        });
    </script>

@endsection
