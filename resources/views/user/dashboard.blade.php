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

<script>
var email = "{{$user->email}}"
var name = "{{$user->name}}"

var user = {
  id: "{{$user->id}}",
  name: "{{$user->name}}",
  motto: "{{$user->motto}}",
  profileimg : "{{$user->profileimg}}"
}

</script>

  <div class="userdash p-5">
    <div class="container">

      <div class="user-profile-block">
        <div id="user-profile"></div>
      </div>

      <hr>

      <div class="user-strava-block">
        <div id="user-strava"></div>
      </div>

      <hr>

      <div class="user-medal">
        <div class="row">
          <div class="col-md-6">
            <h3>My Medals</h3>
          </div>
          <div class="col-md-6">
            <span id="view-all"><a href="/user/viewMedals">View All</a></span>
          </div>
        </div>


        <div id="user-medal-frame">
          <div class="row">
            @foreach ($medals as $medal)
            <div class="col-md-4">
              <img src="<?php echo asset('storage/uploaded/medals/grey/' . $medal->medal_grey) ?>" alt="">
            </div>
            @endforeach
          </div>
        </div>
      </div>

      <hr>

      <div class="user-history">
        <div class="row">
          <div class="col-md-6">
            <h3>Joined Races</h3>
          </div>
          <div class="col-md-6">
            <span id="view-all"><a href="#">View All</a></span>
          </div>
        </div>

        <div id="user-history">
          <center>
            <img src="<?php echo asset('img/strava-run.png') ?>">
            <p>Your races will show up here and you’ll be able to submit your run when it start</p>
          </center>
        </div>
      </div>

      <hr>

      <div class="user-current">
        <div class="row">
          <div class="col-md-6">
            <h3>Current Races</h3>
          </div>
          <div class="col-md-6">
            <span id="view-all"><a href="/races">View All</a></span>
          </div>
        </div>

        <div class="row">
          @foreach ($races as $race)
          <div class="col-sm-12 col-md-4">
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
      localStorage.setItem("strava_token", "{{$user->strava_access_token}}")
      localStorage.setItem("strava_id", "{{$user->strava_id}}")
      var token = localStorage.getItem("strava_token")
      var strava_id = localStorage.getItem("strava_id")
  </script>
  @endsection
@endif

@if($user->motto)
@section('script')
  <script>
    var profileimg
    var profileimgTemp = "{{$user->profileimg}}"

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
