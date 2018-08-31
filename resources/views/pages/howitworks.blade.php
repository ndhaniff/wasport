<?php $title = __("How It Works"); ?>

@extends('layouts.master')

@section('content')


<!--<header id="homebanner"></header>-->

<!--<header id="banner">
  <img src="{{asset('img/wasport-banner.jpg')}}" alt="">
</header>-->

<header>
  <div id="carousel" class="owl-carousel owl-theme">
    <div class="item">
      <img src="{{ asset('img/banner-01.jpg') }}"/>
    </div>
    <div class="item">
      <img src="{{ asset('img/banner-02.jpg') }}"/>
    </div>
  </div>
</header>

<div id="howitworks">
  <div class="container">
    <h2 class="mb-5">{{__("HOW IT WORKS")}}</h2>

    <div class="row">
      <div class="col-sm-12 col-md-4">
        <img src="{{asset('img/how-register.png')}}" alt="Register">
        <h3>Register</h3>
        <p>Find and join a virtual race that excites you!</p>
      </div>

      <div class="col-sm-12 col-md-4">
        <img src="{{asset('img/how-run.png')}}" alt="Run and record">
        <h3>Run and record</h3>
        <p>Use a GPS-based app or a treadmill to track your run.</p>
      </div>

      <div class="col-sm-12 col-md-4">
        <img src="{{asset('img/how-receive.png')}}" alt="Receive your award">
        <h3>Receive your Award</h3>
        <p>Celebrate your achievement and collect your finisher’s medal!</p>
      </div>
    </div>
  </div>
</div>

@endsection
