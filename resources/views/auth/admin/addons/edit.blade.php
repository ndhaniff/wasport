@extends('auth.admin.dashboard', ['active' => ['parent' => 'addons', 'child' => 'create']])
@section('title')
Admin | Create Addons
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
}
</script>
@endsection

@section('dashboard-content')
<div class="p-3">
  <h1>Edit Addons</h1>
  <div id="editaddonform"></div>
</div>

@endsection
