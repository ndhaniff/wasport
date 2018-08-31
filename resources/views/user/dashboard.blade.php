@extends('layouts.master')

@section('content')

  <div id ="user-dashboard"></div>

  <script>
  var email = "{{$user->email}}"
  var name = "{{$user->name}}"
  </script>

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
