<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @media only screen and (max-width: 620px) {

            /* For mobile phones: */
            .menu,
            .main,
            .right {
                width: 100%;
            }
        }
    </style>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PsychCare2.0</title>



    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />

    <!-- Styles -->
    <link href="{{ asset('css/appedited.css') }}" rel="stylesheet">
    <link href="{{ asset('css/mystyle.css') }}" rel="stylesheet">


    <link rel="stylesheet" href="https://necolas.github.io/normalize.css/7.0.0/normalize.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div id="app">
        <section>
            <header>
                <div class="logo"><img src="{{ asset('img/logo.gif') }}"></div>
                <ul>
                    <li>
                        <div class="dropdown">
                            <a class="dropdown-toggle " id="dropdownMenuButton" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->fname }} <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu " aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    >
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </li>
                    <li><a href="{{ url('course') }}">Manage Course</a></li>
                    <li><a href="{{ url('manageappointments') }}">Manage Appointments</a></li>
                    <li><a href="{{ url('questions') }}">Manage Questions</a></li>
                    <li><a href="{{ url('user') }}" class="active">Manage Account</a></li>
                    <li><a href="{{ route('home') }} ">Dashboard</a></li>
                </ul>
            </header>
            @include('partials.alerts')
            <br><br><br><br><br><br><br><br><br>
            <div class="container">
                <div class="row justify-content-center">
                    <!-- View & Edit Modal -->
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="viewModalLabel">Account Information</h5>
                            </div>
                            @if($errors->any())
                                {{ implode('', $errors->all('<div>:message</div>')) }}
                            @endif
                            <form action="/user-update/{{$user->id}}" method="POST">
                                {{ method_field('PUT') }}
                                @csrf
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-8 col-sm-6">
                                            {{-- <input type="hidden" id="id" name="id" value="0"> --}}
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">ID Number</span>
                                                <input type="text" id="idnum" name="idnum"
                                                    class="form-control" value="{{$user->idnum}}" required>
                                            </div>
                                        </div>
                                        <div class="col-4 col-sm-6">
                                        </div>
                                        <div class="col-12">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">First and last name</span>
                                                <input type="text" id="fname" value="{{$user->fname}}" name="fname"
                                                    aria-label="First name" class="form-control">
                                                <input type="text" id="lname" value="{{$user->lname}}" name="lname"
                                                    aria-label="Last name" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-8 col-sm-6">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">Email</span>
                                                <input type="text" id="email" value="{{$user->email}}" name="email"
                                                    class="form-control" value="" required>
                                            </div>
                                            <div class="input-group mb-3">
                                                <label class="input-group-text"
                                                    for="year">{{ __('Year') }}</label>
                                                <select class="form-select" id="year" name="year">
                                                    <option value="-" {{$user->year == '-' ? 'selected': ''}}>-</option>
                                                    <option value="1st Year"{{$user->year == '1st Year' ? 'selected': ''}}>1st Year</option>
                                                    <option value="2nd Year"{{$user->year == '2nd Year' ? 'selected': ''}}>2nd Year</option>
                                                    <option value="3rd Year"{{$user->year == '3rd Year' ? 'selected': ''}}>3rd Year</option>
                                                    <option value="4th Year"{{$user->year == '4th Year' ? 'selected': ''}}>4th Year</option>
                                                    <option value="5th Year"{{$user->year == '5th Year' ? 'selected': ''}}>5th Year</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="input-group mb-3">
                                                <label class="input-group-text"
                                                    for="course">{{ __('Course') }}</label>
                                                <select class="form-select" id="course_id" name="course_id">
                                                    @foreach ($courses as $course)
                                                        <option value="{{$course->id}}" {{$user->course_id == $course->id ? 'selected': ''}}>{{ $course->course_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a href="{{ url('user') }}" class="btn btn-secondary">Cancel</a>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- END OF EDIT MODAL -->
                    </div>
                </div>



        </section>
    </div>


    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

</body>

</html>
