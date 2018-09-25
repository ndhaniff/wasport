<?php $title = __("How It Works"); ?>

@extends('layouts.master')

@section('content')


<!--<header id="homebanner"></header>-->

<!--<header id="banner">
  <img src="{{asset('img/wasport-banner.jpg')}}" alt="">
</header>-->

@include('pages.header-banner') 

<div id="howitworks">
  <div class="container">
    <h2 class="mb-5">{{__("HOW IT WORKS")}}</h2>

    <div class="row">
      <div class="col-sm-12 col-md-4">
        <img src="{{asset('img/how-register.png')}}" alt="Register">
        <h3>{{__("Register")}}</h3>
        <p>{{__("Find and join a virtual race that excites you!")}}</p>
      </div>

      <div class="col-sm-12 col-md-4">
        <img src="{{asset('img/how-run.png')}}" alt="Run and record">
        <h3>{{__("Run and record")}}</h3>
        <p>{{__("Use a GPS-based app or a treadmill to track your run.")}}</p>
      </div>

      <div class="col-sm-12 col-md-4">
        <img src="{{asset('img/how-receive.png')}}" alt="Receive your award">
        <h3>{{__("Receive your Award")}}</h3>
        <p>{{__("Celebrate your achievement and collect your finisher’s medal!")}}</p>
      </div>
    </div>
  </div>
</div>

@endsection
