@extends('auth.admin.dashboard', ['active' => ['parent' => 'races', 'child' => 'create']])
@section('title')
Admin | Create Race
@endsection
@section('meta')
<link rel="stylesheet" href="//cdn.quilljs.com/1.2.6/quill.snow.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/react-datetime/2.15.0/css/react-datetime.min.css">
@endsection

@section('dashboard-content')
<div class="p-3">
  <h1>Add New Race</h1>
  <div id="createraceform"></div>
</div>
@endsection
