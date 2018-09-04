<?php $title = __("Event"); ?>

@extends('layouts.master')

@section('content')

<!--<header id="homebanner"></header>-->

<!--<header id="banner">
  <img src="{{asset('img/wasport-banner.jpg')}}" alt="">
</header>-->

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

<center>
<div class="raceslisting mt-5 mb-5">
  <div class="container">
    <div id="new-race">
      <h2>{{__("NEW RACE")}}</h2>

      <div class="row">
        @foreach ($new as $newrace)
        <div class="col-sm-12 col-md-4">
          <a href="racedetails/{{ $newrace->id }}">
            <div class="race-box">
              <div class="race-img">
                <img src=" <?php echo asset('img/races/' . $newrace->header) ?>" alt="{{ $newrace->title_en }}">
              </div>

              <div class="race-caption">
                <?php if(app()->getLocale() == 'en')
                        echo '<h5>' .$newrace->title_en. '</h5>';
                      if(app()->getLocale() == 'ms')
                        echo '<h5>' .$newrace->title_ms. '</h5>';
                      if(app()->getLocale() == 'zh')
                        echo '<h5>' .$newrace->title_zh. '</h5>'; ?>

                <hr>

                <div class="raceslisting-date">
                  <?php $dateF = DateTime::createFromFormat('Y-m-d H:i a', $newrace->date_from);

                        $dateT = DateTime::createFromFormat('Y-m-d H:i a', $newrace->date_to);

                        $formatdateF = $dateF->format('d M Y (H:ia)');

                        $formatdateT = $dateT->format('d M Y (H:ia)');

                        echo $formatdateF . ' GMT +08' . '<br>-<br>' . $formatdateT . ' GMT +08' ?>
                </div>

              </div>
            </div>
          </a>
        </div>
        @endforeach
      </div>
    </div>

    <div id="past-race">
      <h2>{{__("PAST RACE")}}</h2>

      <div class="row">
        @foreach ($old as $oldrace)
        <div class="col-sm-12 col-md-4">
          <a href="racedetails/{{ $oldrace->id }}">
            <div class="race-box">
              <div class="race-img">
                <img src=" <?php echo asset('img/races/' . $oldrace->header) ?>" alt="{{ $newrace->title_en }}">
              </div>

              <div class="race-caption">
                <?php if(app()->getLocale() == 'en')
                        echo '<h5>' .$oldrace->title_en. '</h5>';
                      if(app()->getLocale() == 'ms')
                        echo '<h5>' .$oldrace->title_ms. '</h5>';
                      if(app()->getLocale() == 'zh')
                        echo '<h5>' .$oldrace->title_zh. '</h5>'; ?>

                <hr>

                <div class="raceslisting-date">
                  <?php $dateF = DateTime::createFromFormat('Y-m-d H:i a', $oldrace->date_from);

                        $dateT = DateTime::createFromFormat('Y-m-d H:i a', $oldrace->date_to);

                        $formatdateF = $dateF->format('d M Y (H:ia)');

                        $formatdateT = $dateT->format('d M Y (H:ia)');

                        echo $formatdateF . ' GMT +08' . '<br>-<br>' . $formatdateT . ' GMT +08' ?>
                </div>

              </div>
            </div>
          </a>
        </div>
        @endforeach
      </div>
    </div>
  </div>

</div>
</center>

@endsection
