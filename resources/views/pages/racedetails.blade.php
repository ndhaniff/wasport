@extends('layouts.master')

@section('content')

<div class="displayrace">
  <div class="container">

    <center>
    <section>
      <img src=" <?php echo asset('img/races/' . $race->header) ?>" alt="{{ $race->title_en }}">

      <ul id="countdown-timer">
        <li>Hurry! Registration closed in | </li>
        <li><span id="days"></span>days</li>
        <li><span id="hours"></span>hours</li>
        <li><span id="minutes"></span>mins</li>
        <li><span id="seconds"></span>secs</li>
      </ul>

      <h3 id="closed">Registration closed</h3>
    </section>

    <h1 id="date"></h1>
    <center>

    <div class="row">
      <div class="col-md-8 race-details">
        <?php if(app()->getLocale() == 'en')
                echo '<h2>' .$race->title_en. '</h2>';
              if(app()->getLocale() == 'ms')
                echo '<h2>' .$race->title_ms. '</h2>';
              if(app()->getLocale() == 'zh')
                echo '<h2>' .$race->title_zh. '</h2>'; ?>

        <?php $dateF = DateTime::createFromFormat('Y-m-d H:i a', $race->date_from);

              $dateT = DateTime::createFromFormat('Y-m-d H:i a', $race->date_to);

              $formatdateF = $dateF->format('d M (H:ia)');

              $formatdateT = $dateT->format('d M Y (H:ia)');

              echo '<h5>' .$formatdateF.' GMT +08 - '.$formatdateT.' GMT +08</h5>' ?>
        <hr>

        <div class="details-block">
          <h6>Where</h6>
          <p>This is a Virtual Race, you can join and run anywhere in the world. All you need is a GPS-tracking running app.
            <a href="\howitworks">How does it work</a></p>

          <h6>Price</h6>
          <p>RM {{ $race->price_en }} (Incl. postage fee)</p>

          <h6>Registration Deadline</h6>

          <?php $deadF = DateTime::createFromFormat('Y-m-d H:i a', $race->dead_from);

                $formatdeadF = $deadF->format('d M Y (H:ia)');

                echo '<p>' .$formatdeadF. ' GMT +08  or while slots last</p>' ?>

          <h6>Category</h6>
          <p></p>

          <h6>Cut Off Time</h6>
          <p>No cut off time</p>
        </div>

        <hr>

        <div class="about-block">
          <h6>About</h6>
          <?php if(app()->getLocale() == 'en')
                  echo htmlspecialchars_decode($race->about_en);
                if(app()->getLocale() == 'ms')
                  echo htmlspecialchars_decode($race->about_ms);
                if(app()->getLocale() == 'zh')
                  echo htmlspecialchars_decode($race->about_zh); ?>
        </div>

        <hr>

        <div class="how-block">
          <h6>How does a Virtual Race work?</h6>
          <p><img src="{{asset('img/how-1.png')}}">&ensp;Register on a Virtual Race like this</p>
          <p><img src="{{asset('img/how-2.png')}}">&ensp;Use a GPS-tracking running app to track your run</p>
          <p><img src="{{asset('img/how-3.png')}}">&ensp;Track and finish the race</p>
          <p><img src="{{asset('img/how-4.png')}}">&ensp;Submit it on your profile</p>
          <p><img src="{{asset('img/how-5.png')}}">&ensp;We will verify it and send your award</p>
        </div>

        <hr>

        <div class="rules-block">
          <h6>Rules</h6>

          <ul>
            <?php $deadF = DateTime::createFromFormat('Y-m-d H:i a', $race->dead_from);

                  $formatdeadF = $deadF->format('d M Y, D (H:ia)');

                  echo '<li>Last submission by ' .$formatdeadF. ' GMT +08</li>' ?>
            <li>“No completion, no medal” policy; This race is based on honour system, Wasport will do periodic checks on the submissions. Treat yourself, don’t cheat yourself.</li>
            <li>Change of category, refund and/or transfer of bib is not allowed.</li>
            <li>Pedometers are not allowed.</li>
            <li>All GPS-based app are accepted.</li>
            <li>Account may be suspended if fraudulent results are found</li>
            <li>Complete in ONE run.</li>
          </ul>

          <hr>

          <div class="faq-block">
            <h6>People also ask</h6>

            <button class="accordion">&ensp; When will the medal be delivered?</button>
            <div class="panel">
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>

            <button class="accordion">&ensp; How much is the medal delivery fee?</button>
            <div class="panel">
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>

            <button class="accordion">&ensp; How to submit my routes?</button>
            <div class="panel">
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>

            <button class="accordion">&ensp; Where can I view my results?</button>
            <div class="panel">
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>

            <button class="accordion">&ensp; Can I walk or hike?</button>
            <div class="panel">
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>

            <button class="accordion">&ensp; What are the approved GPS running app?</button>
            <div class="panel">
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>
          </div>

          <hr>

          <div class="awards-block">
            <h6>Awards</h6>
            <?php if(app()->getLocale() == 'en')
                    echo htmlspecialchars_decode($race->awards_en);
                  if(app()->getLocale() == 'ms')
                    echo htmlspecialchars_decode($race->awards_ms);
                  if(app()->getLocale() == 'zh')
                    echo htmlspecialchars_decode($race->awards_zh); ?>
          </div>
        </div>

      </div>

      <div class="col-md-4">
        <div class="register-box">
          <h3>RM {{ number_format($race->price_en, 2) }}</h3>
          <button type="button" class="race-register-btn"><a href="#">Register</a></button>

          <h6>Finisher’s Award</h6>
          <p><img src="{{asset('img/register-1.png')}}">&ensp;Finisher's Medal</p>
          <p><img src="{{asset('img/register-2.png')}}">&ensp;Finisher's Certificate</p>
        </div>
      </div>
    </div>

  </div>
</div>

<script type="text/javascript">
const second = 1000,
    minute = second * 60,
    hour = minute * 60,
    day = hour * 24;

let countDown = new Date('{{ $race->dead_from }}').getTime(),
  x = setInterval(function() {

    let now = new Date().getTime(),
    distance = countDown - now;

    if(distance > 0) {
      document.getElementById('days').innerText = Math.floor(distance / (day)),
      document.getElementById('hours').innerText = Math.floor((distance % (day)) / (hour)),
      document.getElementById('minutes').innerText = Math.floor((distance % (hour)) / (minute)),
      document.getElementById('seconds').innerText = Math.floor((distance % (minute)) / second);

    } else {
      document.getElementById("countdown-timer").style.display = "none";
      document.getElementById("closed").style.display = "block";
    }


  }, second)

  var acc = document.getElementsByClassName("accordion");
  var i;

  for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
      this.classList.toggle("active");
      var panel = this.nextElementSibling;
      if (panel.style.maxHeight){
        panel.style.maxHeight = null;
      } else {
        panel.style.maxHeight = panel.scrollHeight + "px";
      }
    });
  }
</script>

@endsection
