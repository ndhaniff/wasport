@extends('auth.admin.dashboard', ['active' => ['parent' => 'addons', 'child' => 'create']])
@section('title')
Admin | Create Addons
@endsection
@section('meta')
<link rel="stylesheet" href="//cdn.quilljs.com/1.2.6/quill.snow.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/react-datetime/2.15.0/css/react-datetime.min.css">
@endsection

@section('dashboard-content')
<div class="p-3">
  <h1>Add New Addons</h1>
  <div id="createaddonsform"></div>
</div>

@endsection
