@extends('layouts.admin.master')

@section('title')
  @yield('title')
@endsection
@section('meta')
  @yield('meta')
@endsection

@section('content')
<div id="dashboard">
  <div class="dashboard-grid">
    @include('layouts.admin.sidebar')
    <div>
      @yield('dashboard-content')
    </div>
  </div>
</div>
@endsection