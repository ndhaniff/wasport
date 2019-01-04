@extends('layouts.master')

<style>
.anticon:before,
svg:not(:root) { display: none !important; }

@media screen and (max-width: 414px) {
  .ant-modal-content,
  .ant-form { width: 395px; }

  .ant-form-item-control { width: 348px !important; }

  #register-step4 { width: 100% !important; }

  #register-step4 .col-sm-9 { width: 65% !important; }

  #register-step4 .col-sm-3 { width: 35% !important; }
}

@media screen and (max-width: 375px) {
  .ant-modal-content,
  .ant-form { width: 355px; }

  .ant-form-item-control { width: 310px !important; }
}

@media screen and (max-width: 320px) {
  .ant-modal-content,
  .ant-form { width: 300px; }

  .ant-form-item-control { width: 255px !important; }
}
</style>

@section('content')

<div class="displayrace">
  <div class="container">

    <center>
    <section class="mb-5">
      <img src="<?php echo asset('storage/uploaded/races/' . $race->header) ?>" alt="{{ $race->title_en }}">

      <ul id="engrave-timer">
        <li>{{__("Free engraving when you register in")}} &emsp; <span id="countdown-line">|</span></li><br id="countdown-br"/>
        <li><span id="edays"></span> {{__("days")}}</li>
        <li><span id="ehours"></span> {{__("hours")}}</li>
        <li><span id="eminutes"></span> {{__("mins")}}</li>
        <li><span id="eseconds"></span> {{__("secs")}}</li>
      </ul>

      <ul id="countdown-timer">
        <li>{{__("Hurry! Registration closed in")}} &emsp; <span id="countdown-line">|</span></li><br id="countdown-br"/>
        <li><span id="days"></span> {{__("days")}}</li>
        <li><span id="hours"></span> {{__("hours")}}</li>
        <li><span id="minutes"></span> {{__("mins")}}</li>
        <li><span id="seconds"></span> {{__("secs")}}</li>
      </ul>

      <p id="countdown-closed">{{__("Registration closed")}}</p>

    </section>

    <h1 id="date"></h1>
    <center>

    <div class="row">

      <div class="register-box-mobile">
        <?php
          $uid = Auth::id();
          $isRegistered = false;

          $deadline = $race->dead_to. ' ' .$race->deadtime_to;
          $cur = date('Y-m-d H:i a');

          //if not user
          if($uid == '') {

            if($cur < $deadline) {
              echo '<a href="/login" class="race-register-btn">' .__("Login to register"). '</a>';
            } else {
              echo '<button type="button" class="race-register-btn" disabled>' .__("Registration closed"). '</button>';
            }
          }

          //if user
          if($uid != '') {
            //check register or not
            foreach($orders as $order) {
              if($order->payment_status == 'paid') {
                  $isRegistered = 'true';
              }
            }

            if($isRegistered) {
              echo '<div class="row"><div style="width: 50%;">';
              echo '<h4>' .__("You had registered"). '</h4></div>';
              echo '<div style="width: 50%;"><a href="/dashboard" class="race-register-btn">' .__("Go to profile") .'</a></div></div>';
            } else {
              if($race->price == 0) {
                echo '<div class="row"><div style="width: 50%;">';
                echo '<h3 style="padding-top: 3px;">' .__("Free"). '</h3></div></div>';
              }
              if($race->price != 0) {
                echo '<div class="row"><div style="width: 50%;">';
                echo '<h3 style="padding-top: 3px;">RM ' .number_format($race->price, 2). '</h3></div></div>';
              }

              if($cur < $deadline) {
                echo '<div style="width: 50%;">';
                if(app()->getLocale() == 'en')
                  echo '<div id="register-race-mobile-en"></div>';
                if(app()->getLocale() == 'ms')
                  echo '<div id="register-race-mobile-ms"></div>';
                if(app()->getLocale() == 'zh')
                  echo '<div id="register-race-mobile-zh"></div>';

                echo '</div>';
              } else {
                echo '<button type="button" class="race-register-btn" disabled>' .__("Registration closed"). '</button>';
              }
            }
          } ?>
      </div>

      <div class="col-md-8 race-details">
        <?php if(app()->getLocale() == 'en')
                echo '<h2>' .$race->title_en. '</h2>';
              if(app()->getLocale() == 'ms')
                echo '<h2>' .$race->title_ms. '</h2>';
              if(app()->getLocale() == 'zh')
                echo '<h2>' .$race->title_zh. '</h2>';

              $dateF = DateTime::createFromFormat('Y-m-d', $race->date_from)->format('d M Y');
              $dateT = DateTime::createFromFormat('Y-m-d', $race->date_to)->format('d M Y');
              echo '<h5>' .$dateF. ' (' .$race->time_from. ') GMT +08' . '<br>-<br>' .$dateT. '(' .$race->time_to. ') GMT +08</h5>'; ?>

        <hr>

        <?php if($race->price != 0) {
                echo '<div class="finisher-mobile">';
                echo '<h6>' .__("Finisher's Award"). '</h6>';
                echo '<p><img src="' .asset('img/register-1.png'). '">&ensp;' .__("Finisher's Medal"). '</p>';
                echo '<p><img src="' .asset('img/register-2.png'). '">&ensp;' .__("Finisher's Certificate"). '</p>';
                echo '</div>';
              } ?>

        <div class="details-block">
          <h6>{{__("Where")}}</h6>

          <p>This is a Virtual Race, you can join and run anywhere in the world. All you need is a GPS-tracking running app.
            <a href="\howitworks">{{__("How does it work")}}</a></p>


          <h6>{{__("Price")}}</h6>
          <?php if($race->price == 0)
                  echo '<p>' .__("Free"). '</p>';
                if($race->price != 0)
                  echo '<p>RM ' .number_format($race->price, 2). '(' .__("Incl. postage fee"). ')</p>'; ?>

          <h6>{{__("Registration Deadline")}}</h6>

          <?php $deadF = DateTime::createFromFormat('Y-m-d', $race->dead_to)->format('d M Y');
                echo '<p>' .$deadF. ' (' .$race->deadtime_to. ') GMT +08  or while slots last</p>' ?>

          <?php if($race->category) {
                  echo '<h6>' .__("Category"). '</h6>';
                  echo str_replace(",", ", ", $race->category);
          } ?>

          <h6>{{__("Cut Off Time")}}</h6>
          <p>{{__("No cut off time")}}</p>
        </div>

        <hr>

        <div class="about-block">
          <h6>{{__("About")}}</h6>
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

          <?php if($race->price == 0) {
                  echo '<h6>' .__("Finisher's Award"). '</h6>';

                  if(app()->getLocale() == 'en')
                    echo htmlspecialchars_decode($race->medals_en);
                  if(app()->getLocale() == 'ms')
                    echo htmlspecialchars_decode($race->medals_ms);
                  if(app()->getLocale() == 'zh')
                    echo htmlspecialchars_decode($race->medals_zh);
                } else {
                  echo '<h6>' .__("Medals"). '</h6>';

                  if(app()->getLocale() == 'en')
                    echo htmlspecialchars_decode($race->medals_en);
                  if(app()->getLocale() == 'ms')
                    echo htmlspecialchars_decode($race->medals_ms);
                  if(app()->getLocale() == 'zh')
                    echo htmlspecialchars_decode($race->medals_zh);
                } ?>
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
          <h6>{{__("Rules")}}</h6>

          <ul>
            <?php $deadT = DateTime::createFromFormat('Y-m-d', $race->dead_to)->format('d M Y');
                  echo '<li>Last submission by ' .$deadT. ' (' .$race->deadtime_to. ') GMT +08</li>'; ?>
            <li>"No completion, no medal" policy; This race is based on honour system, Wasport will do periodic checks on the submissions. Treat yourself, don’t cheat yourself.</li>
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
        </div>

        <?php
          if($addons->count() != 0) {
            echo '<hr>';
            echo '<div class="addons-block">';
            echo '<h6>' .__("Add-on"). '</h6>';
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
          } ?>

          <?php if($race->awards_en != '') {
                  echo '<div class="awards-block">';
                  echo '<h6>' .__("Awards"). '</h6>';

                  if(app()->getLocale() == 'en')
                    echo htmlspecialchars_decode($race->awards_en);
                  if(app()->getLocale() == 'ms')
                    echo htmlspecialchars_decode($race->awards_ms);
                  if(app()->getLocale() == 'zh')
                    echo htmlspecialchars_decode($race->awards_zh);

                  echo '<br />';

                  if($race->awardimg_1 != '')
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
                    echo "<img src='" .asset('storage/uploaded/awards/' . $race->awardimg_6). "' alt='" .$race->title_en. "'><br /><br />";

                  echo '</div>';
                } ?>

      </div>

      <div class="col-md-4">
        <div class="register-box">
          <?php
            $uid = Auth::id();
            $isRegistered = false;

            $deadline = $race->dead_to. ' ' .$race->deadtime_to;
            $cur = date('Y-m-d H:i a');

            //if not user
            if($uid == '') {

              if($cur < $deadline) {
                if($race->price == 0) {
                  echo '<a href="/login" class="race-register-btn">' .__("Login to register"). '</a>';
                } else {
                  echo '<a href="/login" class="race-register-btn">' .__("Login to register"). '</a>';
                  echo '<h6>' .__("Finisher's Award"). '</h6>';
                  echo '<p><img src="' .asset('img/register-1.png'). '">&ensp;' .__("Finisher's Medal"). '</p>';
                  echo '<p><img src="' .asset('img/register-2.png'). '">&ensp;' .__("Finisher's Certificate"). '</p>';
                }
              } else {
                echo '<button type="button" class="race-register-btn" disabled>';
                echo __("Registration closed");
                echo '</button>';
              }
            }

            //if user
            if($uid != '') {
              //check register or not
              foreach($orders as $order) {
                if($order->payment_status == 'paid') {
                  $isRegistered = true;
                }
              }

              if($isRegistered) {
                echo '<h4>' .__("You had registered"). '</h4>';
                echo '<a href="/dashboard" class="race-register-btn">' .__("Go to profile"). '</a>';
              }

              if(!$isRegistered) {
                if($race->price == 0)
                  echo '<h3>' .__("Free"). '</h3>';
                else
                  echo '<h3>RM ' .number_format($race->price, 2). '</h3>';

                if($cur < $deadline) {
                  /*echo '<a href="/registerrace/' .$race->rid. '" class="race-register-btn">';
                  echo __("Register");
                  echo '</a>';*/

                  if(app()->getLocale() == 'en')
                    echo '<div id="register-race-en"></div>';
                  if(app()->getLocale() == 'ms')
                    echo '<div id="register-race-ms"></div>';
                  if(app()->getLocale() == 'zh')
                    echo '<div id="register-race-zh"></div>';

                } else {
                  echo '<button type="button" class="race-register-btn" disabled>' .__("Registration closed"). '</button>';
                }

                if($race->price != 0) {
                  echo '<h6>' .__("Finisher's Award"). '</h6>';
                  echo '<p><img src="' .asset('img/register-1.png'). '">&ensp;' .__("Finisher's Medal"). '</p>';
                  echo '<p><img src="' .asset('img/register-2.png'). '">&ensp;' .__("Finisher's Certificate"). '</p>';
                }

              }
            } ?>
        </div>
      </div>
    </div>

  </div>
