@extends('layouts.master')

@section('content')

<div id="registersuccess" class="mt-5">
  <div class="container">

    <div class="register-success-box">
      <h3>Your account has been successfully registered. <br />Thank you for joining WaSports.</h3>
      <br />
      <button id="click-login-btn" onclick="window.location.href='/login'">Click here to login</button>
    </div>

  </div>
</div>

@endsection
