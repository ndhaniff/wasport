@extends('layouts.master')

@section('content')

<div class="displayrace">
  <div class="container">

    <center>
    <section class="mb-5">
      <img src="<?php echo asset('storage/uploaded/races/' . $race->header) ?>" alt="{{ $race->title_en }}">

      <ul id="countdown-timer">
        <li>Hurry! Registration closed in | </li>
        <li><span id="days"></span>days</li>
        <li><span id="hours"></span>hours</li>
        <li><span id="minutes"></span>mins</li>
        <li><span id="seconds"></span>secs</li>
      </ul>

      <ul id="countdown-closed">
        <li><span id="days"></span>0 days</li>
        <li><span id="hours"></span>0 hours</li>
        <li><span id="minutes"></span>0 mins</li>
        <li><span id="seconds"></span>0 secs</li>
      </ul>

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

        <?php $dateF = DateTime::createFromFormat('Y-m-d', $race->date_from)->format('d M Y');
              $dateT = DateTime::createFromFormat('Y-m-d', $race->date_to)->format('d M Y');
              echo '<h5>' .$dateF. ' (' .$race->time_from. ') GMT +08' . '<br>-<br>' .$dateT. '(' .$race->time_to. ') GMT +08</h5>'; ?>
        <hr>

        <div class="details-block">
          <h6>Where</h6>
          <p>This is a Virtual Race, you can join and run anywhere in the world. All you need is a GPS-tracking running app.
            <a href="\howitworks">How does it work</a></p>

          <h6>Price</h6>
          <?php if($race->price == 0 && app()->getLocale() == 'en')
                  echo '<p>Free</p>';
                if($race->price == 0 && app()->getLocale() == 'ms')
                  echo '<p>Percuma</p>';
                if($race->price == 0 && app()->getLocale() == 'zh')
                  echo '<p>免费</p>';
                if($race->price != 0 && app()->getLocale() == 'en')
                  echo '<p>RM ' .number_format($race->price, 2). '(Incl. postage fee)</p>';
                if($race->price != 0 && app()->getLocale() == 'ms')
                  echo '<p>RM ' .number_format($race->price, 2). '(Termasuk pengiriman)</p>';
                if($race->price != 0 && app()->getLocale() == 'zh')
                  echo '<p>RM ' .number_format($race->price, 2). '(包邮)</p>'; ?>

          <h6>Registration Deadline</h6>

          <?php $deadF = DateTime::createFromFormat('Y-m-d', $race->dead_from)->format('d M Y');
                echo '<p>' .$deadF. ' (' .$race->deadtime_from. ') GMT +08  or while slots last</p>' ?>

          <?php if($race->category) {
                  echo '<h6>Category</h6>';
                  echo str_replace(",", ", ", $race->category);
          } ?>

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

          <br />

          <?php if($race->medalimg_1 != '')
                  echo "<img src='" .asset('storage/uploaded/medals/' . $race->medalimg_1). "' alt='" .$race->title_en. "'><br /><br />";
                if($race->medalimg_2 != '')
                  echo "<img src='" .asset('storage/uploaded/medals/' . $race->medalimg_2). "' alt='" .$race->title_en. "'><br /><br />";
                if($race->medalimg_3 != '')
                  echo "<img src='" .asset('storage/uploaded/medals/' . $race->medalimg_3). "' alt='" .$race->title_en. "'><br /><br />";
                if($race->medalimg_4 != '')
                  echo "<img src='" .asset('storage/uploaded/medals/' . $race->medalimg_4). "' alt='" .$race->title_en. "'><br /><br />";
                if($race->medalimg_5 != '')
                  echo "<img src='" .asset('storage/uploaded/medals/' . $race->medalimg_5). "' alt='" .$race->title_en. "'><br /><br />";
                if($race->medalimg_6 != '')
                  echo "<img src='" .asset('storage/uploaded/medals/' . $race->medalimg_6). "' alt='" .$race->title_en. "'><br /><br />"; ?>

          <br />

          <h6>Medals</h6>
          <?php if(app()->getLocale() == 'en')
                  echo htmlspecialchars_decode($race->medals_en);
                if(app()->getLocale() == 'ms')
                  echo htmlspecialchars_decode($race->medals_ms);
                if(app()->getLocale() == 'zh')
                  echo htmlspecialchars_decode($race->medals_zh); ?>
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
            <?php $deadT = DateTime::createFromFormat('Y-m-d', $race->dead_to)->format('d M Y');
                  echo '<li>Last submission by ' .$deadT. ' (' .$race->deadtime_to. ') GMT +08</li>'; ?>
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

          <?php
            if($addons->count() != 0) {
              echo '<div class="addons-block">';
              echo '<h6>Add-on</h6>';
              $i=0;
              foreach($addons as $addon) {
                if($addon->descimg_1 != '')
                  echo "<img src='" .asset('storage/uploaded/addons/' . $addon->descimg_1). "' alt='" .$addon->add_en. "'><br /><br />";
                if($addon->descimg_2 != '')
                  echo "<img src='" .asset('storage/uploaded/addons/' . $addon->descimg_2). "' alt='" .$addon->add_en. "'><br /><br />";
                if($addon->descimg_3 != '')
                  echo "<img src='" .asset('storage/uploaded/addons/' . $addon->descimg_3). "' alt='" .$addon->add_en. "'><br /><br />";
                if($addon->descimg_4 != '')
                  echo "<img src='" .asset('storage/uploaded/addons/' . $addon->descimg_4). "' alt='" .$addon->add_en. "'><br /><br />";
                if($addon->descimg_5 != '')
                  echo "<img src='" .asset('storage/uploaded/addons/' . $addon->descimg_5). "' alt='" .$addon->add_en. "'><br /><br />";
                if($addon->descimg_6 != '')
                  echo "<img src='" .asset('storage/uploaded/addons/' . $addon->descimg_6). "' alt='" .$addon->add_en. "'><br /><br />";
                if(app()->getLocale() == 'en') {
                  echo '<b>';
                  echo $i+1 .'. ' .$addon->add_en. ' - RM' .number_format($addon->addprice, 2);
                  echo '</b>';
                  echo $addon->desc_en;
                  echo '<br/>';
                }
                if(app()->getLocale() == 'ms') {
                  echo '<b>';
                  echo $i+1 .'. ' .$addon->add_ms. ' - RM' .number_format($addon->addprice, 2);
                  echo '</b>';
                  echo $addon->desc_ms;
                  echo '<br/>';
                }
                if(app()->getLocale() == 'zh') {
                  echo '<b>';
                  echo $i+1 .'. ' .$addon->add_zh. ' - RM' .number_format($addon->addprice, 2);
                  echo '</b>';
                  echo $addon->desc_zh;
                  echo '<br/>';
                }
                $i++;
              }
              echo '</div>';
              echo '<hr>';
            }
            ?>

          <div class="awards-block">
            <h6>Awards</h6>
            <?php if(app()->getLocale() == 'en')
                    echo htmlspecialchars_decode($race->awards_en);
                  if(app()->getLocale() == 'ms')
                    echo htmlspecialchars_decode($race->awards_ms);
                  if(app()->getLocale() == 'zh')
                    echo htmlspecialchars_decode($race->awards_zh); ?>

            <br />

            <?php if($race->awardimg_1 != '')
                    echo "<img src='" .asset('storage/uploaded/awards/' . $race->awardimg_1). "' alt='" .$race->title_en. "'><br /><br />";
                  if($race->awardimg_2 != '')
                    echo "<img src='" .asset('storage/uploaded/awards/' . $race->awardimg_2). "' alt='" .$race->title_en. "'><br /><br />";
                  if($race->awardimg_3 != '')
                    echo "<img src='" .asset('storage/uploaded/awards/' . $race->awardimg_3). "' alt='" .$race->title_en. "'><br /><br />";
                  if($race->awardimg_4 != '')
                    echo "<img src='" .asset('storage/uploaded/awards/' . $race->awardimg_4). "' alt='" .$race->title_en. "'><br /><br />";
                  if($race->awardimg_5 != '')
                    echo "<img src='" .asset('storage/uploaded/awards/' . $race->awardimg_5). "' alt='" .$race->title_en. "'><br /><br />";
                  if($race->awardimg_6 != '')
                    echo "<img src='" .asset('storage/uploaded/awards/' . $race->awardimg_6). "' alt='" .$race->title_en. "'><br /><br />"; ?>
          </div>
        </div>

      </div>

      <div class="col-md-4">
        <div class="register-box">
          <?php
            $uid = Auth::id();
            $isRegistered = false;

            //if not user
            if($uid == '') {
              echo '<a href="/login" class="race-register-btn">';
              echo __("Login to register");
              echo '</a>';
              echo '<h6>Finisher’s Award</h6>' .
              '<p><img src="' .asset('img/register-1.png'). '">&ensp;Finisher\'s Medal</p>' .
              '<p><img src="' .asset('img/register-2.png'). '">&ensp;Finisher\'s Certificate</p>';
            }

            //if user
            if($uid != '') {
              //check register or not
              foreach($orders as $order) {
                if($order->user_id == $uid && $order->race_id == $race->rid) {
                  $isRegistered = true;
                }
              }

              if($isRegistered) {
                echo '<h4>';
                echo __("You had registered");
                echo '</h4>';
                echo '<a href="/dashboard" class="race-register-btn">';
                echo __("Go to profile");
                echo '</a>';
              } else {
                if($race->price == 0 && app()->getLocale() == 'en')
                  echo '<h3>Free</h3>';
                if($race->price == 0 && app()->getLocale() == 'ms')
                  echo '<h3>Percuma</h3>';
                if($race->price == 0 && app()->getLocale() == 'zh')
                  echo '<h3>免费</h3>';
                if($race->price != 0 && app()->getLocale() == 'en')
                  echo '<h3>RM ' .number_format($race->price, 2). '</h3>';
                if($race->price != 0 && app()->getLocale() == 'ms')
                  echo '<h3>RM ' .number_format($race->price, 2). '</h3>';
                if($race->price != 0 && app()->getLocale() == 'zh')
                  echo '<h3>RM ' .number_format($race->price, 2). '</h3>';
                date_default_timezone_set("Asia/Kuala_Lumpur");
                $deadT = $race->dead_to. ' ' .$race->deadtime_to;
                $deadline = DateTime::createFromFormat('Y-m-d H:i a', $deadT)->format('Y-m-d H:i a');
                $cur = date('Y-m-d H:i a');
                if($cur < $deadline) {
                  echo '<a href="/registerrace/' .$race->rid. '" class="race-register-btn">';
                  echo __("Register");
                  echo '</a>';
                } else {
                  echo '<button type="button" class="race-register-btn" disabled>';
                  echo __("Registration closed");
                  echo '</button>';
                }
                if($race->price != 0)
                  echo '<h6>Finisher’s Award</h6>' .
                  '<p><img src="' .asset('img/register-1.png'). '">&ensp;Finisher\'s Medal</p>' .
                  '<p><img src="' .asset('img/register-2.png'). '">&ensp;Finisher\'s Certificate</p>';
              }
            }
          ?>
        </div>
      </div>
    </div>

  </div>
</div>

<?php $theDate = $race->dead_to . ' ' . $race->deadtime_to;
      $countDate = DateTime::createFromFormat('Y-m-d H:i a', $theDate)->format('M j, Y H:i:s'); ?>

<script type="text/javascript">
const second = 1000,
    minute = second * 60,
    hour = minute * 60,
    day = hour * 24;
let countDown = new Date('<?= $countDate ?>').getTime(),
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
      document.getElementById("countdown-closed").style.display = "block";
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
