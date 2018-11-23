@extends('layouts.master')

@section('content')

<style>
.tabs {
  display: block;
  display: -webkit-flex;
  display: -moz-flex;
  display: flex;
  -webkit-flex-wrap: wrap;
  -moz-flex-wrap: wrap;
  flex-wrap: wrap;
  margin: 0;
  overflow: hidden; }
  .tabs [class^="tab"] label,
  .tabs [class*=" tab"] label {
    color: #000;
    cursor: pointer;
    display: block;
    font-size: 1.1em;
    font-weight: 300;
    line-height: 1em;
    padding: 2rem 0 .5rem 0px;
    text-align: center; }
  .tabs [class^="tab"] [type="radio"],
  .tabs [class*=" tab"] [type="radio"] {
    border-bottom: 1px solid rgba(239, 237, 239, 0.5);
    cursor: pointer;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    display: block;
    width: 100%;
    -webkit-transition: all 0.3s ease-in-out;
    -moz-transition: all 0.3s ease-in-out;
    -o-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out; }
    .tabs [class^="tab"] [type="radio"]:hover, .tabs [class^="tab"] [type="radio"]:focus,
    .tabs [class*=" tab"] [type="radio"]:hover,
    .tabs [class*=" tab"] [type="radio"]:focus {
      border-bottom: 1px solid #fd264f; }
    .tabs [class^="tab"] [type="radio"]:checked,
    .tabs [class*=" tab"] [type="radio"]:checked {
      border-bottom: 2px solid #fd264f; }
    .tabs [class^="tab"] [type="radio"]:checked + div,
    .tabs [class*=" tab"] [type="radio"]:checked + div {
      opacity: 1; }
    .tabs [class^="tab"] [type="radio"] + div,
    .tabs [class*=" tab"] [type="radio"] + div {
      display: block;
      opacity: 0;
      padding: 2rem 0;
      width: 90%;
      -webkit-transition: all 0.3s ease-in-out;
      -moz-transition: all 0.3s ease-in-out;
      -o-transition: all 0.3s ease-in-out;
      transition: all 0.3s ease-in-out; }
  .tabs .tab-2 {
    width: 50%; }
    .tabs .tab-2 [type="radio"] + div {
      width: 200%;
      margin-left: 200%; }
    .tabs .tab-2 [type="radio"]:checked + div {
      margin-left: 0; }
    .tabs .tab-2:last-child [type="radio"] + div {
      margin-left: 100%; }
    .tabs .tab-2:last-child [type="radio"]:checked + div {
      margin-left: -100%; }
    svg:not(:root), .anticon:before { display: none; }

@media screen and (max-width: 414px) {
  #user-medal-frame .col-md-4 { width: 50%; }

  #user-medal-frame .ant-btn { height: 175px; }

  .medaldash #medal-msg { padding-bottom: 1.5rem; }
}

@media screen and (max-width: 375px) {
  #user-medal-frame .ant-btn { height: 160px; }
}

@media screen and (max-width: 320px) {
  #user-medal-frame .ant-btn { height: 135px; }
}
</style>

<?php
  $allmedal_arr = array();
  $check_arr = array();
  $mymedal = 'false';

  date_default_timezone_set("Asia/Kuala_Lumpur");
  $date = date('Y-m-d H:i a');

  foreach($usermedals as $medal) {
    $mymedal = 'true';
    $allmedal_arr[] = array('mid' => $medal->mid,
                              'rid' => $medal->rid,
                              'title_en' => $medal->title_en,
                              'title_ms' => $medal->title_ms,
                              'title_zh' => $medal->title_zh,
                              'medal_status' => 'true',
                              'medal_message' => 'Joined',
                              'medal_color' => asset('storage/uploaded/medals/color/' . $medal->medal_color));
    array_push($check_arr, $medal->title_en);
  }

  foreach($joinedmedals as $medal) {
    if(in_array($medal->title_en, $check_arr)){

    } else {
      $allmedal_arr[] = array('mid' => $medal->mid,
                          'rid' => $medal->rid,
                          'title_en' => $medal->title_en,
                          'title_ms' => $medal->title_ms,
                          'title_zh' => $medal->title_zh,
                          'medal_status' => 'false',
                          'medal_message' => 'Joined',
                          'medal_grey' => asset('storage/uploaded/medals/grey/' . $medal->medal_grey));
      array_push($check_arr, $medal->title_en);
    }
  }

  foreach($allmedals as $medal) {
    if(in_array($medal->title_en, $check_arr)){

    } else {
      $deadTimeTo = $medal->dead_to .' '. $medal->deadtime_to;

      if($deadTimeTo > $date) {
        $allmedal_arr[] = array('mid' => $medal->mid,
                                'rid' => $medal->rid,
                                'title_en' => $medal->title_en,
                                'title_ms' => $medal->title_ms,
                                'title_zh' => $medal->title_zh,
                                'medal_status' => 'false',
                                'medal_message' => 'Open',
                                'medal_grey' => asset('storage/uploaded/medals/grey/' . $medal->medal_grey));
      } else {
        $allmedal_arr[] = array('mid' => $medal->mid,
                              'rid' => $medal->rid,
                              'title_en' => $medal->title_en,
                              'title_ms' => $medal->title_ms,
                              'title_zh' => $medal->title_zh,
                              'medal_status' => 'false',
                              'medal_message' => 'Closed',
                              'medal_grey' => asset('storage/uploaded/medals/grey/' . $medal->medal_grey));
      }
    }
  }

  $allmedal_json = json_encode($allmedal_arr); ?>

  <script>
    var medal = JSON.parse('<?= $allmedal_json; ?>');
  </script>

  <div class="medaldash p-5">
    <div class="container">

      <div class="medal-block">

        <div class="tabs">
          <div class="tab-2">
            <label for="tab2-1">{{__("All Medals")}}</label>
            <input id="tab2-1" name="tabs-two" type="radio" checked="checked">

            <div>
              <div id="user-medal-frame">
                <?php if(app()->getLocale() == 'en')
                        echo '<div id="allmedals-en"></div>';
                      if(app()->getLocale() == 'ms')
                        echo '<div id="allmedals-ms"></div>';
                      if(app()->getLocale() == 'zh')
                        echo '<div id="allmedals-zh"></div>'; ?>
              </div>
            </div>
          </div>

          <div class="tab-2">
            <label for="tab2-2">{{__("My Medals")}}</label>
            <input id="tab2-2" name="tabs-two" type="radio">

            <div>
              <?php if($mymedal == 'false') {
                      echo '<center><span>';
                      echo __("NO MEDALS");
                      echo '</span></center>';
                    } else {
                      echo '<div id="user-medal-frame">';
                      if(app()->getLocale() == 'en')
                        echo '<div id="mymedals-en"></div>';
                      if(app()->getLocale() == 'ms')
                        echo '<div id="mymedals-ms"></div>';
                      if(app()->getLocale() == 'zh')
                        echo '<div id="mymedals-zh"></div>';
                      echo '</div>';
                    }?>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

<script>

</script>


@endsection
