@extends('layouts.master')

@section('content')

<div id="registerrace">
  <div class="container">

    <?php $theDeadline = $race->dead_to . ' ' . $race->deadtime_to;
          $deadlineF = DateTime::createFromFormat('Y-m-d H:i a', $theDeadline)->format('Y-m-d H:i a');

          date_default_timezone_set('Asia/Kuala_Lumpur');
          $theCurrent = date('Y-m-d H:i a');

          if($theDeadline < $theCurrent) {
            echo "<h2 style='text-align:center;'>Sorry, registration closed<br /> Please check out other races below</h2><br />"; ?>


            <div class="register-closed">
              <div id="new-race">

                <div class="row">
                  @foreach ($new as $newrace)
                  <div class="col-sm-12 col-md-4">
                    <a href="racedetails/{{ $newrace->rid }}">
                      <div class="race-box">
                        <div class="race-img">
                          <img src="<?php echo asset('storage/uploaded/races/' . $newrace->header) ?>" alt="{{ $newrace->title_en }}">
                        </div>

                        <div class="race-caption">
                          <?php if(app()->getLocale() == 'en')
                                  echo '<h5>' .$newrace->title_en. '</h5>';
                                if(app()->getLocale() == 'ms')
                                  echo '<h5>' .$newrace->title_ms. '</h5>';
                                if(app()->getLocale() == 'zh')
                                  echo '<h5>' .$newrace->title_zh. '</h5>'; ?>

                          <hr>

                          <div class="raceslisting-date">
                            <?php $dateF = DateTime::createFromFormat('Y-m-d', $newrace->date_from)->format('d M Y');

                                  $dateT = DateTime::createFromFormat('Y-m-d', $newrace->date_to)->format('d M Y');

                                  echo $dateF. ' (' .$newrace->time_from. ') GMT +08' . '<br>-<br>' .$dateT. ' (' .$newrace->time_to. ') GMT +08'; ?>
                          </div>

                        </div>
                      </div>
                    </a>
                  </div>
                  @endforeach
                </div>
              </div>
            </div>


    <?php } else {
            if(app()->getLocale() == 'en')
              echo '<div id="registerraceform-en"></div>';
            if(app()->getLocale() == 'ms')
              echo '<div id="registerraceform-ms"></div>';
            if(app()->getLocale() == 'zh')
              echo '<div id="registerraceform-zh"></div>';
          } ?>

    <br /><br />
  </div>
</div>

<?php $addon_arr = array();

      foreach($addons as $addon) {
        $addon_arr[] = array('aid' => $addon->aid, 'add_en' => $addon->add_en, 'addprice' => $addon->addprice, 'type' => $addon->type);
      }

      $addon_json = json_encode($addon_arr); ?>

@endsection

@section('script')

<script>
  var race = {
    rid: "{{$race->rid}}",
    title_en: "{{$race->title_en}}",
    title_ms: "{{$race->title_ms}}",
    title_zh: "{{$race->title_zh}}",
    price: "{{$race->price}}",
    category: "{{$race->category}}",
    engrave: "{{$race->engrave}}"
  }

  var addons = JSON.parse('<?= $addon_json; ?>');

</script>


@if (Auth::check())
  <script>
    var user = {
      id: "{{$user->id}}",
      firstname: "{{$user->firstname}}",
      lastname: "{{$user->lastname}}",
      phone: "{{$user->phone}}",
      gender: "{{$user->gender}}",
      birthday: "{{$user->birthday}}",
      add_fl: "{{$user->add_fl}}",
      add_sl: "{{$user->add_sl}}",
      city: "{{$user->city}}",
      state: "{{$user->state}}",
      postal: "{{$user->postal}}"
    }
  </script>
@else
<script>
  var user = {
    id: "",
    firstname: "",
    lastname: "",
    phone: "",
    gender: "",
    birthday: "",
    add_fl: "",
    add_sl: "",
    city: "",
    state: "",
    postal: ""
  }
</script>
@endif
@endsection
