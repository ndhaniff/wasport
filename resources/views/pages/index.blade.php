<?php $title = __("Home"); ?>

@extends('layouts.master')

@section('content')

<!--<header id="homebanner">
  <img src="/img/wasport_homebanner.jpg" width="100%" style="visibility: hidden;" />-->
<!--<header id="homebanner"></header>-->

<!--<header id="banner">
  <img src="{{asset('img/wasport-banner.jpg')}}" alt="">
</header>-->

<fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
</fb:login-button>

<div id="status">
</div>

<header>
  <div id="carousel" class="owl-carousel owl-theme">
    <div class="item">
      <img src="{{ asset('img/banner-01.jpg') }}"/>
    </div>
    <div class="item">
      <img src="{{ asset('img/banner-02.jpg') }}"/>
    </div>
    <div class="item">
      <img src="{{ asset('img/banner-03.jpg') }}"/>
    </div>
    <div class="item">
      <img src="{{ asset('img/banner-04.jpg') }}"/>
    </div>
  </div>
</header>

<div id="home-signup-section">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-6">
        <p>{{__("SIGN UP AS OUR MEMBER FOR FREE!")}}</p>
      </div>
      <div class="col-sm-12 col-md-6">
        <a href="{{ route('register') }}"><button id="home-signup-btn">{{__("SIGN UP NOW")}}</button></a>
      </div>
    </div>
  </div>
</div>

