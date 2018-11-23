@extends('auth.admin.dashboard', ['active' => ['parent' => 'offlines', 'child' => 'create']])
@section('title')
Admin | Edit Race
@endsection
@section('meta')
<link rel="stylesheet" href="//cdn.quilljs.com/1.2.6/quill.snow.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/react-datetime/2.15.0/css/react-datetime.min.css">

<script>

var race_img1 = JSON.parse('[{"preview" : "{{asset("storage/uploaded/offlinerace/".$offline->raceimg_1)}}"}]');
var race_img2 = JSON.parse('[{"preview" : "{{asset("storage/uploaded/offlinerace/".$offline->raceimg_2)}}"}]');
var race_img3 = JSON.parse('[{"preview" : "{{asset("storage/uploaded/offlinerace/".$offline->raceimg_3)}}"}]');
var race_img4 = JSON.parse('[{"preview" : "{{asset("storage/uploaded/offlinerace/".$offline->raceimg_4)}}"}]');
var race_img5 = JSON.parse('[{"preview" : "{{asset("storage/uploaded/offlinerace/".$offline->raceimg_5)}}"}]');
var race_img6 = JSON.parse('[{"preview" : "{{asset("storage/uploaded/offlinerace/".$offline->raceimg_6)}}"}]');

var header_img = JSON.parse('[{"preview" : "{{asset("storage/uploaded/offline/".$offline->header)}}"}]');

var offline = {
  fid: "{{$offline->fid}}",
  title_en : "{{$offline->title_en}}",
  title_ms : "{{$offline->title_ms}}",
  title_zh : "{{$offline->title_zh}}",
  place : "{{$offline->location}}",
  state : "{{$offline->state}}",
  category : "{{$offline->category}}",
  website : "{{$offline->website}}",
  date : "{{$offline->date}}",
  details_en : "{{$offline->details_en}}",
  details_ms : "{{$offline->details_ms}}",
  details_zh : "{{$offline->details_zh}}",
  header : ("{{$offline->header}}" == '') ? "" : header_img,
  toggleDrop : ("{{$offline->header}}" == '') ? true : false,
  raceimg_1 : ("{{$offline->raceimg_1}}" == '') ? "" : race_img1,
  raceimg_2 : ("{{$offline->raceimg_2}}" == '') ? "" : race_img2,
  raceimg_3 : ("{{$offline->raceimg_3}}" == '') ? "" : race_img3,
  raceimg_4 : ("{{$offline->raceimg_4}}" == '') ? "" : race_img4,
  raceimg_5 : ("{{$offline->raceimg_5}}" == '') ? "" : race_img5,
  raceimg_6 : ("{{$offline->raceimg_6}}" == '') ? "" : race_img6,
  toggleDrop_raceimg_1 : ("{{$offline->raceimg_1}}" == '') ? true : false,
  toggleDrop_raceimg_2 : ("{{$offline->raceimg_2}}" == '') ? true : false,
  toggleDrop_raceimg_3 : ("{{$offline->raceimg_3}}" == '') ? true : false,
  toggleDrop_raceimg_4 : ("{{$offline->raceimg_4}}" == '') ? true : false,
  toggleDrop_raceimg_5 : ("{{$offline->raceimg_5}}" == '') ? true : false,
  toggleDrop_raceimg_6 : ("{{$offline->raceimg_6}}" == '') ? true : false,
}
</script>
@endsection

@section('dashboard-content')
<div class="p-3">
  <h1>Edit Offline Race</h1>
  <div id="editofflineform"></div>
</div>

@endsection
