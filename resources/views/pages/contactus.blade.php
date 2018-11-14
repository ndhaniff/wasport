@extends('layouts.master')

@section('content')

<style>
.anticon-check-circle:before,
.anticon-close:before, .anticon-cross:before,
.ant-calendar-picker-icon:after,
.anticon-close-circle:before, .anticon-cross-circle:before,
.anticon:before, svg:not(:root) { display: none; }

@media screen and (max-width: 414px) {
  .ant-form-item-control,
  .ant-form {
    width: 300px;
  }
}

@media screen and (max-width: 320px) {
  .ant-form-item-control,
  .ant-form {
    width: 280px;
  }
}
</style>

<div id="contactus">
  <div class="container">
    <h2 class="mb-5">{{__("CONTACT US")}}</h2>

    <p>{{__("Thank you for your love and support of the Wasports run, we will do our best to respond to any questions or concerns in a timely fashion!")}}</p>

    <p>WA SPORTS (002870275-A) <br />
    {{__("Address")}}: 860-B Lorong 8 kg baru aulong, Taiping, 34000 Perak, Malaysia. <br />
    {{__("Email")}}: clement@wasportsrun.com <br />
    {{__("Tel")}}: 016-637 8026</p>

    <?php if(app()->getLocale() == 'en')
            echo '<div id="contactform-en"></div>';
          if(app()->getLocale() == 'ms')
            echo '<div id="contactform-ms"></div>';
          if(app()->getLocale() == 'zh')
            echo '<div id="contactform-zh"></div>'; ?>

  </div>
</div>

@endsection

@section('script')
@if (Auth::check())
  <script>
    var user = {
      name: "{{$user->name}}",
      email: "{{$user->email}}",
      phone: "{{$user->phone}}"
    }
  </script>
@else
<script>
  var user = {
    name: "",
    email: "",
    phone: "",
  }
</script>
@endif
@endsection
