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
                        <div class="course-body float-start">
                            <button class="addcouncilorBx" type="button" data-bs-toggle="modal"
                                data-bs-target="#addcounselorModal">
                                <center>Add Counselor</center>
                            </button>
                            <button class="addStudentBx" type="button" class="btn btn-success btn-sm"
                                data-bs-toggle="modal" data-bs-target="#addstudentModal">
                                <center>Add Student</center>
                            </button>
                            <table id="datatable" class="table table-striped">
                                <thead>
                                    <div class="panel-body">
                                        <tr>
                                            <th scope="col" hidden>ID</th>
                                            <th scope="col">ID Number</th>
                                            <th scope="col">Last Name</th>
                                            <th scope="col">First Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col" hidden>Course</th>
                                            <th scope="col" hidden>Year</th>
                                            <th scope="col">Role</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </div>
                                </thead>
                                <tbody id="dynamic-row">

                                    @foreach ($users as $user)
                                        <tr>

                                            <td hidden>{{ $user->id }}</td>
                                            <td>{{ $user->idnum }}</td>
                                            <td>{{ $user->lname }}</td>
                                            <td>{{ $user->fname }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td hidden>{{ $user->course_name}}</td>
                                            <td hidden>{{ $user->year }}</td>
                                            <td>{{ $user->role->role_name }}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-sm edit ml-2"><i
                                                        class="fa fa-edit"></i>
                                                </button>
                                                <form action="/user-delete/{{$user->id}}" method="POST" class="float-left">
                                                        {{ method_field('DELETE') }}
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="fa fa-trash-o"></i></button>
                                                    </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal fade">
                </div>
                <!-- View & Edit Modal -->
                <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="viewModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="viewModalLabel">Account Information</h5>
                            </div>
                            <form action="/user" method="POST" id="editForm">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-8 col-sm-6">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">ID Number</span>
                                                <input type="text" id="idnum" name="idnum"
                                                    class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-4 col-sm-6">
                                        </div>
                                        <div class="col-12">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">First and last name</span>
                                                <input type="text" id="fname" name="fname"
                                                    aria-label="First name" class="form-control">
                                                <input type="text" id="lname" name="lname"
                                                    aria-label="Last name" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-8 col-sm-6">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">Email</span>
                                                <input type="text" id="email" name="email"
                                                    class="form-control" value="" required>
                                            </div>
                                            <div class="input-group mb-3">
                                                <label class="input-group-text"
                                                    for="year">{{ __('Year') }}</label>
                                                <select class="form-select" id="year" name="year">
                                                    <option value="-">-</option>                                                   
                                                    <option value="1st Year">1st Year</option>
                                                    <option value="2nd Year">2nd Year</option>
                                                    <option value="3rd Year">3rd Year</option>
                                                    <option value="4th Year">4th Year</option>
                                                    <option value="5th Year">5th Year</option>
                                                    <option value="Non-Student">Non-Student</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <label class="input-group-text"
                                                for="course">{{ __('Course') }}</label>
                                            <select class="form-select" id="course" name="course">
                                                @foreach ($courses as $course)
                                                    <option>{{ $course->course_name }}</option>
                                                @endforeach
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
                <!-- END OF EDIT MODAL -->

                <!-- ADD COUNSELOR MODAL -->
                <div class="modal fade" id="addcounselorModal" tabindex="-1"
                    aria-labelledby="AddcounselorModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="AddcounselorModalLabel">Add Counselor</h5>
                            </div>
                            <br><br><br><br>
                            <div class="modal-body">
                                <form method="POST" id="addaccount" action="{{ route('addcouncilor') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-4 col-sm-6">
                                        </div>
                                        <div class="row">
                                            <div class="col-8 col-sm-6">
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">First Name</span>
                                                    <input type="text" id="fname" name="fname"
                                                        placeholder="First Name" class="form-control" required>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">Middle Name</span>
                                                    <input type="text" id="fname" name="mname"
                                                        placeholder="Middle Name" class="form-control" required>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">Last Name</span>
                                                    <input type="text" id="lname" name="lname"
                                                        placeholder="Last Name" class="form-control" required>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <input type="text" id="year" name="year"
                                                        value="0" class="form-control" hidden>
                                                </div>
                                            </div>
                                            <div class="col-4 col-sm-6">
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">ID Number</span>
                                                    <input type="text" id="idnum" name="idnum"
                                                        placeholder="ID Number" class="form-control" required>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">Email</span>
                                                    <input type="text" id="email" name="email"
                                                        placeholder="Email" class="form-control" required>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">Password</span>
                                                    <input type="text" id="password" name="password"
                                                        placeholder="Passwword" class="form-control" required>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">Confirm Password</span>
                                                    <input type="text" id="password-confirm"
                                                        name="password-confirm" placeholder="Confirm Password"
                                                        class="form-control" required>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <input type="text" id="role_id" name="role_id"
                                                        value="2" class="form-control" hidden>
                                                </div>
                                                <input type="text" id="course_id" name="course_id" value="6"
                                                class="form-control" hidden>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer"><button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" form="addaccount">Submit
                                            Account</button>
                                    </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

            </form>
            <!-- END ADD COUNSELOR MODAL -->

            <!-- ADD STUDENT MODAL -->
            <div class="modal fade" id="addstudentModal" tabindex="-1" aria-labelledby="AddstudentModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="AddstudentModalLabel">Add Student</h5>
                        </div>
                        <br><br><br><br>
                        <div class="modal-body">
                            <form method="PUT" id="addstudent" action="{{ route('user.create') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-8 col-sm-6">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">First Name</span>
                                            <input type="text" id="fname" name="fname"
                                                placeholder="First Name" class="form-control" required>
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Middle Name</span>
                                            <input type="text" id="fname" name="mname"
                                                placeholder="Middle Name" class="form-control"required>
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Last Name</span>
                                            <input type="text" id="lname" name="lname"
                                                placeholder="Last Name" class="form-control"required>
                                        </div>
                                        <div class="input-group mb-3">
                                            <label class="input-group-text"
                                                for="course">{{ __('Course') }}</label>
                                            <select class="form-select" id="course" name="course_id" required>
                                                <option>Choose Course</option>
                                                @foreach ($courses as $course)
                                                    <option value="{{ $course->id }}">{{ $course->course_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="input-group mb-3">
                                            <label class="input-group-text"
                                                for="year">{{ __('Year') }}</label>
                                            <select class="form-select" id="year" name="year" required>
                                                <option value="1st Year">1st Year</option>
                                                <option value="2nd Year">2nd Year</option>
                                                <option value="3rd Year">3rd Year</option>
                                                <option value="4th Year">4th Year</option>
                                                <option value="5th Year">5th Year</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4 col-sm-6">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">ID Number</span>
                                            <input type="text" id="idnum" name="idnum"
                                                placeholder="ID Number" class="form-control" required>
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Email</span>
                                            <input type="text" id="email" name="email" placeholder="Email"
                                                class="form-control" required>
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Password</span>
                                            <input type="text" id="password" name="password"
                                                placeholder="Passwword" class="form-control" required>
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Confirm Password</span>
                                            <input type="text" id="password-confirm" name="password-confirm"
                                                placeholder="Confirm Password" class="form-control" required>
                                        </div>
                                        <div class="input-group mb-3">
                                            <input type="text" id="role_id" name="role_id" value="3"
                                                class="form-control" hidden>
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" form="addstudent">Submit
                                        Account</button>

                                </div>
                            </form>
                        </div>
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

                $('#idnum').val(data[1]);
                $('#fname').val(data[3]);
                $('#lname').val(data[2]);
                $('#email').val(data[4]);
                $('#year').val(data[6]);
                $('#course').val(data[5]);
                $('#editForm').attr('action', '/user/' + data[0]);
                $('#editModal').modal('show');

            });
        });
    </script>
</body>

</html>
