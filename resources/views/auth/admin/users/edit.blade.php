@extends('auth.admin.dashboard', ['active' => ['parent' => 'users', 'child' => 'create']])
@section('title')
Admin | Edit User
@endsection
@section('meta')
<link rel="stylesheet" href="//cdn.quilljs.com/1.2.6/quill.snow.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/react-datetime/2.15.0/css/react-datetime.min.css">
<script>
var race = {

}
</script>
@endsection

@section('dashboard-content')
<div class="p-3">
  <h1>Edit Race</h1>
  <div id="edituserform"></div>
</div>

@endsection
