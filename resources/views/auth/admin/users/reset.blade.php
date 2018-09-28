@extends('auth.admin.dashboard', ['active' => ['parent' => 'users', 'child' => 'edit']])
@section('title')
Admin | Reset User's Password
@endsection
@section('meta')
<link rel="stylesheet" href="//cdn.quilljs.com/1.2.6/quill.snow.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/react-datetime/2.15.0/css/react-datetime.min.css">

<script>
var user = {
  id: "{{$user->id}}",
  name: "{{$user->name}}",
  email: "{{$user->email}}",
}
</script>
@endsection

@section('dashboard-content')
<div class="p-3">
  <h1>Reset Password</h1>

  <div id="resetuserform"></div>
</div>
@endsection
