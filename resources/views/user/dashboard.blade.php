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

<?php $latest_race_arr = array();
      $submission = 'false';
      $i=0;

      foreach($latest_race as $latest) {
        $date = date('Y-m-d');
        $dateF = DateTime::createFromFormat('Y-m-d', $latest->date_from)->format('d M Y');
        $dateT = DateTime::createFromFormat('Y-m-d', $latest->date_to)->format('d M Y');

        foreach($medals as $medal) {
          if($medal->races_id == $latest->race_id)
            $grey_medal = asset('storage/uploaded/medals/grey/' . $medal->medal_grey);
        }

        $latest_race_arr[] = array('submission' => $submission,
                                    'title_en' => $latest->title_en,
                                    'title_ms' => $latest->title_ms,
                                    'title_zh' => $latest->title_zh,
                                    'category'=> $latest->race_category,
                                    'date' => $dateF. ' (' .$latest->time_from. ') GMT +08' . ' - ' .$dateT. ' (' .$latest->time_to. ') GMT +08',
                                    'header' => asset('storage/uploaded/races/' . $latest->header));
        $i++;
        if($i==2) break;
      }

      $race_json = json_encode($latest_race_arr);

      $medal_arr = array();
      $j=0;

      foreach($medals as $medal) {
        $medal_arr[] = array('mid' => $medal->mid,
                              'rid' => $medal->rid,
                              'title_en' => $medal->title_en,
                              'title_ms' => $medal->title_ms,
                              'title_zh' => $medal->title_zh,
                              'grey_medal' => asset('storage/uploaded/medals/grey/' . $medal->medal_grey));
        $j++;
        if($j==3) break;
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

var race = JSON.parse('<?= $race_json; ?>');
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
            <span id="view-all"><a href="/user/viewMedals">{{__("View All")}}</a></span>
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
        <div class="row">
          <div class="col-md-6">
            <h3>{{$race_count}} {{__("Joined Races")}}</h3>
          </div>
          <div class="col-md-6">
            <span id="view-all"><a href="/user/viewjoined">{{__("View All")}}</a></span>
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
              }


                /*echo '<div id="user-history-joined">';

                echo '<div class="row">';
                for($i=0; $i<1; $i++) {
                  echo '<div class="col-md-10">';
                  //echo '<img src="' .asset('storage/uploaded/races/' . $latest_race[$i]->header). '">';

                  echo '<h4>' .$latest_race[$i]->title_en. '</h4>';

                  $dateF = DateTime::createFromFormat('Y-m-d', $latest_race[$i]->date_from)->format('d M Y');
                  $dateT = DateTime::createFromFormat('Y-m-d', $latest_race[$i]->date_to)->format('d M Y');

                  echo '<p style="font-family:SourceSansPro-Light;">' .$dateF. ' (' .$latest_race[$i]->time_from. ') GMT +08' . ' - ' .$dateT. ' (' .$latest_race[$i]->time_to. ') GMT +08'. '</p>';

                  echo '<div id="race-progress"></div>';

                  echo '</div>';

                  echo '<div class="col-md-2">';
                  foreach($medals as $medal) {
                    if($medal->races_id == $latest_race[$i]->race_id)
                      echo '<img src="' .asset('storage/uploaded/medals/grey/' . $medal->medal_grey). '">';
                  }
                  echo '</div>';
                }
                echo '</div>';
                echo '</div>';
              }*/

              //if user had joined past race && no join new race
              //if(!$last_join->isEmpty())
              ?>

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

@if($user->strava_access_token)
  @section('script')
  <script>
    document.getElementById("medal-modal").addEventListener("click", function(event){
      return false;
    });
  </script>
  @endsection
@endif

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
