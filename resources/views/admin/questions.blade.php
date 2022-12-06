@extends('layouts.app')
@section('content')
<title>List of Questions</title>
</head>
<body>
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
                <li><a href="{{ url('course') }}">Manage Course</a></li>
                <li><a href="{{ url('manageappointments') }}">Manage Appointments</a></li>
                <li><a href="{{ url('questions') }}" class="active">Manage Questions</a></li>
                <li><a href="{{ url('user') }}" >Manage Account</a></li>
                <li><a href="{{ route('home') }} "  >Dashboard</a></li>
                    </ul>
     </header>
     @include('partials.alerts')     
                <div class="card-body"> 
                <br><br><br><br>
                <div class="tabbed">
    <input type="radio" name="tabs" id="tab-nav-1" checked>
    <label for="tab-nav-1"> Stress Scale</label>
    <input type="radio" name="tabs" id="tab-nav-2">
    <label for="tab-nav-2">Personality</label>
    <input type="radio" name="tabs" id="tab-nav-3">
    <label for="tab-nav-3">Learners</label>
    <div class="tabs">
      <div>
      <table class="table table-striped" id="questiondatatable">
<thead>
<tr>
   <th colspan="4"><center><h2>STRESS</h2></center></th>
</tr>
<tr>
<!-- <td>Question ID</td> -->
<td>Question No.</td>
<td>Question</td>
<td>Type of Question</td>
<td>Edit</td>
</tr>
</thead>
@foreach ($stressquestions as $stress)
<form method="post" action="questions" >
@csrf
<tr>
<!-- <td>{{ $stress->id }}</td> -->
<input type="hidden" class="btn_val_id" value="{{ $stress->id }}">
<td><center><p>{{ $stress->question_num }}<p></center></td>
<td><center><p>{{ $stress->question}}<p></center></td>
<td><center><p>{{ $stress->question_type }}<p></center></td>
<td>
</form>
<a href="/updatequestion/{{$stress->id}}"  class="btn btn-success btn-sm "><i class="fa fa-edit"></i></a>     
  </td>
</tr>
@endforeach
</table>
</div>
      <div>
      <table class="table table-striped">
<thead>
<tr>
   <th colspan="4"><center><h2>PERSONALITY</h2></center></th>
</tr>
<td>Question No.</td>
<td>Question</td>
<td>Type of Question</td>
<td>Edit</td>
</tr>
</thead>
@foreach ($personalityquestions as $personality)
@csrf
<form method="post" action="questions" >
<tr>
<input type="hidden" class="btn_val_id" value="{{ $personality->id }}">
<td><center><p>{{ $personality->question_num }}</p></center></td>
<td><center><p>{{ $personality->question}}</p></center></td>
<td><center><p>{{ $personality->question_type }}</p></center></td>
<td>
</form>
<a href="/updatequestion/{{$personality->id}}" class="btn btn-success btn-sm "><i class="fa fa-edit"></i></a>  
  </td>
</tr>
@endforeach
</table>
</div>
      <div>
      <table class="table table-striped">
<thead>
<tr>
   <th colspan="4"><center><h2>LEARNERS</h2></center></th>
</tr>
<tr>
<td>Question No.</td>
<td>Question</td>
<td>Type of Question</td>
<td>Edit</td>
</tr>
</thead>
@foreach ($learnersquestions as $learner)
@csrf
<form method="post" action="questions" >
<tr>
<input type="hidden" class="btn_val_id" value="{{ $learner->id }}">
<td><center><p>{{ $learner->question_num }}</p></center></td>
<td><center><p>{{ $learner->question}}</p></center></td>
<td><center><p>{{ $learner->question_type }}</p></center></td>
<td>
</form>
<a href="/updatequestion/{{$learner->id}}" class="btn btn-success btn-sm "><i class="fa fa-edit"></i></a>     
  </td>
</tr>
@endforeach
</table>
  </div>
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#questiondatatable').DataTable();

            table.on('click','.edit', function() {

                $tr = $(this).closest('tr');
                if ($($tr).hasClass('child')) {
                    $tr = $tr.prev('.parent');
                }

                var data = table.row($tr).data();
                console.log(data);

                $('#question_num').val(data[1]);
                $('#question').val(data[2]);
                $('#editquestionForm').attr('action', '/viewquestion/'+data[0]);
                $('#editModal').modal('show');
            });
        });
    </script>


@endsection
