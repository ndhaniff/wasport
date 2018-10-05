@extends('auth.admin.dashboard', ['active' => ['parent' => 'races', 'child' => 'create']])
@section('title')
Admin | Edit Race
@endsection
@section('meta')
<link rel="stylesheet" href="//cdn.quilljs.com/1.2.6/quill.snow.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/react-datetime/2.15.0/css/react-datetime.min.css">

<script>

var awardimg_1 = '[{"preview" : "{{asset("storage/uploaded/awards/".$race->awardimg_1)}}"}]';
var awardimg_2 = '[{"preview" : "{{asset("storage/uploaded/awards/".$race->awardimg_2)}}"}]';
var awardimg_3 = '[{"preview" : "{{asset("storage/uploaded/awards/".$race->awardimg_3)}}"}]';
var awardimg_4 = '[{"preview" : "{{asset("storage/uploaded/awards/".$race->awardimg_4)}}"}]';
var awardimg_5 = '[{"preview" : "{{asset("storage/uploaded/awards/".$race->awardimg_5)}}"}]';
var awardimg_6 = '[{"preview" : "{{asset("storage/uploaded/awards/".$race->awardimg_6)}}"}]';

var award_img_1 = JSON.parse(awardimg_1);
var award_img_2 = JSON.parse(awardimg_2);
var award_img_3 = JSON.parse(awardimg_3);
var award_img_4 = JSON.parse(awardimg_4);
var award_img_5 = JSON.parse(awardimg_5);
var award_img_6 = JSON.parse(awardimg_6);

var medalimg_1 = '[{"preview" : "{{asset("storage/uploaded/medals/".$race->medalimg_1)}}"}]';
var medalimg_2 = '[{"preview" : "{{asset("storage/uploaded/medals/".$race->medalimg_2)}}"}]';
var medalimg_3 = '[{"preview" : "{{asset("storage/uploaded/medals/".$race->medalimg_3)}}"}]';
var medalimg_4 = '[{"preview" : "{{asset("storage/uploaded/medals/".$race->medalimg_4)}}"}]';
var medalimg_5 = '[{"preview" : "{{asset("storage/uploaded/medals/".$race->medalimg_5)}}"}]';
var medalimg_6 = '[{"preview" : "{{asset("storage/uploaded/medals/".$race->medalimg_6)}}"}]';

var medal_img_1 = JSON.parse(medalimg_1);
var medal_img_2 = JSON.parse(medalimg_2);
var medal_img_3 = JSON.parse(medalimg_3);
var medal_img_4 = JSON.parse(medalimg_4);
var medal_img_5 = JSON.parse(medalimg_5);
var medal_img_6 = JSON.parse(medalimg_6);


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
  header : ("{{$race->header}}" == '') ? "" : "preview : {{asset('storage/uploaded/races/'.$race->header)}}",
  toggleDrop : ("{{$race->header}}" == '') ? true : false,
  awardimg_1 : ("{{$race->awardimg_1}}" == '') ? "" : award_img_1,
  awardimg_2 : ("{{$race->awardimg_2}}" == '') ? "" : award_img_2,
  awardimg_3 : ("{{$race->awardimg_3}}" == '') ? "" : award_img_3,
  awardimg_4 : ("{{$race->awardimg_4}}" == '') ? "" : award_img_4,
  awardimg_5 : ("{{$race->awardimg_5}}" == '') ? "" : award_img_5,
  awardimg_6 : ("{{$race->awardimg_6}}" == '') ? "" : award_img_6,
  toggleDrop_awardimg_1 : ("{{$race->awardimg_1}}" == '') ? true : false,
  toggleDrop_awardimg_2 : ("{{$race->awardimg_2}}" == '') ? true : false,
  toggleDrop_awardimg_3 : ("{{$race->awardimg_3}}" == '') ? true : false,
  toggleDrop_awardimg_4 : ("{{$race->awardimg_4}}" == '') ? true : false,
  toggleDrop_awardimg_5 : ("{{$race->awardimg_5}}" == '') ? true : false,
  toggleDrop_awardimg_6 : ("{{$race->awardimg_6}}" == '') ? true : false,
  medalimg_1 : ("{{$race->medalimg_1}}" == '') ? "" : medal_img_1,
  medalimg_2 : ("{{$race->medalimg_2}}" == '') ? "" : medal_img_2,
  medalimg_3 : ("{{$race->medalimg_3}}" == '') ? "" : medal_img_3,
  medalimg_4 : ("{{$race->medalimg_4}}" == '') ? "" : medal_img_4,
  medalimg_5 : ("{{$race->medalimg_5}}" == '') ? "" : medal_img_5,
  medalimg_6 : ("{{$race->medalimg_6}}" == '') ? "" : medal_img_6,
  toggleDrop_medalimg_1 : ("{{$race->medalimg_1}}" == '') ? true : false,
  toggleDrop_medalimg_2 : ("{{$race->medalimg_2}}" == '') ? true : false,
  toggleDrop_medalimg_3 : ("{{$race->medalimg_3}}" == '') ? true : false,
  toggleDrop_medalimg_4 : ("{{$race->medalimg_4}}" == '') ? true : false,
  toggleDrop_medalimg_5 : ("{{$race->medalimg_5}}" == '') ? true : false,
  toggleDrop_medalimg_6 : ("{{$race->medalimg_6}}" == '') ? true : false,

}
</script>
@endsection

@section('dashboard-content')
<div class="p-3">
  <h1>Edit Race</h1>
  <div id="editraceform"></div>
</div>

@endsection
