@extends('auth.admin.dashboard', ['active' => ['parent' => 'addons', 'child' => null]])
@section('title')
Admin | Addons
@endsection
@section('meta')

@endsection

@section('dashboard-content')
<?php $i=1 ?>
<div class="p-3">
  <div class="float-right">
      <a href="{{url('laravel-crud-search-sort/create')}}" class="btn btn-primary">Add New</a>
  </div>

  <h1 style="font-size: 2.2rem">Addons</h1>

  <hr />

  <div class="row">
    <div class="col-sm-4">
      <form action="{{route('admin.addons.search')}}" method="get">
        <div class="input-group">
          <input type="search" name="search" class="form-control" placeholder="Search addon title">
          <span class="input-group-prepend">
            <button type="submit" class="btn btn-primary">Search</button>
          </span>
        </div>
      </form>
    </div>

    <div class="col-sm-4">
      <form action="{{route('admin.addons.searchRace')}}" method="get">
        <div class="input-group">
          <select name="raceitem">
            <option value=”” disabled selected>Search race</option>
            @foreach($alladdons as $alladdon)
              <?php foreach($races as $race) {
                if($alladdon->races_id == $race->id)
                  echo "<option value='" .$alladdon->races_id. "'>" .$race->title_en. "</option>";
                } ?>
            @endforeach
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
      <th scope="col">@sortablelink('add_en', 'Title')</th>
      <th scope="col">Type</th>
      <th scope="col">Races</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    @foreach($addons as $addon)
    <tr>
      <th scope="row">{{$i++ .'.'}}</th>
      <td>{{$addon->add_en}}</td>
      <td>{{$addon->type}}</td>
      <td><?php foreach($races as $race) {
          if($addon->races_id == $race->id)
            echo $race->title_en;
        } ?></td>
      <td>
      <div class="btn-group " role="group" aria-label="Basic example">
        <a href="{{route('admin.addons.edit',['id'=>$addon->id])}}"><button type="button" class="btn btn-info"><i class="far fa-edit"></i></button></a>
        <form method="POST" action="{{route('admin.addons.destroy',['id' => $addon->id ])}}">
          @method('DELETE')
          @csrf
          <button type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
        </form>
        <form method="POST" action="{{route('admin.addons.edit.dupe',['id' => $addon->id ])}}">
          @csrf
          <button type="submit" class="btn btn-primary"><i class="fas fa-copy"></i></button>
        </form>
      </div>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

{{ $addons->links() }}

</div>

@endsection