</div>

<?php $addon_arr = array();

      foreach($addons as $addon) {
        $addon_arr[] = array('aid' => $addon->aid, 'add_en' => $addon->add_en, 'addprice' => $addon->addprice, 'type' => $addon->type);
      }

      $addon_json = json_encode($addon_arr); ?>

<?php $engrave = $race->engrave;
      $engrave_status = '';

      echo $engrave;

      date_default_timezone_set("Asia/Kuala_Lumpur");
      $date = date('M j, Y H:i:s');
      $countEngraveDate = 0;

      if($engrave == 'yes') {
        $theEngraveDead = $race->dead_from . '' . $race->deadtime_from;
        $countEngraveDate = DateTime::createFromFormat('Y-m-d H:i a', $theEngraveDead)->format('M j, Y H:i:s');

        if($date < $countEngraveDate) {
          $engrave_status = 'false';
        }
        if($date > $countEngraveDate) {
          $engrave_status = 'true';
        }
      }else if($engrave == 'no') {
        $countEngraveDate = 0;
        $engrave_status = 'false';
      }

      $theRegisterDead = $race->dead_to . ' ' . $race->deadtime_to;
      $countRegisterDate = DateTime::createFromFormat('Y-m-d H:i a', $theRegisterDead)->format('M j, Y H:i:s'); ?>

