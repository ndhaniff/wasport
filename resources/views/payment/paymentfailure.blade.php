@extends('layouts.master')

@section('content')

<div id="paymentfailure" class="mt-5">
  <div class="container">

    <div style="text-align: center;">
      <h2>Unfortunately !</h2>
      <h2>Your Transaction was Declined !</h2>

      <button id="click-login-btn" onclick="window.location.href='/dashboard">View Dashboard</button>
    </div>

  </div>
</div>

@endsection
