@extends('layouts.app')
@section('content')
<link href="{{ asset('css/wellness.css') }}" rel="stylesheet">
<section>
     <header>
	 <div class="logo"><img src="{{ asset('img/logo.gif') }}"></div>
         <ul>
             <li><a href="{{ url('home') }}">Home</a></li>
             <li><a href="{{ url('exams_history') }}">Exam History</a></li>
             <li><a href="{{ url('appointment_history') }}">Appointments</a></li>
         </ul>
     </header>
     <div class="content">
                    <div class="container-fluid">
                     <div class="wellnesscard"> 
                     <title>Home</title>
</head>
<div class="wellnessbody">
	<div class="wellness">
<center><h2>Wellness Guide</h2></center>
</div>
<div class="ui-card">
<img src="{{ asset('img/people.jpg') }}">
	<div class="description">
		
		<p>Talking about your feelings isn’t a sign of weakness. It’s part of taking charge of your well-being and doing what you can to stay healthy.</p>
		<!-- <a href="#">Read More</a> -->
	</div>
</div>
<div class="ui-card">
<img src="{{ asset('img/exercise.jpg') }}">
	<div class="description">
		<p>Exercise also keeps the brain and your other vital organs healthy.</p>
	</div>
</div>
<div class="ui-card">
<img src="{{ asset('img/eating.jpg') }}">
	<div class="description">
		
		<p>Your brain needs a mix of nutrients to stay healthy and function well, just like the other organs in your body.</p>
	</div>
</div>
<div class="ui-card">
<img src="{{ asset('img/family.jpg') }}">
	<div class="description">
		<p>Strong family ties and supportive friends can help you deal with the stresses of life.</p>
	</div>
</div>
<div class="ui-card">
<img src="{{ asset('img/asking-help.jpg') }}">
	<div class="description">
		<p>If things are getting too much for you and you feel you can’t cope, ask for help.</p>
	</div>
</div>
<div class="ui-card">
<img src="{{ asset('img/change-pace.jpg') }}">
	<div class="description">
		<p>A change of scene or a change of pace is good for your mental health.</p>
	</div>
</div>
<div class="ui-card">
<img src="{{ asset('img/trophy.jpg') }}">
	<div class="description">
		<p>Doing an activity you enjoy probably means you’re good at it and achieving something boosts your self-esteem.</p>
	</div>
</div>
<div class="ui-card">
<img src="{{ asset('img/sleeping.jpg') }}">
	<div class="description">
		<p>Relaxing is one of those things that's easy to say and harder to do. Unwinding and staying calm can take practice.</p>
	</div>
</div>

@endsection


                                    
            