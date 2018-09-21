@extends('auth.admin.dashboard', ['active' => ['parent' => 'medals', 'child' => null]])
@section('title')
Admin | Medals
@endsection
@section('meta')

@endsection

@section('dashboard-content')
<?php $i=1 ?>
<div class="p-3">
  <div class="float-right">
      <a href="{{route('admin.medals.create')}}" class="btn btn-primary">Add New</a>
  </div>

  <h1 style="font-size: 2.2rem">Medals</h1>

  <hr />

  <div class="row">
    <div class="col-sm-4">
      <form action="{{route('admin.medals.search')}}" method="get">
        <div class="input-group">
          <input type="search" name="search" class="form-control" placeholder="Search medal name">
          <span class="input-group-prepend">
            <button type="submit" class="btn btn-primary">Search</button>
          </span>
        </div>
      </form>
    </div>

    <div class="col-sm-4">
      <form action="{{route('admin.medals.filter')}}" method="get">
        <div class="input-group">
          <select name="raceitem">
            <option value=”” disabled selected>Filter race</option>
            @foreach($allmedals as $allmedal)
              <?php foreach($races as $race) {
                if($allmedal->races_id == $race->rid)
                  echo "<option value='" .$allmedal->races_id. "'>" .$race->title_en. "</option>";
                } ?>
            @endforeach
          </select>
          <span class="input-group-prepend">
            <button type="submit" class="btn btn-primary">Filter</button>
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
      <th scope="col">@sortablelink('name', 'Title')</th>
      <th scope="col">Races</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    @foreach($medals as $medal)
    <tr>
      <th scope="row">{{$i++ .'.'}}</th>
      <td>{{$medal->name}}</td>
      <td><?php foreach($races as $race) {
          if($medal->races_id == $race->rid)
            echo $race->title_en;
        } ?></td>
      <td>
      <div class="btn-group " role="group" aria-label="Basic example">
        <a href="{{route('admin.medals.edit',['mid'=>$medal->mid])}}"><button type="button" class="btn btn-info"><i class="far fa-edit"></i></button></a>
        <form method="POST" action="{{route('admin.medals.destroy',['aid' => $medal->mid ])}}">
          @method('DELETE')
          @csrf
          <button type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
        </form>
      </div>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

{{ $medals->links() }}

</div>

@endsection
