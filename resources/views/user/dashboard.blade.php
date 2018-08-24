@extends('layouts.master')

@section('content')

  <div id ="user-dashboard"></div>
@endsection

@if($user->strava_access_token)
  @section('script')
  <script>
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