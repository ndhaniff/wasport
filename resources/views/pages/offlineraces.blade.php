@extends('layouts.master')

@section('content')

<?php date_default_timezone_set("Asia/Kuala_Lumpur");
      $date = date('Y-m-j');

      $offline_arr = array();
      foreach($offlines as $offline) {
        if($offline->date >= $date) {
          $race_status = 'current';
        }
        if($offline->date < $date) {
          $race_status = 'past';
        }
        $eventdate = DateTime::createFromFormat('Y-m-j', $offline->date)->format('j M y');
        $dateitem = explode(" ", $eventdate);
        $eventday = $dateitem[0];
        $eventmonth = $dateitem[1];
        $eventyear = $dateitem[2];

        $offline_arr[] =array('fid' => $offline->fid,
                              'title_en' => $offline->title_en,
                              'title_ms' => $offline->title_ms,
                              'title_zh' => $offline->title_zh,
                              'day' => $eventday,
                              'month' => $eventmonth,
                              'year' => $eventyear,
                              'category' => $offline->category,
                              'location' => $offline->location,
                              'state' => $offline->state,
                              'race_status' => $race_status);
      }
      $offline_json = json_encode($offline_arr); ?>

<script>
var offline = JSON.parse('<?= $offline_json; ?>');
</script>

<div class="offline p-5">
  <div class="container">
    <h2>{{__("Offline Races")}}</h2>

    <?php if(app()->getLocale() == 'en')
            echo '<div id="offline-en"></div>';
          if(app()->getLocale() == 'ms')
            echo '<div id="offline-ms"></div>';
          if(app()->getLocale() == 'zh')
            echo '<div id="offline-zh"></div>'; ?>
  </div>
</div>
@endsection
