@extends('auth.admin.dashboard', ['active' => ['parent' => 'races', 'child' => 'create']])
@section('title')
Admin | Edit Race
@endsection
@section('meta')
<link rel="stylesheet" href="//cdn.quilljs.com/1.2.6/quill.snow.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/react-datetime/2.15.0/css/react-datetime.min.css">
<script>
var race = {
  rid: "{{$race->rid}}",
  title_en : "{{$race->title_en}}",
  title_ms : "{{$race->title_ms}}",
  title_zh : "{{$race->title_zh}}",
  price : "{{$race->price}}",
  about_en : "{{$race->about_en}}",
  about_ms : "{{$race->about_ms}}",
  about_zh : "{{$race->about_zh}}",
  awards_en : "{{$race->awards_en}}",
  awards_ms : "{{$race->awards_ms}}",
  awards_zh : "{{$race->awards_zh}}",
  medals_en : "{{$race->medals_en}}",
  medals_ms : "{{$race->medals_ms}}",
  medals_zh : "{{$race->medals_zh}}",
  engrave : "{{$race->engrave}}",
  category : "{{$race->category}}",
  date_to : "{{$race->date_to}}",
  date_from : "{{$race->date_from}}",
  dead_to : "{{$race->dead_to}}",
  dead_from : "{{$race->dead_from}}",
  header : "{{asset('storage/uploaded/'.$race->header)}}",
}
</script>
@endsection

@section('dashboard-content')
<div class="p-3">
  <h1>Edit Race</h1>
  <div id="editraceform"></div>
</div>

@endsection
