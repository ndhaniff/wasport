@extends('layouts.master')

@section('title')
Dashboard | WaSportsrun
@endsection

@section('content')

<style>
svg:not(:root) { display: none; }

.anticon-check-circle:before,
.anticon-close:before, .anticon-cross:before,
.ant-calendar-picker-icon:after,
.anticon-close-circle:before, .anticon-cross-circle:before { display: none; }
</style>

<?php date_default_timezone_set("Asia/Kuala_Lumpur");
      $date = date('Y-m-d H:i a');
      $latest_race_arr = array();
      $i=0;

      foreach($latest_race as $latest) {
        $submission = 'false';

        $dateTimeFrom = $latest->date_from .' '. $latest->time_from;
        $dateTimeTo = $latest->date_to .' '. $latest->time_to;

        if($dateTimeFrom <= $date && $dateTimeTo >= $date) {
          $submission = 'true';
        }

        if($dateTimeTo < $date) {
          $submission = 'closed';
        }

        $dateF = DateTime::createFromFormat('Y-m-d', $latest->date_from)->format('d M Y');
        $dateT = DateTime::createFromFormat('Y-m-d', $latest->date_to)->format('d M Y');

        $latest_race_arr[] = array('submission' => $submission,
                                    'rid' => $latest->rid,
                                    'title_en' => $latest->title_en,
                                    'title_ms' => $latest->title_ms,
                                    'title_zh' => $latest->title_zh,
                                    'category'=> $latest->race_category,
                                    'date' => $dateF. ' (' .$latest->time_from. ') GMT +08' . ' - ' .$dateT. ' (' .$latest->time_to. ') GMT +08',
                                    'header' => asset('storage/uploaded/races/' . $latest->header),
                                    'race_status' => $latest->race_status);
        $i++;
        if($i==2) break;
      }

      $race_json = json_encode($latest_race_arr);

      $allmedal_arr = array();
      foreach($allmedals as $allmedal) {
        $allmedal_arr[] = array('races_id' => $allmedal->races_id,
                                'bib_img' => asset('storage/uploaded/bib/' . $allmedal->bib),
                                'cert_img' => asset('storage/uploaded/cert/' . $allmedal->cert));
      }
      $allmedal_json = json_encode($allmedal_arr);

      $medal_arr = array();
      $check_arr = array();
      foreach($usermedals as $medal) {
        $medal_arr[] = array('mid' => $medal->mid,
                              'rid' => $medal->rid,
                              'title_en' => $medal->title_en,
                              'title_ms' => $medal->title_ms,
                              'title_zh' => $medal->title_zh,
                              'medal_status' => 'true',
                              'medal_message' => 'Joined',
                              'medal_color' => asset('storage/uploaded/medals/color/' . $medal->medal_color));
        array_push($check_arr, $medal->title_en);
      }

      foreach($joinedmedals as $medal) {
        if(in_array($medal->title_en, $check_arr)){

        } else {
          $medal_arr[] = array('mid' => $medal->mid,
                              'rid' => $medal->rid,
                              'title_en' => $medal->title_en,
                              'title_ms' => $medal->title_ms,
                              'title_zh' => $medal->title_zh,
                              'medal_status' => 'false',
                              'medal_message' => 'Joined',
                              'medal_grey' => asset('storage/uploaded/medals/grey/' . $medal->medal_grey));
          array_push($check_arr, $medal->title_en);
        }
      }

      foreach($dashmedals as $medal) {
        if(in_array($medal->title_en, $check_arr)){

        } else {
          $deadTimeTo = $medal->dead_to .' '. $medal->deadtime_to;

          if($deadTimeTo > $date) {
            $medal_arr[] = array('mid' => $medal->mid,
                                  'rid' => $medal->rid,
                                  'title_en' => $medal->title_en,
                                  'title_ms' => $medal->title_ms,
                                  'title_zh' => $medal->title_zh,
                                  'medal_status' => 'false',
                                  'medal_message' => 'Open',
                                  'medal_grey' => asset('storage/uploaded/medals/grey/' . $medal->medal_grey));
          } else {
            $medal_arr[] = array('mid' => $medal->mid,
                                  'rid' => $medal->rid,
                                  'title_en' => $medal->title_en,
                                  'title_ms' => $medal->title_ms,
                                  'title_zh' => $medal->title_zh,
                                  'medal_status' => 'false',
                                  'medal_message' => 'Closed',
                                  'medal_grey' => asset('storage/uploaded/medals/grey/' . $medal->medal_grey));
          }
          array_push($check_arr, $medal->title_en);
          }
      }
      $medal_json = json_encode($medal_arr); ?>

<script>
var user = {
  id: "{{$user->id}}",
  name: "{{$user->name}}",
  motto: "{{$user->motto}}",
  profileimg : "{{$user->profileimg}}"
}

var email = "{{$user->email}}"
var name = "{{$user->name}}"
var firstname = "{{$user->firstname}}"
var lastname = "{{$user->lastname}}"
var motto = "{{$user->motto}}"
var gender = "{{$user->gender}}"
var phone = "{{$user->phone}}"
var birthday = "{{$user->birthday}}"
var add_fl = "{{$user->add_fl}}"
var add_sl = "{{$user->add_sl}}"
var city = "{{$user->city}}"
var state = "{{$user->state}}"
var postal = "{{$user->postal}}"
var strava_id = "{{$user->strava_id}}"
var strava_token = "{{$user->strava_access_token}}"

