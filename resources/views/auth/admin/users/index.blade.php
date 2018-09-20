@extends('auth.admin.dashboard', ['active' => ['parent' => 'users', 'child' => null]])
@section('title')
Admin | Users
@endsection
@section('meta')

@endsection

@section('dashboard-content')

<div class="p-3">

  <div class="float-right">
      <a href="{{route('admin.users.create')}}" class="btn btn-primary">Add New</a>
  </div>

  <h1 style="font-size: 2.2rem">Users</h1>

  <hr />

  <div class="row">
    <div class="col-sm-4">
      <form action="{{route('admin.users.search')}}" method="get">
        <div class="input-group">
          <input type="search" name="search" class="form-control" placeholder="Search by">
          <select name="field" class="form-control">
            <option value="id">user id</option>
            <option value="email">email</option>
            <option value="name">name</option>
            <option value="firstname">firstname</option>
            <option value="lastname">lastname</option>
          </select>
          <span class="input-group-prepend">
            <button type="submit" class="btn btn-primary">Search</button>
          </span>
        </div>
      </form>
    </div>
  </div>

  <br />

  <table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">No.</th>
      <th scope="col">@sortablelink('user_id', 'User ID')</th>
      <th scope="col">@sortablelink('name', 'Name')</th>
      <th scope="col">@sortablelink('email', 'Email')</th>
      <th scope="col">@sortablelink('firstname', 'First Name')</th>
      <th scope="col">@sortablelink('lastname', 'Last Name')</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    <?php $i = 0; ?>
    @foreach($users as $user)
    <?php $i++ ?>
    <tr>
      <th scope="row">{{$i}}</th>
      <th scope>{{$user->user_id}}</th>
      <td>{{$user->name}}</td>
      <td>{{$user->email}}</td>
      <td>{{$user->firstname}}</td>
      <td>{{$user->lastname}}</td>
      <td>
      <div class="btn-group " role="group" aria-label="Basic example">
        <a href="{{route('admin.users.edit',['id'=>$user->user_id])}}"><button type="button" class="btn btn-info"><i class="fas fa-edit"></i></button></a>
        <form method="POST" action="{{route('admin.users.destroy',['id' => $user->user_id ])}}">
          @method('DELETE')
          @csrf
          <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
        </form>
        <!--<form method="POST" action="{{route('admin.users.edit.dupe',['id' => $user->id ])}}">
          @csrf
          <button type="submit" class="btn btn-primary"><i class="fas fa-copy"></i></button>
        </form>-->
      </div>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

{{ $users->links() }}

</div>

@endsection
