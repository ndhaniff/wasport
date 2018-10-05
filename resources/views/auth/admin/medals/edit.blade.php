@extends('auth.admin.dashboard', ['active' => ['parent' => 'medals', 'child' => 'create']])
@section('title')
Admin | Edit Medal
@endsection
@section('meta')

<?php $race_arr = array();

      foreach($races as $race) {
        $race_arr[] = array('rid' => $race->rid, 'title'=> $race->title_en);
      }

      $race_json = json_encode($race_arr); ?>

<script>
var races = JSON.parse('<?= $race_json; ?>');

var medalgrey = JSON.parse('[{"preview" : "{{asset("storage/uploaded/medals/grey/".$medal->medal_grey)}}"}]');
var medalcolor = JSON.parse('[{"preview" : "{{asset("storage/uploaded/medals/color/".$medal->medal_color)}}"}]');
var b_ib = JSON.parse('[{"preview" : "{{asset("storage/uploaded/medals/bib/".$medal->bib)}}"}]');
var c_ert = JSON.parse('[{"preview" : "{{asset("storage/uploaded/medals/cert/".$medal->cert)}}"}]');

var medal = {
  mid: "{{$medal->mid}}",
  name : "{{$medal->name}}",
  medal_grey : ("{{$medal->medal_grey}}" == '') ? "" : medalgrey,
  medal_color : ("{{$medal->medal_color}}" == '') ? "" : medalcolor,
  cert : ("{{$medal->cert}}" == '') ? "" : b_ib,
  bib : ("{{$medal->bib}}" == '') ? "" : c_ert,
  toggleDrop_medalGrey : ("{{$medal->medal_grey}}" == '') ? true : false,
  toggleDrop_medalColor : ("{{$medal->medal_color}}" == '') ? true : false,
  toggleDrop_cert : ("{{$medal->cert}}" == '') ? true : false,
  toggleDrop_bib : ("{{$medal->bib}}" == '') ? true : false,
  races_id : "{{$medal->races_id}}",
}
</script>
@endsection

@section('dashboard-content')
<div class="p-3">
  <h1>Edit Medal</h1>
  <div id="editmedalform"></div>
</div>
@endsection
