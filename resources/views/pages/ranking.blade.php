@extends('layouts.master')

@section('content')
<style>
svg:not(:root) { display: none; }
</style>

<?php $rank_arr = array();
      foreach($orders as $order) {
      $rank_arr[] =array('oid' => $order->oid,
                          'firstname' => $order->o_firstname,
                          'lastname' => $order->o_lastname,
                          'r_gender' => $order->o_gender,
                          'r_category' => $order->race_category,
                          'pace_min' => $order->pace_min,
                          'pace_sec' => $order->pace_sec,
                          'race_id' => $order->race_id);
}
$rank_json = json_encode($rank_arr); ?>

<script>
var rank = JSON.parse('<?= $rank_json; ?>');
var category = '{{$race->category}}'

let items = category.split(',')
var firstcategory = items[0]
</script>

<div class="ranking p-5">
  <div class="container">
    <h1>Rankings</h1>
    <?php if(app()->getLocale() == 'en')
            echo '<h4>' .$race->title_en. '</h4>';
          if(app()->getLocale() == 'ms')
            echo '<h4>' .$race->title_ms. '</h4>';
          if(app()->getLocale() == 'zh')
            echo '<h4>' .$race->title_zh. '</h4>';


          $dateF = DateTime::createFromFormat('Y-m-d', $race->date_from)->format('d M Y');
          $dateT = DateTime::createFromFormat('Y-m-d', $race->date_to)->format('d M Y');

          echo '<p>' .$dateF. ' (' .$race->time_from. ') GMT +08 - ' .$dateT. ' (' .$race->time_to. ') GMT +08' . '</p>';

          if(app()->getLocale() == 'en')
            echo '<div id="ranking-en"></div>';
          if(app()->getLocale() == 'ms')
            echo '<div id="ranking-ms"></div>';
          if(app()->getLocale() == 'zh')
            echo '<div id="ranking-zh"></div>'; ?>

        </div>

  </div>
</div>

@endsection
