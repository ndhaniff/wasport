@extends('auth.admin.dashboard', ['active' => ['parent' => 'addons', 'child' => null]])
@section('title')
Admin | Addons
@endsection
@section('meta')

@endsection

@section('dashboard-content')
<?php $i=1 ?>
<div class="p-3">
  <h1>All Addons</h1>
  <table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">No.</th>
      <th scope="col">Addons Title</th>
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
      <td>{{$addon->title_en}}</td>
      <td>
      <div class="btn-group " role="group" aria-label="Basic example">
        <a href="{{route('admin.addons.edit',['id'=>$addon->id])}}"><button type="button" class="btn btn-info"><i class="fa fa-pencil"></i></button></a>
        <form method="POST" action="{{route('admin.addons.destroy',['id' => $addon->id ])}}">
          @method('DELETE')
          @csrf
          <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
        </form>
        <form method="POST" action="{{route('admin.addons.edit.dupe',['id' => $addon->id ])}}">
          @csrf
          <button type="submit" class="btn btn-primary"><i class="fa fa-files-o"></i></button>
        </form>
      </div>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>

@endsection
