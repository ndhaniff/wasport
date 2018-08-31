@extends('layouts.master')

@section('content')

<center>
<div class="displayrace">
  <div class="container">

    <section>
      <img src=" <?php echo asset('img/races/' . $race->header) ?>" alt="{{ $race->title }}">
    </section>

    <h2>{{ $race->title }}</h2>

    <h6>{{$race->date_from}} to {{$race->date_to}}</h6>

    <div class="row">

    </div>
  </div>
</div>
</center>

<!--race

//countdown timer

//date

//where

//price

//registration deadline

//how

//about

//awards

//register button -->


@endsection
