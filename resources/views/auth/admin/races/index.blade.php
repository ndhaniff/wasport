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
      <th scope="col">No.</th>
      <th scope="col">@sortablelink('title_en', 'Title')</th>
      <th scope="col">@sortablelink('date_from', 'Registration Date From')</th>
      <th scope="col">@sortablelink('date_to', 'Registration Date To')</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    <?php $i= 0; ?>
    @foreach($races as $race)
    <tr>
      <th scope="row">{{$i+1}}</th>
      <td>{{$race->title_en}}</td>
      <td><?= DateTime::createFromFormat('Y-m-d', $race->date_from)->format('d M Y'); ?></td>
      <td><?= DateTime::createFromFormat('Y-m-d', $race->date_to)->format('d M Y'); ?></td>
      <td>
      <div class="btn-group " role="group" aria-label="Basic example">
        <a href="{{route('admin.races.edit',['rid'=>$race->rid])}}"><button type="button" class="btn btn-info"><i class="far fa-edit"></i></button></a>
        <form method="POST" action="{{route('admin.races.destroy',['rid' => $race->rid ])}}">
          @method('DELETE')
          @csrf
          <button type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
        </form>
        <!--<form method="POST" action="{{route('admin.races.edit.dupe',['rid' => $race->rid ])}}">
          @csrf
          <button type="submit" class="btn btn-primary"><i class="fas fa-copy"></i></button>
        </form>-->
      </div>
      </td>
    </tr>
    <?php $i++ ?>
    @endforeach
  </tbody>
</table>

{{ $races->links() }}

</div>

@endsection
