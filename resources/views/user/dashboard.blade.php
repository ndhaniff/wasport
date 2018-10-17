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
          <div class="row">
            @foreach($medals as $medal)
            <div class="col-md-4">
              <a id="medal-modal" data-toggle="modal" data-target="#medalViewer-{{$medal->mid}}" data-id="{{$medal->mid}}">
                <img src="<?= asset('storage/uploaded/medals/grey/' . $medal->medal_grey) ?>" alt="{{$medal->title_en}}">
              </a>
            </div>

            <!-- The Modal -->
            <div class="modal hide fade" id="medalViewer-{{$medal->mid}}" tabindex="-1" role="document" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                  <!-- Modal body -->
                  <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                    <img src="<?= asset('storage/uploaded/medals/grey/' . $medal->medal_grey) ?>" alt="{{$medal->title_en}}" id="modal-img"> <br>

                    <h3>{{$medal->title_en}}</h3>

                  </div>
                </div>
              </div>
            </div>

            @endforeach
          </div>
        </div>
      </div>

      <hr>

      <div class="user-history">
        <div class="row">
          <div class="col-md-6">
            <h3>{{__("Joined Races")}}</h3>
          </div>
          <div class="col-md-6">
            <span id="view-all"><a href="#">{{__("View All")}}</a></span>
          </div>
        </div>

        <?php if($last_join != '') {
          echo '<div id="user-history">';
          echo '<center>';
          echo '<img src="' .asset('img/strava-run.png'). '">';
          echo '<p>';
          echo __("Your races will show up here and you’ll be able to submit your run when it start");
          echo '</p>';
          echo '</center>';
          echo '</div>';
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
