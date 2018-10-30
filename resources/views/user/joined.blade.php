@extends('layouts.master')

@section('title')
Joined Races | WaSportsrun
@endsection

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

  .anticon:before, svg:not(:root) { display: none; }
</style>

<?php $current_race_arr = array();
      $past_race_arr = array();
      $allmedal_arr = array();
      date_default_timezone_set("Asia/Kuala_Lumpur");
      $date = date('Y-m-d H:i a');

      foreach($current_races as $current) {
        $submission = 'false';

        $dateTimeFrom = $current->date_from .' '. $current->time_from;
        $dateTimeTo = $current->date_to .' '. $current->time_to;

        if($dateTimeFrom <= $date && $dateTimeTo >= $date) {
          $submission = 'true';
        }

        $dateF = DateTime::createFromFormat('Y-m-d', $current->date_from)->format('d M Y');
        $dateT = DateTime::createFromFormat('Y-m-d', $current->date_to)->format('d M Y');

        $current_race_arr[] = array('submission' => $submission,
                                    'rid' => $current->rid,
                                    'title_en' => $current->title_en,
                                    'title_ms' => $current->title_ms,
                                    'title_zh' => $current->title_zh,
                                    'category'=> $current->race_category,
                                    'date' => $dateF. ' (' .$current->time_from. ') GMT +08' . ' - ' .$dateT. ' (' .$current->time_to. ') GMT +08',
                                    'header' => asset('storage/uploaded/races/' . $current->header),
                                    'race_status' => $current->race_status);
      }

      foreach($past_races as $past) {

        $dateF = DateTime::createFromFormat('Y-m-d', $past->date_from)->format('d M Y');
        $dateT = DateTime::createFromFormat('Y-m-d', $past->date_to)->format('d M Y');

        $past_race_arr[] = array('rid' => $past->rid,
                                  'title_en' => $past->title_en,
                                  'title_ms' => $past->title_ms,
                                  'title_zh' => $past->title_zh,
                                  'category'=> $past->race_category,
                                  'date' => $dateF. ' (' .$past->time_from. ') GMT +08' . ' - ' .$dateT. ' (' .$past->time_to. ') GMT +08',
                                  'header' => asset('storage/uploaded/races/' . $past->header),
                                  'race_status' => $past->race_status);
      }

      foreach($allmedals as $allmedal) {
        $allmedal_arr[] = array('races_id' => $allmedal->races_id,
                                'bib_img' => asset('storage/uploaded/bib/' . $allmedal->bib),
                                'cert_img' => asset('storage/uploaded/cert/' . $allmedal->cert));
      }
      $current_json = json_encode($current_race_arr);
      $past_json = json_encode($past_race_arr);
      $allmedal_json = json_encode($allmedal_arr); ?>

<script>
  var current = JSON.parse('<?= $current_json; ?>');
  var past = JSON.parse('<?= $past_json; ?>');
  var allmedal = JSON.parse('<?= $allmedal_json; ?>');

  var user = {
    id: "{{$user->id}}",
    name: "{{$user->name}}",
    firstname: "{{$user->firstname}}",
    lastname: "{{$user->lastname}}"
  }
</script>

  <div class="joineddash p-5">
    <div class="container">

      <div class="medal-block">

        <div class="tabs">
          <div class="tab-2">
            <label for="tab2-1">{{__("Current Races")}}</label>
            <input id="tab2-1" name="tabs-two" type="radio" checked="checked">

            <div id="joined-current">
              <?php if(!$current_races->count()) {
                      echo '<center><span>';
                      echo __("NO RACES");
                      echo '</span></center>';
                    } else {
                      if($current_races->count()) {
                        if(app()->getLocale() == 'en')
                          echo '<div id="current-joined-en"></div>';
                        if(app()->getLocale() == 'ms')
                          echo '<div id="current-joined-ms"></div>';
                        if(app()->getLocale() == 'zh')
                          echo '<div id="current-joined-zh"></div>';
                      }
                    } ?>
            </div>
          </div>

          <div class="tab-2">
            <label for="tab2-2">{{__("Past Races")}}</label>
            <input id="tab2-2" name="tabs-two" type="radio">

            <div id="joined-past">
              <?php if(!$past_races->count()) {
                      echo '<center><span>';
                      echo __("NO RACES");
                      echo '</span></center>';
                    } else {
                      if($past_races->count()) {
                        if(app()->getLocale() == 'en')
                          echo '<div id="past-joined-en"></div>';
                        if(app()->getLocale() == 'ms')
                          echo '<div id="past-joined-ms"></div>';
                        if(app()->getLocale() == 'zh')
                          echo '<div id="past-joined-zh"></div>';
                      }
                    } ?>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

<script>

</script>


@endsection
