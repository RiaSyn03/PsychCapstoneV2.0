@extends('layouts.app')
@section('content')
@hasrole('admin')
        <div id="app">
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
                <li><a href="{{ url('questions') }}" >Manage Questions</a></li>
                <li><a href="{{ url('user') }}" >Manage Account</a></li>
                <li><a href="{{ route('home') }} " class="active" >Dashboard</a></li>
                    </ul>
        </header>
            @include('partials.alerts')
            <br><br><br><br><br><br>
            <div class="container text-center">
                <div class="row justify-content-center mt-5 pt-5">
                    <div class="col-4">
                        <div class="card border-success bg-success text-center mb-3" style="max-width: 25rem;">
                            <div class="card-header text-success">
                                <h3>Accounts</h3>
                            </div>
                            <div class="card-body text-white">
                              <h1>{{$nousers}}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card border-success bg-success text-center mb-3" style="max-width: 25rem;">
                            <div class="card-header text-success">
                                <h3>Courses</h3>
                            </div>
                            <div class="card-body text-white">
                              <h1>{{$numcourses}}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card border-success bg-success text-center mb-3" style="max-width: 25rem;">
                            <div class="card-header text-success">
                                <h3>Appointments</h3>
                            </div>
                            <div class="card-body text-white">
                              <h1>{{$totalappointments}}</h5>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
</section>
        @endhasrole

                @hasrole('student')
<head>
                <link href="{{ asset('css/studenthomepage.css') }}" rel="stylesheet">
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css">
</head>
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
                <li><a href="{{ url('appointment_history') }}" >Appointments</a></li>
                <li><a href="{{ url('exams_history') }}" >Exam History</a></li>
             <li><a href="{{ url('home') }}" class="active">Home</a></li>
         </ul>
     </header>
     @include('partials.alerts')
     <div class="student-align">
     <div class="studentcontainer">
        <div class="menu">
    <h2>Menu</h2>
</div>
            <div class="swiper mySwiper">
            <div class="swiper-wrapper">
              <div class="swiper-slide"><img src="{{ asset('img/wellness.jpeg') }}">
          <center>
            <p>Wellness</p><br>
            <h5><a href="wellness">  <button class="takebtn" >View Guidelines</button></a></h5></center>
            </div>
              <div class="swiper-slide"><img src="{{ asset('img/stressscale.jpg') }}">
              <center>
              <p>Stress Scale</p>
              <h5><a href="stress_exam">  <button class="takebtn" >Take Exam</button></a></h5></center>
            </div>
              <div class="swiper-slide"><img src="{{ asset('img/personality.jpg') }}">
              <center>
              <p>Personality</p>
              <h5><a href="personality_exam">  <button class="takebtn" >Take Exam</button></a></h5></center>
              </div>
              <div class="swiper-slide"><img src="{{ asset('img/learner.jpg') }}">
              <center>
              <p>Learner</p><br>
              <h5><a href="learner_exam">  <button class="takebtn">Take Exam</button></a></h5></center>
            </div>
            </div>
            <div class="homeswiper-pagination"></div>
          </div>
          <div class="aboutus">
          <h1>About Us</h1>

        </div>
        <div class="description">
          <h4>PsychCare2.0</h4> <p>is about checking your mental health. Mental health includes our emotional, psychological, and social well-being. It affects how we think, feel, and act. It also helps determine how we handle stress, relate to others, and make healthy choices. Mental health is important at every stage of life, from childhood and adolescence through adulthood. Issues that are related to mental health needs attention and guidance as soon as possible.
                     Through this system, you can seek guidance on our reliable counselors here in the University.<br><a href="{{ url('appointment_history') }}"><button type="button" class="takebtn" >Appoint Now </button></a></p>
          </div>
          <div class="description2">
          <h4>Stress Scale</h4> <p>is to check your stress level from none to severe. Taking this test at least twice a week is good to avoid mental disorder. Stress can also affect your personality and learning, taking stress scale first is recommended before taking others. </p>
