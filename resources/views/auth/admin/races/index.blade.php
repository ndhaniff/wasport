@extends('auth.admin.dashboard', ['active' => ['parent' => 'races', 'child' => null]])
@section('title')
Admin | Races
@endsection
@section('meta')

@endsection

@section('dashboard-content')

<div class="p-3">

  <div class="float-right">
      <a href="{{route('admin.races.create')}}" class="btn btn-primary">Add New</a>
  </div>

  <h1 style="font-size: 2.2rem">Races</h1>

  <hr />

  <div class="row">
    <div class="col-sm-4">
      <form action="{{route('admin.races.search')}}" method="get">
        <div class="input-group">
          <input type="search" name="search" class="form-control" placeholder="Search race title">
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
      <th scope="col">id</th>
      <th scope="col">@sortablelink('title_en', 'Title')</th>
      <th scope="col">@sortablelink('date_from', 'Registration Date From')</th>
      <th scope="col">@sortablelink('date_to', 'Registration Date To')</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    @foreach($races as $race)
    <tr>
      <th scope="row">{{$race->id}}</th>
      <td>{{$race->title_en}}</td>
      <td>{{$race->date_from}}</td>
      <td>{{$race->date_to}}</td>
      <td>
      <div class="btn-group " role="group" aria-label="Basic example">
        <a href="{{route('admin.races.edit',['id'=>$race->id])}}"><button type="button" class="btn btn-info"><i class="fa fa-pencil"></i></button></a>
        <form method="POST" action="{{route('admin.races.destroy',['id' => $race->id ])}}">
          @method('DELETE')
          @csrf
          <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
        </form>
        <form method="POST" action="{{route('admin.races.edit.dupe',['id' => $race->id ])}}">
          @csrf
          <button type="submit" class="btn btn-primary"><i class="fa fa-files-o"></i></button>
        </form>
      </div>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

{{ $races->links() }}

</div>

@endsection
