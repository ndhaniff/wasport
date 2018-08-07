@extends('layouts.master')

@section('content')


<header id="homebanner">
  
</header>

<div class="container-fluid bg-gray p-5">
  <div class="howitworks">
    <h2>{{__("HOW IT WORKS?")}}</h2>
    <div class="line"></div>
    <div class="row">
      <div class="col-sm-3">
        <h3>{{__("Login/ Register")}}</h3>
        <p>{{__("If you are an existing UVR member, log in to continue. If not, you may register to become a member: it's totally free!")}}</p>
      </div>
      <div class="col-sm-3">
        <h3>{{__("Enter a race")}}</h3>
        <p>{{__("Select a race you like and fill in the registration form. Remember to select your correct T-shirt size and shipping zone.")}}</p>
      </div>
      <div class="col-sm-3">
        <h3>{{__("Make Payment")}}</h3>
        <p>{{__("Proceed to payment. Once done, check your email for the confirmation email and e-bib.")}}</p>
      </div>
      <div class="col-sm-3">
        <h3>{{__("Complete the race")}}</h3>
        <p>{{__("Run the race during the running period and submit your result. If you have completed the challenge fully, your reward kit will be sent to you after the running period is over.")}}</p>
      </div>
    </div>
  </div>
</div>

@endsection
