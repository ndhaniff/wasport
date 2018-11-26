@extends('layouts.master')

@section('content')

<div id="paymentsuccess" class="mt-5">
  <div class="container">

    <div style="text-align: center;">
      <h2>Thank You !</h2>
      <h2>Your Transaction was Successful</h2>

      <button id="click-login-btn" onclick="window.location.href='/dashboard">View Dashboard</button>
    </div>

  </div>
</div>

@endsection