var race = JSON.parse('<?= $race_json; ?>');
var allmedal = JSON.parse('<?= $allmedal_json; ?>');
var medal = JSON.parse('<?= $medal_json; ?>');
</script>

  <div class="userdash p-5">
    <div class="container">

      <div class="user-profile-block">

        <?php if(app()->getLocale() == 'en')
                echo '<div id="user-profile-en"></div>';
              if(app()->getLocale() == 'ms')
                echo '<div id="user-profile-ms"></div>';
              if(app()->getLocale() == 'zh')
                echo '<div id="user-profile-zh"></div>'; ?>
      </div>

      <hr>

      <div class="user-strava-block">
        <h3>{{__("Stats")}}</h3>
        <?php if(app()->getLocale() == 'en')
                echo '<div id="user-strava-en"></div>';
              if(app()->getLocale() == 'ms')
                echo '<div id="user-strava-ms"></div>';
              if(app()->getLocale() == 'zh')
                echo '<div id="user-strava-zh"></div>'; ?>
      </div>

      <hr>

      <div class="user-medal">
        <div class="row">
          <div class="col-md-6">
            <h3>{{__("My Medals")}}</h3>
          </div>
          <div class="col-md-6">
            <span id="view-all"><a href="/viewMedals">{{__("View All")}}</a></span>
          </div>
        </div>

        <div id="user-medal-frame">
          <?php if(app()->getLocale() == 'en')
                  echo '<div id="dashboard-medal-en"></div>';
                if(app()->getLocale() == 'ms')
                  echo '<div id="dashboard-medal-ms"></div>';
                if(app()->getLocale() == 'zh')
                  echo '<div id="dashboard-medal-zh"></div>'; ?>
        </div>
      </div>

      <hr>

      <div class="user-history">
        <div class="row" id="user-history-header">
          <div class="col-md-6">
            <h3>{{$race_count}} {{__("Joined Races")}}</h3>
          </div>
          <div class="col-md-6">
            <span id="view-all"><a href="/viewjoined">{{__("View All")}}</a></span>
          </div>
        </div>

        <?php //if user never join race before
              if($latest_race->isEmpty()) {
                  echo '<div id="user-history-none">';
                  echo '<center>';
                  echo '<img src="' .asset('img/strava-run.png'). '">';
                  echo '<p>';
                  echo __("Your races will show up here and you’ll be able to submit your run when it start");
                  echo '</p>';
                  echo '</center>';
                  echo '</div>';
              }

              //if user has join race that submission not yet open
              if(!$latest_race->isEmpty()) {
                if(app()->getLocale() == 'en')
                  echo '<div id="user-history-joined-en"></div>';
                if(app()->getLocale() == 'ms')
                  echo '<div id="user-history-joined-ms"></div>';
                if(app()->getLocale() == 'zh')
                  echo '<div id="user-history-joined-zh"></div>';
              } ?>

      </div>

      <hr>

      <div class="user-current">
        <div class="row">
          <div class="col-md-6">
            <h3>{{__("Current Races")}}</h3>
          </div>
          <div class="col-md-6">
            <span id="view-all"><a href="/races">{{__("View All")}}</a></span>
          </div>
        </div>

        <div class="row">
          @foreach ($races as $race)
          <div class="col-sm-12 col-md-4">
            <div class="current-listing">
              <a href="racedetails/{{ $race->rid }}">
                <div class="race-box">
                  <div class="race-img">
                    <img src="<?php echo asset('storage/uploaded/races/' . $race->header) ?>" alt="{{ $race->title_en }}">
                  </div>

                  <div class="race-caption">
                    <?php if(app()->getLocale() == 'en')
                            echo '<h5>' .$race->title_en. '</h5>';
                          if(app()->getLocale() == 'ms')
                            echo '<h5>' .$race->title_ms. '</h5>';
                          if(app()->getLocale() == 'zh')
                            echo '<h5>' .$race->title_zh. '</h5>'; ?>

                    <hr>

                    <div class="raceslisting-date">
                      <?php $dateF = DateTime::createFromFormat('Y-m-d', $race->date_from)->format('d M Y');
                            $dateT = DateTime::createFromFormat('Y-m-d', $race->date_to)->format('d M Y');

                            echo $dateF. ' (' .$race->time_from. ') GMT +08' . '<br>-<br>' .$dateT. '(' .$race->time_to. ') GMT +08'; ?>
                    </div>

                  </div>
                </div>
              </a>
            </div>
          </div>
          @endforeach
        </div>
      </div>

      <!--<div id ="user-dashboard"></div>-->
    </div>
  </div>

@endsection

@if($user->motto)
@section('script')
  <script>
    var profileimg
    var profileimgTemp = "{{$user->profileimg}}"

    if(profileimgTemp != "")
      profileimg = window.location.origin + '/storage/uploaded/users/' + "{{$user->profileimg}}"
    else
      profileimg = "{{$user->profileimg}}"

    if(localStorage.getItem("strava_token") === null){
      localStorage.setItem("strava_token", "{{$user->strava_access_token}}")
      localStorage.setItem("strava_id", "{{$user->strava_id}}")
    } else {
      var token = localStorage.getItem("strava_token")
      var strava_id = localStorage.getItem("strava_id")
    }
  </script>
  @endsection
@endif
