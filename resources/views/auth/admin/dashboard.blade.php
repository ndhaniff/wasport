@extends('layouts.admin.master')

@section('title')
  @yield('title')
@endsection
@section('meta')
  @yield('meta')
@endsection
@section('content')
@php
!isset($active) ? $active = '' : $active = $active
@endphp

<div id="dashboard">
  <div class="dashboard-grid">
      @include('layouts.admin.sidebar', ['active' => $active])
    <div>
      @yield('dashboard-content')
    </div>
  </div>
</div>
@endsection
