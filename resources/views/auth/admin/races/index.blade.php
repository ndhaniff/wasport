@extends('layouts.admin.master')
@section('title')
Admin | Create Race
@endsection
@section('meta')
<script>
</script>
@endsection

@section('content')

<div id="raceslist">
<table class="table">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">Title</th>
      <th scope="col">Date</th>
    </tr>
  </thead>
  <tbody>
    <tr>
    @foreach($races as $race)
      <td>{{$race->id}}</td>
      <td>{{$race->title}}</td>
      <td>{{$race->created_at}}</td>
      @endforeach
    </tr>
  </tbody>
</table>
</div>

@endsection

  
@section('scripts')

@endsection