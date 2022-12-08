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

            <div id="app">
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
                        <li><a href="{{ url('department') }}">Manage Department</a></li>
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
                        <div class="formcard">
                            <div class="course-body">
                                <button class="addcourseBx " type="button" data-bs-toggle="modal"
                                    data-bs-target="#addcourseModal">
                                    Add Course
                                </button>
                                <button class="adddepartmentBx " type="button" data-bs-toggle="modal"
                                    data-bs-target="#adddepartmentModal">
                                    Add Department
                                </button>
                                <table id="datatable" class="table table-striped">
                                    <thead>
                                        <div class="panel-body">
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Department</th>
                                                <th scope="col">Actions</th>
                                            </tr>
                                        </div>
                                    </thead>
                                    <tbody id="dynamic-row">
                                        @foreach ($departments as $department)
                                            <tr>
                                                <td>{{ $department->id }}</td>
                                                <td>{{ $department->dept_name }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-primary btn-sm edit ml-2"><i
                                                        class="fa fa-edit"></i>
                                                    </button>
                                                    <button action="/department-show/{{ $department->id }}"
                                                        type="button" data-id="{{$department->id}}" class="btn btn-info btn-sm ml-1 editDepartment">
                                                        <i class="fa fa-solid fa-eye"></i>
                                                    </button>
                                                    <form action="{{ route('department.destroy', $department->id) }}"
                                                        method="POST" class="float-left">
                                                        {{ method_field('DELETE') }}
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Are you sure you want to delete {{ $department->dept_name }}?')"><i
                                                                class="fa fa-trash-o"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ADD DEPARTMENT MODAL -->
            <div class="modal fade" id="adddepartmentModal" tabindex="-1" aria-labelledby="DepartmentModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="DepartmentModalLabel">Add Department</h5>
                        </div>
                        <div class="modal-body">
                            <form method="POST" id="adddept" action="{{ route('add-department') }}">
                                @csrf
                                <div class="g-3 align-items-center">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Department Name</span>
                                        <input type="text" id="dept_name" name="dept_name"
                                            placeholder="Department Name" class="form-control" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" form="adddept">Submit
                                        Department</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END DEPARTMENT MODAL -->

            <!-- Edit DEPARTMENT MODAL -->
            <div class="modal fade" id="editDepartmentModal" tabindex="-1" aria-labelledby="EditDepartmentModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="EditDepartmentModalLabel">Edit Department</h5>
                        </div>
                        <div class="modal-body">
                            <form method="POST" id="editForm" action="/department">
                                @csrf
                                <div class="g-3 align-items-center">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Department Name</span>
                                        <input type="text" id="id" name="id" value="{{$department->id}}" hidden>
                                        <input type="text" id="dept_name" name="dept_name"
                                            value="{{$department->dept_name}}" class="form-control" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" id="saveBtn" form="editDept">Submit
                                        Department</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END DEPARTMENT MODAL -->



            <!-- ADD COURSE MODAL -->
            <div class="modal fade" id="addcourseModal" tabindex="-1" aria-labelledby="AddcourseModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="AddcourseModalLabel">Add Course</h5>
                        </div>
                        <div class="modal-body">
                            <form method="PUT" id="addaccount" action="{{ route('course.create') }}">
                                @csrf
                                <div class="g-3 align-items-center">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Course Name</span>
                                        <input type="text" id="course_name" name="course_name"
                                            placeholder="Course Name" class="form-control" required>
                                    </div>
                                    <div class="input-group mb-3">
                                        <label class="input-group-text" for="dept_id">Department</label>
                                        <select class="form-select" id="dept_id" name="dept_id">
                                            <option>Choose Department</option>
                                            @foreach ($departments as $dept)
                                                <option value="{{ $dept->id }}">{{ $dept->dept_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" form="addaccount">Submit
                                        Course</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END COURSE MODAL -->


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

                $('#id').val(data[0]);
                $('#dept_name').val(data[1]);
                $('#editForm').attr('action', '/department-update/' + data[0]);
                $('#editDepartmentModal').modal('show');

            });
        });
    </script>
</body>

</html>
