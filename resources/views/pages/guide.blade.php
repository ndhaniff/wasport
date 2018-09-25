@extends('layouts.master')

@section('content')

@include('pages.header-banner') 

<div id="howitoperate">
  <div class="container">
    <h2 class="mb-5">{{__("HOW IT OPERATE?")}}</h2>

    <div class="guide-steps">
      <strong>{{__("Step 1: Logon/registration")}}</strong>
      <p>{{__("If you do not have an account yet, you are welcome to register as a member. If you are already a member, please log on to your account directly.")}}</p>
    </div>

    <div class="guide-steps">
      <strong>{{__("Step 2: Participating in a run")}}</strong>
      <p>{{__("Join an interesting and challenging run. Remember to select an outfit of the right size and a mailing area (if an outfit is purchased).")}}</p>
    </div>

    <div class="guide-steps">
      <strong>{{__("Step 3: Making payment")}}</strong>
      <p>{{__("Once a payment has been successfully made, please check your email for confirmation on your participation and the serial number.")}}</p>
    </div>

    <div class="guide-steps">
      <strong>{{__("Step 4: Running and making records")}}</strong>
      <p>{{__("Complete the run within the stipulated timeline and record your results with a GPS recording app and upload.")}}</p>
    </div>

    <div class="guide-steps">
      <strong>{{__("Step 5: Receiving the reward")}}</strong>
      <p>{{__("You will get a medal after the run.")}}</p>
    </div>
  </div>
</div>

@endsection
