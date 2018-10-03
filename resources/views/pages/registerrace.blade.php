@extends('layouts.master')

@section('content')

<style>

</style>

<div id="registerrace">
  <div class="container">

    <?php if(app()->getLocale() == 'en')
            echo '<div id="registerraceform-en"></div>';
          if(app()->getLocale() == 'ms')
            echo '<div id="registerraceform-ms"></div>';
          if(app()->getLocale() == 'zh')
            echo '<div id="registerraceform-zh"></div>'; ?>

  </div>
</div>

@endsection

@section('script')
@if (Auth::check())
  <script>
    var user = {
      id: "{{$user->id}}",
      firstname: "{{$user->firstname}}",
      lastname: "{{$user->lastname}}",
      phone: "{{$user->phone}}",
      gender: "{{$user->gender}}",
      birthday: "{{$user->birthday}}",
      add_fl: "{{$user->add_fl}}",
      add_sl: "{{$user->add_sl}}",
      city: "{{$user->city}}",
      state: "{{$user->state}}",
      postal: "{{$user->postal}}"
    }
  </script>
@else
<script>
  var user = {
    id: "",
    firstname: "",
    lastname: "",
    phone: "",
    gender: "",
    birthday: "",
    add_fl: "",
    add_sl: "",
    city: "",
    state: "",
    postal: ""
  }
</script>
@endif
@endsection
