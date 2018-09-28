@extends('auth.admin.dashboard', ['active' => ['parent' => 'users', 'child' => 'edit']])
@section('title')
Admin | Edit User
@endsection
@section('meta')
<link rel="stylesheet" href="//cdn.quilljs.com/1.2.6/quill.snow.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/react-datetime/2.15.0/css/react-datetime.min.css">

<script>
var user = {
  id: "{{$user->id}}",
  name: "{{$user->name}}",
  email: "{{$user->email}}",
  firstname: "{{$user->firstname}}",
  lastname: "{{$user->lastname}}",
  motto: "{{$user->motto}}",
  phone: "{{substr($user->phone, 3)}}",
  gender: "{{$user->gender}}",
  add_fl: "{{$user->add_fl}}",
  add_sl: "{{$user->add_sl}}",
  city: "{{$user->city}}",
  state: "{{$user->state}}",
  postal: "{{$user->postal}}",
  profileimg: ("{{$user->profileimg}}" === '') ? "{{asset('img/noimage.png')}}" : "{{asset('storage/uploaded/users/'.$user->profileimg)}}"
}
</script>
@endsection

@section('dashboard-content')
<div class="p-3">
  <h1>Edit User</h1>
  <div id="edituserform"></div>
</div>
@endsection
