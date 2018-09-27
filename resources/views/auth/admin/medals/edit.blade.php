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

var medal = {
  mid: "{{$medal->mid}}",
  name : "{{$medal->name}}",
  medal_grey : ("{{$medal->medal_grey}}" == 'noimage.png') ? "{{asset('img/noimage.png')}}" : "{{asset('storage/uploaded/medals/grey/'.$medal->medal_grey)}}",
  medal_color : ("{{$medal->medal_color}}" == 'noimage.png') ? "{{asset('img/noimage.png')}}" : "{{asset('storage/uploaded/medals/color/'.$medal->medal_color)}}",
  cert : ("{{$medal->cert}}" == 'noimage.png') ? "{{asset('img/noimage.png')}}" : "{{asset('storage/uploaded/cert/'.$medal->cert)}}",
  bib : ("{{$medal->bib}}" == 'noimage.png') ? "{{asset('img/noimage.png')}}" : "{{asset('storage/uploaded/bib/'.$medal->bib)}}",
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
