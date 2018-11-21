@extends('layouts.master')

@section('content')

<div id="registersuccess" class="mt-5">
  <div class="container">

    <div class="register-success-box">
      <h3>{{__("Your account has been successfully registered.")}}<br />{{__("Thank you for joining WaSports.")}}</h3>
      <br />
      <button id="click-login-btn" onclick="window.location.href='/login'">{{__("Click here to login")}}</button>
    </div>

  </div>
</div>

@endsection
