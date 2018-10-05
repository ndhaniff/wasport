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
  time_to : "{{$race->time_to}}",
  time_from : "{{$race->time_from}}",
  deadtime_to : "{{$race->deadtime_to}}",
  deadtime_from : "{{$race->deadtime_from}}",
  header : ("{{$race->header}}" == 'noimage.png') ? "{{asset('img/noimage.png')}}" : "{{asset('storage/uploaded/races/'.$race->header)}}",
  awardimg_1 : ("{{$race->awardimg_1}}" == '') ? "{{asset('img/noimage.png')}}" : "{{asset('storage/uploaded/awards/'.$race->awardimg_1)}}",
  awardimg_2 : ("{{$race->awardimg_2}}" == '') ? "{{asset('img/noimage.png')}}" : "{{asset('storage/uploaded/awards/'.$race->awardimg_2)}}",
  awardimg_3 : ("{{$race->awardimg_3}}" == '') ? "{{asset('img/noimage.png')}}" : "{{asset('storage/uploaded/awards/'.$race->awardimg_3)}}",
  awardimg_4 : ("{{$race->awardimg_4}}" == '') ? "{{asset('img/noimage.png')}}" : "{{asset('storage/uploaded/awards/'.$race->awardimg_4)}}",
  awardimg_5 : ("{{$race->awardimg_5}}" == '') ? "{{asset('img/noimage.png')}}" : "{{asset('storage/uploaded/awards/'.$race->awardimg_5)}}",
  awardimg_6 : ("{{$race->awardimg_6}}" == '') ? "{{asset('img/noimage.png')}}" : "{{asset('storage/uploaded/awards/'.$race->awardimg_6)}}",
  medalimg_1 : ("{{$race->medalimg_1}}" == '') ? "{{asset('img/noimage.png')}}" : "{{asset('storage/uploaded/medals/'.$race->medalimg_1)}}",
  medalimg_2 : ("{{$race->medalimg_2}}" == '') ? "{{asset('img/noimage.png')}}" : "{{asset('storage/uploaded/medals/'.$race->medalimg_2)}}",
  medalimg_3 : ("{{$race->medalimg_3}}" == '') ? "{{asset('img/noimage.png')}}" : "{{asset('storage/uploaded/medals/'.$race->medalimg_3)}}",
  medalimg_4 : ("{{$race->medalimg_4}}" == '') ? "{{asset('img/noimage.png')}}" : "{{asset('storage/uploaded/medals/'.$race->medalimg_4)}}",
  medalimg_5 : ("{{$race->medalimg_5}}" == '') ? "{{asset('img/noimage.png')}}" : "{{asset('storage/uploaded/medals/'.$race->medalimg_5)}}",
  medalimg_6 : ("{{$race->medalimg_6}}" == '') ? "{{asset('img/noimage.png')}}" : "{{asset('storage/uploaded/medals/'.$race->medalimg_6)}}",
}
</script>
@endsection

@section('dashboard-content')
<div class="p-3">
  <h1>Edit Race</h1>
  <div id="editraceform"></div>
</div>

@endsection
