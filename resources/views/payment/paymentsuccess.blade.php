@extends('layouts.master')

@section('content')

<div id="paymentsuccess" class="mt-5">
  <div class="container">

    <div style="text-align: center;">
      <h2>{{__("Thank You!")}}</h2>
      <h2>{{__("Your Transaction was Successful")}}</h2> <br />

      <button id="click-login-btn" onclick="window.location.href='/dashboard'">{{__("View Dashboard")}}</button>
    </div>

  </div>
</div>

@endsection
