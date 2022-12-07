@extends('layouts.app')
@section('content')
<link href="{{ asset('css/questions.css') }}" rel="stylesheet">
<body style="background-color: #f695d1">
     <header>
     <div class="logo"><img src="{{ asset('img/logo.gif') }}"></div>
         <ul>
         <li><a href="{{ url('home') }}">Go to Homepage</a></li>
         <li><a href="{{ url('learner_exam') }}" class="active">Learner</a></li>
         <li><a href="{{ url('personality_exam') }}" >Personality</a></li>
             <li><a href="{{ url('stress_exam') }}" >Stress Scale</a></li>
         </ul>
     </header>
     @include('partials.alerts')
     <button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
     <form method="POST" action="learner_exam" name="learnerquestion" id="learnerquestion">
     @csrf
@foreach ($learner as $question)
<div class="wrapper">
  <div class="learnertitle" id="{{$question->question_num}}">{{ $question->question_num }}. {{ $question->question}}</div>
  <div class="box">
      <input type="radio" name="question{{ $question->question_num }}" id="radio1{{ $question->question_num }}" value="1">
      <label for="radio1{{ $question->question_num }}">
      Never applies to me
      </label>
      <input type="radio" name="question{{ $question->question_num }}" id="radio2{{ $question->question_num }}" value="2" >
      <label for="radio2{{ $question->question_num }}">
      Sometimes applies to me
      </label>
      <input type="radio" name="question{{ $question->question_num }}" id="radio3{{ $question->question_num }}" value="3" >
      <label for="radio3{{ $question->question_num }}">
      Often applies to me
      </label>
    </div>
    </div>
    <div class="container-top">
      <a href="#" class="top"></a>
    </div>
    <br><br><br>
@endforeach
<!-- <p>Total: £ <span id="total">0</span></p> -->
<input type="hidden" id="result_name" name="result_name" value=""/>
<br><br><br>    <br><br><br>
<center>
<br><br>
<button class="resultbtn" type="button" onclick="calculate()">Get Result</button>

</center>

<!--
<p>The Result is : <br>
	<span id = "result"></span>
</p> -->
<div id="not-stressmodal">
            <div class="not-stresscard" id="not-stresscard">
                <div class="linguistic-face"></div>
                <div class="back-face"><br><br><br><br><br><br><br>
                <a href="{{ url('category') }}"><button type="submit" class="back-categorybtn">Go to Categories</button></a>
                <br><br><br>
                    <button type="submit" class="back-facebtn">Done !</button>
                </div>
            </div>
        </div>
<div id="stressmodal">
            <div class="stresscard" id="stresscard">
                <div class="kinesthetic-face"></div>
                <div class="back-face"><br><br><br><br><br><br><br><br><br>
                <a href="{{ url('category') }}"><button type="button" class="back-categorybtn">Go to Categories</button></a>
                    <br><br><br>
                    <button type="submit" class="back-facebtn">Done !</button>
                </div>
            </div>
        </div>
        <div id="super-stressmodal">
            <div class="super-stresscard" id="super-stresscard">
                <div class="visual-face"></div>
                <div class="back-face"><br><br><br><br><br><br><br><br><br>
                <a href="{{ url('category') }}"><button type="button" class="back-categorybtn">Go to Categories</button></a>
                    <br><br><br>
                    <button type="submit" class="back-facebtn">Done !</button>
                </div>
            </div>
        </div>
        </form>
  <input type="hidden" value="{{$questioncount}}" id="noquestions" name="noquestions"/><br>
</body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script>function calculate(){
    var valid = false ;
      let questions = ['question1', 'question2', 'question3', 'question4', 'question5', 'question6', 'question7', 'question8', 'question9', 'question10', 'question11', 'question12', 'question13', 'question14', 'question15', 'question16', 'question17', 'question18',, 'question19', 'question20', 'question21', 'question22', 'question23', 'question24', 'question25'];
      var answeredQuestions = [];
      questions.forEach( question => {
        if (document.querySelector("input[name="+question+"]:checked")) {
          var questionAnswer = document.querySelector("input[name="+question+"]:checked").value;
          answeredQuestions.push(questionAnswer);
        }
      });
      if (answeredQuestions.length < 25) {
        alert ("Please answer all the questions");
        return false;
      } else {
        console.log("All questions has been answered!");
        valid = true;
      }
      if(valid){

        $(":radio")
          var total = 0;
          let noquestions = document.getElementById('noquestions').value;
          var maxscore = 3*noquestions;
          console.log(maxscore);

          $(":radio:checked").each(function(){
              total += Number(this.value);
              console.log(total);

          });
          $("#total").text(total);


    var linguistic = maxscore*0.25;
    var kinesthetic = maxscore*0.50;
    var visual = maxscore*0.75;
    $("#result").text(maxscore);

    if(total <= linguistic )
    {
      // var blur = document.getElementById('blur');
      // blur.classList.toggle('active');
      var notstressmodal = document.getElementById('not-stressmodal');
      notstressmodal.classList.toggle('active');
      $("#result_name").val("You are a linguistic learner");
    }
    else if (total <= visual)
    {
      // var blur = document.getElementById('blur');
      // blur.classList.toggle('active');
      var stressmodal = document.getElementById('stressmodal');
      stressmodal.classList.toggle('active');
      $("#result_name").val("You are a kinesthetic learner");
    }
    else if (total > visual)
    {
      // var blur = document.getElementById('blur');
      // blur.classList.toggle('active');
      var superstressmodal = document.getElementById('super-stressmodal');
      superstressmodal.classList.toggle('active');

      $("#result_name").val("You are a visual learner");
    }
  else {
    alert ("Please answer all the questions");
    return false;
  }
};
};

  </script>
  <script>
//Get the button
var mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
</script>

@endsection
