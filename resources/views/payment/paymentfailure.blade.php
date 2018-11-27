@extends('layouts.master')

@section('content')

<div id="paymentfailure" class="mt-5">
  <div class="container">

    <div style="text-align: center;">
      <h2>{{__("Your Transaction was not successful")}}</h2> <br />

      <button id="click-login-btn" onclick="window.location.href='/dashboard'">{{__("View Dashboard")}}</button>
    </div>

  </div>
</div>

@endsection
