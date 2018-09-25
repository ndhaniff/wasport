@extends('layouts.master')

@section('content')

@include('pages.header-banner')

<div id="howitoperate">
  <div id="aboutus">
    <div class="container">
      <h2 class="mb-5">{{__("About Us")}}</h2>

      <p>{{__("Wasports run is a sports organization founded by a group of enthusiastic runners to promote. We aim to promote the importance of sports to health by organizing more online and offline events. We hope to encourage and motivate more people in running and develop an exercise habit to enhance a healthy lifestyle.")}}</p>

      <h4>{{__("Join us and inspire others")}}</h4>

      <p>{{__("Virtual Running is an activity that does not require getting up early, you may run with your own pace at anytime anywhere, you set your own route and time it yourself. Let runners gain motivation by collecting interesting medals, we run for medals, for good health and great accomplishment")}}</p>

    </div>
  </div>
</div>

@endsection
