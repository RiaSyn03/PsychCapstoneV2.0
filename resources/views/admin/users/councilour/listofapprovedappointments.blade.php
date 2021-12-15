@extends('layouts.app')

@section('content')
<title>List of Time</title>
<table class="table table-striped">
<thead>
<tr>
<td>ID Number</td>
<td>Student Name</td>
<td>Time</td>
<td>Date</td>
<td>Councilour Name</td>



</tr>
</thead>
<tbody id="dynamic-row">
@if (is_array( $appointments))
@foreach( $appointments as $appoint)
<tr>
<td>{{ $appoint->user_idnum }}</td>
<td>{{ $appoint->user_name }}</td>
<td>{{ $appoint->timeslot_time }}</td>
<td>{{ $appoint->timeslot_date}}</td>
<td>{{ $appoint->councilour_name}}</td>



</tr>
@endforeach
@endif
</tbody>
</table>
@endsection



