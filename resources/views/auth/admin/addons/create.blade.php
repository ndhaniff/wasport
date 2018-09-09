@extends('auth.admin.dashboard', ['active' => ['parent' => 'addons', 'child' => 'create']])
@section('title')
Admin | Create Addons
@endsection
@section('meta')
<link rel="stylesheet" href="//cdn.quilljs.com/1.2.6/quill.snow.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/react-datetime/2.15.0/css/react-datetime.min.css">


<?php $race_arr = array();

      foreach($races as $race) {
        $race_arr[] = array('rid' => $race->id, 'title'=> $race->title_en);
      }

      $race_json = json_encode($race_arr); ?>

<script>

  var races = JSON.parse('<?= $race_json; ?>');

  //document.write(races);

  /*for(var i=0; i<races.length; i++) {
    document.write(races[i]['title']);
  }*/
</script>

@endsection

@section('dashboard-content')
<div class="p-3">
  <h1>Add New Addons</h1>
  <div id="createaddonform"></div>
</div>

@endsection