</div>
<div class="description3">
          <h4>Learner</h4> <p>is to check what type of learners you are. Awareness of our learning styles play an important role towards academic succes. We learn at work, school, books and other things we have interests with everyday. So taking the test often will be a good help to you.  </p>
</div>
<div class="description4">
          <h4>Personality</h4> <p>is to check what behavior you have. Are you comfortable being alone or are you more comfortable being surrounded by a lot of people instead ? You can find out what type of person you are on this test. </p>
</div>

</div>
          <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
          <script src="js/carousel.js"></script>
    </section>

                @endhasrole
                @hasrole('counselor')
                <link href="{{ asset('css/category.css') }}" rel="stylesheet">
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
                <li><a href="{{ url('viewtime') }}">Appointments</a></li>
                <li><a href="{{ url('viewquestions') }}">Questions</a></li>
             <li><a href="{{ url('home') }}" class="active">Home</a></li>
         </ul>
     </header>
     <div class="category">
     <div class="categorybody"><br><br><br><br>
     <div class="container text-center">
                <div class="row justify-content-center mt-5 pt-5">
                    <div class="col-4">
                        <div class="card border-info bg-info text-center mb-3" style="max-width: 25rem;">
                            <div class="card-header text-success">
                                <h3>Total Appointments</h3>
                            </div>
                            <div class="card-body text-white">
                            <h2>{{$totalappointments}}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card border-info bg-info text-center mb-3" style="max-width: 25rem;">
                            <div class="card-header text-success">
                                <h3>Pending</h3>
                            </div>
                            <div class="card-body text-white">
                              <h2>{{$pending}}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card border-info bg-info text-center mb-3" style="max-width: 25rem;">
                            <div class="card-header text-success">
                                <h3>Accepted</h3>
                            </div>
                            <div class="card-body text-white">
                              <h2>{{$accepted}}</h2>
                            </div>
                        </div>
                    </div>

                </div>
            </div><br><br><br><br><br><br><br><br>

    <center><h1>Results Score</h1></center>
    <div class="category-align">
<div class="categorycontainer">

        <div class="categorycard2">
        <div class="categoryimgBx2">
            <img src="{{ asset('img/stressscale.jpg') }}">
        </div>
        <div class="categorycontent2">
            <h2>STRESS SCALE</h2>
            <p><b>None</b> - 0-4
        <br><b>Mild</b> - 5-9
        <br> <b>Moderate</b> - 10-15
        <br><b>Moderately Severe</b> - 16-19
        <br><b>Severe</b> - 20-30</p>

        </div>
        </div>
        <div class="categorycard2">
        <div class="categoryimgBx2">
            <img src="{{ asset('img/personality.jpg') }}">
        </div>
        <div class="categorycontent2">
            <h2>PERSONALITY</h2>
            <p><b>Introvert</b> - 0-10
            <br><b>Ambivert</b> - 11-20
            <br><b>Extrovert</b> - 21-40</p>
            <br><br><br><br>
        </div>
        </div>
        <div class="categorycard2">
        <div class="categoryimgBx2">
            <img src="{{ asset('img/learner.jpg') }}">
        </div>
        <div class="categorycontent2">
            <h2>LEARNER</h2>
            <p><b>Linguistc</b> - 0-12
            <br><b>Kinesthetic</b> - 13-25
            <br><b>Visual</b> - 26-50</p>
            <br><br><br><br>
        </div>
        </div>
    </div>
</div>
</div>
<br><br><br><br><br><br><br>
                @endhasrole
@endsection
<script src="../assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="../assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="../assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="../assets/js/plugins/bootstrap-switch.js"></script>
<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!--  Chartist Plugin  -->
<script src="../assets/js/plugins/chartist.min.js"></script>
<!--  Notifications Plugin    -->
<script src="../assets/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
<script src="../assets/js/light-bootstrap-dashboard.js?v=2.0.0 " type="text/javascript"></script>
<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
<script src="../assets/js/demo.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        // Javascript method's body can be found in assets/js/demos.js
        demo.initDashboardPageCharts();

        demo.showNotification();

    });
</script>