<script type="text/javascript">

const second = 1000,
      minute = second * 60,
      hour = minute * 60,
      day = hour * 24;

if('{{$engrave}}' == 'yes')
  var countdownEngrave = new Date('<?= $countEngraveDate ?>').getTime()
else
  var countdownEngrave = 0

let countdownRegister = new Date('<?= $countRegisterDate ?>').getTime(),
    x = setInterval(function() {
    let now = new Date().getTime(),
    distanceE = countdownEngrave - now,
    distanceR = countdownRegister - now;

    if('{{$engrave}}' == 'yes' && distanceE > 0){
      document.getElementById("countdown-timer").style.display = "none";
      document.getElementById("engrave-timer").style.display = "block";
      document.getElementById("countdown-closed").style.display = "none"

      document.getElementById('edays').innerText = Math.floor(distanceE / (day)),
      document.getElementById('ehours').innerText = Math.floor((distanceE % (day)) / (hour)),
      document.getElementById('eminutes').innerText = Math.floor((distanceE % (hour)) / (minute)),
      document.getElementById('eseconds').innerText = Math.floor((distanceE % (minute)) / second);
    } else if('{{$engrave}}' == 'no' || distanceR > 0) {
      document.getElementById("countdown-timer").style.display = "block";
      document.getElementById("engrave-timer").style.display = "none";
      document.getElementById("countdown-closed").style.display = "none";

      document.getElementById('days').innerText = Math.floor(distanceR / (day)),
      document.getElementById('hours').innerText = Math.floor((distanceR % (day)) / (hour)),
      document.getElementById('minutes').innerText = Math.floor((distanceR % (hour)) / (minute)),
      document.getElementById('seconds').innerText = Math.floor((distanceR % (minute)) / second);
    } else {
      document.getElementById("countdown-timer").style.display = "none";
      document.getElementById("engrave-timer").style.display = "none";
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

  var race = {
    rid: "{{$race->rid}}",
    title_en: "{{$race->title_en}}",
    title_ms: "{{$race->title_ms}}",
    title_zh: "{{$race->title_zh}}",
    price: "{{$race->price}}",
    category: "{{$race->category}}",
    engrave: "{{$race->engrave}}",
    engrave_status : "{{$engrave_status}}"
  }

  var addons = JSON.parse('<?= $addon_json; ?>');
</script>

@if (Auth::check())
  <script>
    var user = {
      id: "{{$user->id}}",
      firstname: "{{$user->firstname}}",
      lastname: "{{$user->lastname}}",
      phone: "{{$user->phone}}",
      gender: "{{$user->gender}}",
      birthday: "{{$user->birthday}}",
      add_fl: "{{$user->add_fl}}",
      add_sl: "{{$user->add_sl}}",
      city: "{{$user->city}}",
      state: "{{$user->state}}",
      postal: "{{$user->postal}}",
      email: "{{$user->email}}"
    }
  </script>
@else
<script>
  var user = {
    id: "",
    firstname: "",
    lastname: "",
    phone: "",
    gender: "",
    birthday: "",
    email: "",
    add_fl: "",
    add_sl: "",
    city: "",
    state: "",
    postal: ""
  }
</script>
@endif
@endsection
