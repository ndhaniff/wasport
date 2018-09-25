@extends('layouts.master')

@section('content')

@include('pages.header-banner')

<div id="howitoperate">
  <div class="related">
    <div class="container">
      <h2 class="mb-5">{{__("Related Cooperation")}}</h2>

      <div class="related-desc">
        {{__("This is the way to contact us immediately")}}
      </div>

      <div class="row">
        <div class="col-sm-12 col-md-4">
          <h5>{{__("Working Hours")}}</h5>
          <p>{{__("Monday - Friday (9:00am - 6:00pm)")}}</p>

          <h5>{{__("Contact Number")}}</h5>
          <p>016xxx5268</p>
        </div>
        <div class="col-sm-12 col-md-4">
          <h5>{{__("Email")}}</h5>
          <p>info@wasport.com.my</p>
        </div>
        <div class="col-sm-12 col-md-4">
          <h5>WhatsApp</h5>
          <img src="{{asset('img/qr-code.png')}}">
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
