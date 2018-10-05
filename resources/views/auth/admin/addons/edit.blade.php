@extends('auth.admin.dashboard', ['active' => ['parent' => 'addons', 'child' => 'create']])
@section('title')
Admin | Edit Addons
@endsection
@section('meta')
<link rel="stylesheet" href="//cdn.quilljs.com/1.2.6/quill.snow.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/react-datetime/2.15.0/css/react-datetime.min.css">

<?php $race_arr = array();

      foreach($races as $race) {
        $race_arr[] = array('rid' => $race->rid, 'title'=> $race->title_en);
      }

      $race_json = json_encode($race_arr); ?>


<script>
var races = JSON.parse('<?= $race_json; ?>');

var descimg_1 = '[{"preview" : "{{asset("storage/uploaded/addons/".$addons->descimg_1)}}"}]';
var descimg_2 = '[{"preview" : "{{asset("storage/uploaded/addons/".$addons->descimg_2)}}"}]';
var descimg_3 = '[{"preview" : "{{asset("storage/uploaded/addons/".$addons->descimg_3)}}"}]';
var descimg_4 = '[{"preview" : "{{asset("storage/uploaded/addons/".$addons->descimg_4)}}"}]';
var descimg_5 = '[{"preview" : "{{asset("storage/uploaded/addons/".$addons->descimg_5)}}"}]';
var descimg_6 = '[{"preview" : "{{asset("storage/uploaded/addons/".$addons->descimg_6)}}"}]';

var desc_img_1 = JSON.parse(descimg_1);
var desc_img_2 = JSON.parse(descimg_2);
var desc_img_3 = JSON.parse(descimg_3);
var desc_img_4 = JSON.parse(descimg_4);
var desc_img_5 = JSON.parse(descimg_5);
var desc_img_6 = JSON.parse(descimg_6);

var addons = {
  aid: "{{$addons->aid}}",
  add_en : "{{$addons->add_en}}",
  add_ms : "{{$addons->add_ms}}",
  add_zh : "{{$addons->add_zh}}",
  addprice : "{{$addons->addprice}}",
  desc_en : "{{$addons->desc_en}}",
  desc_ms : "{{$addons->desc_ms}}",
  desc_zh : "{{$addons->desc_zh}}",
  type : "{{$addons->type}}",
  races_id : "{{$addons->races_id}}",
  descimg_1 : ("{{$addons->descimg_1}}" == '') ? "" : desc_img_1,
  descimg_2 : ("{{$addons->descimg_2}}" == '') ? "" : desc_img_2,
  descimg_3 : ("{{$addons->descimg_3}}" == '') ? "" : desc_img_3,
  descimg_4 : ("{{$addons->descimg_4}}" == '') ? "" : desc_img_4,
  descimg_5 : ("{{$addons->descimg_5}}" == '') ? "" : desc_img_5,
  descimg_6 : ("{{$addons->descimg_6}}" == '') ? "" : desc_img_6,
  toggleDrop_descimg_1 : ("{{$addons->descimg_1}}" == '') ? true : false,
  toggleDrop_descimg_2 : ("{{$addons->descimg_2}}" == '') ? true : false,
  toggleDrop_descimg_3 : ("{{$addons->descimg_3}}" == '') ? true : false,
  toggleDrop_descimg_4 : ("{{$addons->descimg_4}}" == '') ? true : false,
  toggleDrop_descimg_5 : ("{{$addons->descimg_5}}" == '') ? true : false,
  toggleDrop_descimg_6 : ("{{$addons->descimg_6}}" == '') ? true : false,
}
</script>
@endsection

@section('dashboard-content')
<div class="p-3">
  <h1>Edit Addons</h1>
  <div id="editaddonform"></div>
</div>

@endsection
