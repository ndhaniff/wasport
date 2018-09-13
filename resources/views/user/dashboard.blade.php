@extends('layouts.master')

@section('title')
Dashboard | WaSportsrun
@endsection

@section('content')

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
        <div id="user-medal"></div>
      </div>

      <hr>

      <div class="user-history">
        <div id="user-history"></div>
      </div>

      <hr>

      <div class="user-current">

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
      var firstname = "{{$user->firstname}}"
      var lastname = "{{$user->lastname}}"
      var motto = "{{$user->motto}}"
      var gender = "{{$user->gender}}"
      var phone = "{{$user->phone}}"
      var birthday = "{{$user->birthday}}"

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
