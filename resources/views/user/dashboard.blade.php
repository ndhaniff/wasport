@extends('layouts.master')

@section('content')
<div class="container p-5">
  <div class="row">
    <aside class="col-md-3">
      <div class="side card">
        <img src="http://via.placeholder.com/250x250" width="100%" alt="">
        <div class="details text-center">
        <span>{{'@'.$user->name}}</span><br>
        <span>Joined {{$user->created_at->diffForHumans()}}</span>
        </div>
      </div>
    </aside>
    <div class="col-md-9">
      <div class="content card p-3">
        <div class="text-center">STATS</div>
        <hr>
        <div class="stats text-center p-3 row">
          <div class="col-md-4">
            <h3>0</h3>
            Distance (km)
          </div>
          <div class="col-md-4">
            <h3>0</h3>
            Pace
          </div>
          <div class="col-md-4">
            <h3>0</h3>
            No. of runs
          </div>
        </div>
        <hr>
        <div class="">
          <div class=" text-center">MY MEDAL</div><hr>
          <br><br><br>
        </div>
        <hr>
        <div class="">
          <div class=" text-center">JOINED RACE</div><hr>
          <br><br><br>
        </div>
      </div>
    </div>
    </div>
</div>
@endsection