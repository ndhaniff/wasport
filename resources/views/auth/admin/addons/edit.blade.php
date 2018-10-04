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
  descimg_1 : ("{{$addons->descimg_1}}" == '') ? "{{asset('img/noimage.png')}}" : "{{asset('storage/uploaded/addons/'.$addons->descimg_1)}}",
  descimg_2 : ("{{$addons->descimg_2}}" == '') ? "{{asset('img/noimage.png')}}" : "{{asset('storage/uploaded/addons/'.$addons->descimg_2)}}",
  descimg_3 : ("{{$addons->descimg_3}}" == '') ? "{{asset('img/noimage.png')}}" : "{{asset('storage/uploaded/addons/'.$addons->descimg_3)}}",
  descimg_4 : ("{{$addons->descimg_4}}" == '') ? "{{asset('img/noimage.png')}}" : "{{asset('storage/uploaded/addons/'.$addons->descimg_4)}}",
  descimg_5 : ("{{$addons->descimg_5}}" == '') ? "{{asset('img/noimage.png')}}" : "{{asset('storage/uploaded/addons/'.$addons->descimg_5)}}",
  descimg_6 : ("{{$addons->descimg_6}}" == '') ? "{{asset('img/noimage.png')}}" : "{{asset('storage/uploaded/addons/'.$addons->descimg_6)}}",
}
</script>
@endsection

@section('dashboard-content')
<div class="p-3">
  <h1>Edit Addons</h1>
  <div id="editaddonform"></div>
</div>

@endsection
