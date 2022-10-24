@extends('layouts.app')

@section('content')
<section>
    <div id="app">
        <header>
            <a href="#" class="logo">Add Course</a>
            <ul>
                <li><a href="{{ route('admin.users.index') }}">Home</a></li>
                <li><a href="{{ url('addstudent') }}">Add Student</a></li>
                <li><a href="{{ url('addcouncilor') }}">Add Councilor</a></li>
                <li><a href="{{ url('addcourse') }}">Add Course</a></li>
                <li><a href="{{ url('course') }}">Course</a></li>
            </ul>
        </header>
        @include('partials.alerts')
            <div class="container">
                <div class="formcard col-8">
                    <div class="card-body">
                        <form method="PUT" id="addaccount" action="{{ route('course.create')}}">
                                                @csrf
                        <div class="row g-3 align-items-center">
                            <div class="input-group mb-3">
                                <span class="input-group-text">Course Name</span>
                                <input type="text" id="course_name" name="course_name" placeholder="Course Name" class="form-control" required>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text">Department of Course</span>
                                <input type="text" id="department" name="department" placeholder="Course Department" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" form="addaccount">Submit Account</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>


        </main>
    </div>
    <script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    </script>
@endsection
