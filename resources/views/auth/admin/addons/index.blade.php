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
      <a href="{{route('admin.addons.create')}}" class="btn btn-primary">Add New</a>
  </div>

  <h1 style="font-size: 2.2rem">Addons</h1>

  @if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
  @endif

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
      <form action="{{route('admin.addons.filter')}}" method="get">
        <div class="input-group">
          <select name="raceitem">
            <option value=”” disabled selected>Filter race</option>
            @foreach($alladdons as $alladdon)
              <?php foreach($races as $race) {
                if($alladdon->races_id == $race->rid)
                  echo "<option value='" .$alladdon->races_id. "'>" .$race->title_en. "</option>";
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
          if($addon->races_id == $race->rid)
            echo $race->title_en;
        } ?></td>
      <td>
      <div class="btn-group " role="group" aria-label="Basic example">
        <a data-toggle="modal" data-target="#addonViewer-{{$addon->aid}}" data-id="{{$addon->aid}}">
          <button type="button" class="btn btn-success"><i class="far fa-eye"></i></button>
        </a>
        <a href="{{route('admin.addons.edit',['aid'=>$addon->aid])}}">
          <button type="button" class="btn btn-info"><i class="far fa-edit"></i></button>
        </a>
        <form method="POST" action="{{route('admin.addons.destroy',['aid' => $addon->aid ])}}">
          @method('DELETE')
          @csrf
          <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
        </form>
        <!--<form method="POST" action="{{route('admin.addons.edit.dupe',['aid' => $addon->aid ])}}">
          @csrf
          <button type="submit" class="btn btn-primary"><i class="fas fa-copy"></i></button>
        </form>-->
      </div>

      <!-- The Modal -->
      <div class="modal fade" id="addonViewer-{{$addon->aid}}">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">

            <!-- Modal body -->
            <div class="modal-body">
              <button type="button" class="close" data-dismiss="modal">&times;</button>

              <table class="admin-modal-table">
                <tr>
                  <th rowspan="3">Addon</th>
                  <td>EN</td>
                  <td>{{$addon->add_en}}</td>
                </tr>
                <tr>
                  <td>MS</td>
                  <td>{{$addon->add_ms}}</td>
                </tr>
                <tr>
                  <td>ZH</td>
                  <td>{{$addon->add_zh}}</td>
                </tr>
                <tr>
                  <th colspan="2">Price</th>
                  <td>{{$addon->addprice}}</td>
                </tr>
                <tr>
                  <th colspan="2">Type</th>
                  <td>{{$addon->type}}</td>
                </tr>
                <tr>
                  <th colspan="2">Races</th>
                  <td><?php foreach($races as $race) {
                      if($addon->races_id == $race->rid)
                        echo $race->title_en;
                    } ?></td>
                </tr>
              </table>

            </div>
          </div>
        </div>
      </div>

      </td>
    </tr>
    @endforeach
  </tbody>
</table>

{{ $addons->links() }}

</div>

@endsection
