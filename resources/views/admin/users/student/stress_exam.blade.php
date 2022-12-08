@extends('layouts.app')
@section('content')
  <link href="{{ asset('css/questions.css') }}" rel="stylesheet">
  <link href="{{ asset('css/piechart.css') }}" rel="stylesheet">
  <body style="background-color: #59b7d1">
      <header>
      <div class="logo"><img src="{{ asset('img/logo.gif') }}"></div>
          <ul>
              <li><a href="{{ url('home') }}">Go to Homepage</a></li>
              <li><a href="{{ url('learner_exam') }}">Learner</a></li>
              <li><a href="{{ url('personality_exam') }}" >Personality</a></li>
              <li><a href="{{ url('stress_exam') }}" class="active">Stress Scale</a></li>
          </ul>
      </header>
        @include('partials.alerts')
      <button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
  <form method="POST" action="stress_exam" name="stressquestion" id="stressquestion">
  @csrf
  {{-- QUESTION LOOP --}}
  @foreach ($stress as $question)
    <div class="wrapper">
      {{-- QUESTION TITLE --}}
      <div class="stresstitle" id="{{$question->question_num}}">{{ $question->question_num }}. {{ $question->question}}</div>
      {{-- QUESTION CHOICES --}}
      <div class="box">
        <input type="radio" name="question{{ $question->question_num }}" id="radio1{{ $question->question_num }}" value="0">
        <label for="radio1{{ $question->question_num }}"> Not at all </label>

        <input type="radio" name="question{{ $question->question_num }}" id="radio2{{ $question->question_num }}" value="1">
        <label for="radio2{{ $question->question_num }}"> Several days </label>

        <input type="radio" name="question{{ $question->question_num }}" id="radio3{{ $question->question_num }}" value="2">
        <label for="radio3{{ $question->question_num }}"> More than half the days </label>

        <input type="radio" name="question{{ $question->question_num }}" id="radio4{{ $question->question_num }}" value="3">
        <label for="radio4{{ $question->question_num }}"> Nearly everyday </label>
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
  <button type="button" class="resultbtn" onclick="calculate()">Get Result</button>
  </center>

  <!--
  <p>The Result is : <br>
    <span id = "result"></span>
  </p> -->
  <div id="not-stressmodal">
    <div class="not-stresscard" id="not-stresscard">
      <div class="not-stress-face"></div>
      <div class="back-face">
        <div class="chartCard">
          <div class="chartBox">
          <canvas id="myChart"></canvas>
          </div>
        </div>
        <br><br><br>
        <button type="submit" class="back-facebtn">Done !</button>
        <br><br><br>
        <a href="#" onclick="calculate()">close</a>

      </div>
    </div>
  </div>
  <div id="stressmodal">
              <div class="stresscard" id="stresscard">
                  <div class="stress-face"></div>
                  <div class="back-face">
                  <div class="chartCard">
        <div class="chartBox">
          <canvas id="myChart2"></canvas>
        </div>
      </div>
                      <br><br><br>
                      <button type="submit" class="back-facebtn">Done !</button>
                      <br><br><br>
                      <a href="#" onclick="calculate()">close</a>

                  </div>
              </div>
          </div>
          <div id="super-stressmodal">
              <div class="super-stresscard" id="super-stresscard">
                  <div class="super-stress-face"></div>
                  <div class="back-face">
                  <div class="chartCard">
        <div class="chartBox">
          <canvas id="myChart3"></canvas>
        </div>
      </div>
                      <br><br><br>
                      <button type="submit" class="back-facebtn">Done !</button>
                      <br><br><br>
                      <a href="#" onclick="calculate()">close</a>

                  </div>
              </div>
          </div>
          <div id="moderately-severe-stressmodal">
              <div class="moderately-severe-stresscard" id="moderately-severe-stresscard">
                  <div class="moderately-severe-face"></div>
                  <div class="back-face">
                  <div class="chartCard">
        <div class="chartBox">
          <canvas id="myChart4"></canvas>
        </div>
      </div>
                      <br><br><br>
                      <button type="submit" class="back-facebtn">Done !</button>
                      <br><br><br>
                      <a href="#" onclick="calculate()">close</a>

                  </div>
              </div>
          </div>
          <div id="severe-stressmodal">
              <div class="severe-stresscard" id="severe-stresscard">
                  <div class="severe-face"></div>
                  <div class="back-face">
                  <div class="chartCard">
        <div class="chartBox">
          <canvas id="myChart5"></canvas>
        </div>
      </div>
                      <br><br><br>
                      <button type="submit" class="back-facebtn">Done !</button>
                      <br><br><br>
                      <a href="#" onclick="calculate()">close</a>

                  </div>
              </div>
          </div>
          </form>
    <input type="hidden" value="{{$questioncount}}" id="noquestions" name="noquestions"/><br>
  </body>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="js/piechart.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script>
    function calculate(){

      var valid = false ;
      let questions = ['question1', 'question2', 'question3', 'question4', 'question5', 'question6', 'question7', 'question8', 'question9'];
      var answeredQuestions = [];
      questions.forEach( question => {
        if (document.querySelector("input[name="+question+"]:checked")) {
          var questionAnswer = document.querySelector("input[name="+question+"]:checked").value;
          answeredQuestions.push(questionAnswer);
        }
      });
      if (answeredQuestions.length < 9) {
        alert ("Please answer all the questions");
        return false;
      } else {
        console.log("All questions has been answered!");
        valid = true;
      }

      var x = document.stressquestion.select{{ $question->question_num }}; // not working


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

          // $("#result").text(notstress);
          if(total <= 4 ){
            // var blur = document.getElementById('blur');
            // blur.classList.toggle('active');
            var notstressmodal = document.getElementById('not-stressmodal');
            notstressmodal.classList.toggle('active');
            $("#result_name").val("You don't have a depression");


          } else if (total <= 9) {
            // var blur = document.getElementById('blur');
            // blur.classList.toggle('active');
            var stressmodal = document.getElementById('stressmodal');
            stressmodal.classList.toggle('active');
            $("#result_name").val("You have mild depression");

          }else if (total <= 14) {
            // var blur = document.getElementById('blur');
            // blur.classList.toggle('active');
            var superstressmodal = document.getElementById('super-stressmodal');
            superstressmodal.classList.toggle('active');
            $("#result_name").val("You have moderate depression");

          } else if (total <= 19) {
            // var blur = document.getElementById('blur');
            // blur.classList.toggle('active');
            var moderatelystressmodal = document.getElementById('moderately-severe-stressmodal');
            moderatelystressmodal.classList.toggle('active');

            $("#result_name").val("You have a moderately severe depression");

          } else if (total > 20) {
            // var blur = document.getElementById('blur');
            // blur.classList.toggle('active');
            var severemodal = document.getElementById('severe-stressmodal');
            severemodal.classList.toggle('active');
            $("#result_name").val("You have severe depression");

          }else {
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
