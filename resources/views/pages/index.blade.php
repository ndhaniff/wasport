@extends('layouts.master')

@section('content')


<header id="homebanner">
  <img src="/img/wasport_homebanner.jpg" width="100%" style="visibility: hidden;" />
</header>
<div class="container-fluid bg-gray p-5">
  <div class="howitworks container">
    <h2>{{__("HOW IT WORKS?")}}</h2>
    <div class="line"></div>
    <div class="row">
      <div class="col-sm-3">
        <h3 class="one">{{__("Login/ Register")}}</h3>
        <p>{{__("If you are an existing UVR member, log in to continue. If not, you may register to become a member: it's totally free!")}}</p>
      </div>
      <div class="col-sm-3">
        <h3 class="two">{{__("Enter a race")}}</h3>
        <p>{{__("Select a race you like and fill in the registration form. Remember to select your correct T-shirt size and shipping zone.")}}</p>
      </div>
      <div class="col-sm-3">
        <h3 class="three">{{__("Make Payment")}}</h3>
        <p>{{__("Proceed to payment. Once done, check your email for the confirmation email and e-bib.")}}</p>
      </div>
      <div class="col-sm-3">
        <h3 class="four">{{__("Complete the race")}}</h3>
        <p>{{__("Run the race during the running period and submit your result. If you have completed the challenge fully, your reward kit will be sent to you after the running period is over.")}}</p>
      </div>
    </div>
  </div>

  <div class="rewarding-experience mb-5">
    <div class="container">
    <h2>Rewarding experience</h2>
    <p>Be the envy of your friends with our exciting medals! Share the joy of earning medals with them and create new memories together.</p> <br>
    <div class="row">
      <div class="col">
        <img width="100%" src="{{asset('img/medal1.jpg')}}" alt="">
      </div>
      <div class="col">
        <img width="100%" src="{{asset('img/medal2.jpg')}}" alt="">
      </div>
      <div class="col">
        <img width="100%" src="{{asset('img/medal3.jpg')}}" alt="">
      </div>
    </div>
    </div>
  </div>

  <div class="connect-community">
    <div class="container">
    <h2>Connect with our online and offline community</h2>
    <div class="row">
      <div class="col-sm-10">
        <p>8976225 runners have joined WaSport. Join our diverse community of runners, from first-time runners to elite marathon finishers - from all over the world!</p><br>
      </div>
      <div class="col-sm-2">
        <a class="wbtn btn btn-primary" href="#">Join Now</a>
      </div>
    </div>
    <!-- Gallery -->
    <div class="gallery row">
      <div class="col-sm-6">
        <img width="100%" src="{{asset('img/community1.jpg')}}" alt="">
      </div>
      <div class="col-sm-6">
        <div class="row mb-5">
          <div class="col-sm-5">
            <img width="100%" src="{{asset('img/community2.jpg')}}" alt="">
          </div>
          <div class="col">
            <img width="100%" src="{{asset('img/community4.jpg')}}" alt="">
          </div>
        </div>
        <div class="row">
          <div class="col">
            <img width="100%" src="{{asset('img/community5.jpg')}}" alt="">
          </div>
          <div class="col-sm-5">
            <img width="100%" src="{{asset('img/community3.jpg')}}" alt="">
          </div>
        </div>
      </div>
    </div>
    </div>
  </div>
</div>

@endsection