<div class="home-how container-fluid p-5 bg-gray">
  <div class="container">
    <div class="howitworks">
      <h2>{{__("HOW IT WORKS?")}}</h2>

      <div class="howitworks-desktop">
        <div class="line"></div>
        <div class="row">
          <div class="col-sm-12 col-md-3">
            <h3 class="one">{{__("Login/ Register")}}</h3>
            <p>{{__("If you are an existing UVR member, log in to continue. If not, you may register to become a member: it's totally free!")}}</p>
          </div>
          <div class="col-sm-12 col-md-3">
            <h3 class="two">{{__("Enter a race")}}</h3>
            <p>{{__("Select a race you like and fill in the registration form. Remember to select your correct T-shirt size and shipping zone.")}}</p>
          </div>
          <div class="col-sm-12 col-md-3">
            <h3 class="three">{{__("Make Payment")}}</h3>
            <p>{{__("Proceed to payment. Once done, check your email for the confirmation email and e-bib.")}}</p>
          </div>
          <div class="col-sm-12 col-md-3">
            <h3 class="four">{{__("Complete the race")}}</h3>
            <p>{{__("Run the race during the running period and submit your result. If you have completed the challenge fully, your reward kit will be sent to you after the running period is over.")}}</p>
          </div>
        </div>
      </div>
    </div>

    <div class="howitworks-mobile">
      <div class="row">
        <div class="col-sm-12">
          <h3 class="one"><img src="{{asset('img/flag1.png')}}" alt=""> {{__("Login/ Register")}}</h3>
          <p>{{__("If you are an existing UVR member, log in to continue. If not, you may register to become a member: it's totally free!")}}</p>
        </div>
        <div class="col-sm-12">
          <h3 class="two"><img src="{{asset('img/flag2.png')}}" alt=""> {{__("Enter a race")}}</h3>
          <p>{{__("Select a race you like and fill in the registration form. Remember to select your correct T-shirt size and shipping zone.")}}</p>
        </div>
        <div class="col-sm-12">
          <h3 class="three"><img src="{{asset('img/flag3.png')}}" alt=""> {{__("Make Payment")}}</h3>
          <p>{{__("Proceed to payment. Once done, check your email for the confirmation email and e-bib.")}}</p>
        </div>
        <div class="col-sm-12">
          <h3 class="four"><img src="{{asset('img/flag4.png')}}" alt=""> {{__("Complete the race")}}</h3>
          <p>{{__("Run the race during the running period and submit your result. If you have completed the challenge fully, your reward kit will be sent to you after the running period is over.")}}</p>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="home container-fluid p-5">

  <div class="home-race raceslisting container mb-5">
    <div class="row">
      <div class="col-sm-0 col-md-2"></div>

      <div class="col-sm-12 col-md-4">
        <h2>{{__("NEW RACE")}}</h2>

        <a href="racedetails/{{ $new->id }}">
          <div class="race-box">
            <div class="race-img">
              <img src=" <?php echo asset('storage/uploaded/races/' . $new->header) ?>" alt="{{ $new->title_en }}">
            </div>

            <div class="race-caption">
              <?php if(app()->getLocale() == 'en')
                      echo '<h5>' .$new->title_en. '</h5>';
                    if(app()->getLocale() == 'ms')
                      echo '<h5>' .$new->title_ms. '</h5>';
                    if(app()->getLocale() == 'zh')
                      echo '<h5>' .$new->title_zh. '</h5>'; ?>

              <hr>

              <div class="raceslisting-date">
                <?php $dateF = DateTime::createFromFormat('Y-m-d H:i a', $new->date_from);

                      $dateT = DateTime::createFromFormat('Y-m-d H:i a', $new->date_to);

                      $formatdateF = $dateF->format('d M Y (H:ia)');

                      $formatdateT = $dateT->format('d M Y (H:ia)');

                      echo $formatdateF . ' GMT +08' . '<br>-<br>' . $formatdateT . ' GMT +08' ?>
              </div>
            </div>
          </div>
        </a>
      </div>

      <div class="col-sm-12 col-md-4">
        <h2>{{__("PAST RACE")}}</h2>

        <a href="racedetails/{{ $new->id }}">
          <div class="race-box">
            <div class="race-img">
              <img src=" <?php echo asset('storage/uploaded/races/' . $old->header) ?>" alt="{{ $old->title_en }}">
            </div>

            <div class="race-caption">
              <?php if(app()->getLocale() == 'en')
                      echo '<h5>' .$old->title_en. '</h5>';
                    if(app()->getLocale() == 'ms')
                      echo '<h5>' .$old->title_ms. '</h5>';
                    if(app()->getLocale() == 'zh')
                      echo '<h5>' .$old->title_zh. '</h5>'; ?>

              <hr>

              <div class="raceslisting-date">
                <?php $dateF = DateTime::createFromFormat('Y-m-d H:i a', $old->date_from);

                      $dateT = DateTime::createFromFormat('Y-m-d H:i a', $old->date_to);

                      $formatdateF = $dateF->format('d M Y (H:ia)');

                      $formatdateT = $dateT->format('d M Y (H:ia)');

                      echo $formatdateF . ' GMT +08' . '<br>-<br>' . $formatdateT . ' GMT +08' ?>
              </div>
            </div>
          </div>
        </a>
      </div>

      <div class="col-sm-0 col-md-2"></div>
    </div>
  </div>

  <div class="rewarding-experience mb-5">
    <div class="container">
    <h2>{{__("Rewarding experience")}}</h2>
    <p>{{__("Be the envy of your friends with our exciting medals! Share the joy of earning medals with them and create new memories together.")}}</p> <br>
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
    <h2>{{__("Connect with our online and offline community")}}</h2>

    <div class="home-join-desktop">
      <div class="row">
        <div class="col-md-10">
          <p>{{__("8976225 runners have joined WaSport. Join our diverse community of runners, from first-time runners to elite marathon finishers - from all over the world!")}}</p><br>
        </div>
        <div class="col-md-2">
          <a class="wbtn btn btn-primary" href="#">{{__("Join Now")}}</a>
        </div>
      </div>
    </div>

    <div class="home-join-mobile">
      <div class="row">
        <div class="col-sm-12">
          <p>{{__("8976225 runners have joined WaSport. Join our diverse community of runners, from first-time runners to elite marathon finishers - from all over the world!")}}</p><br>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <a class="wbtn btn btn-primary" href="#">{{__("Join Now")}}</a>
        </div>
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
