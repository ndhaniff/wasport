@extends('layouts.master')

@section('content')

<div class="offline-details p-5">
  <div class="container">
    <center><img src="<?php echo asset('storage/uploaded/offline/' . $offline->header) ?>" id="banner"></center>

    <div class="details">
      <center>
        <?php if(app()->getLocale() == 'en')
                echo '<h3>' .$offline->title_en. '</h3>';
              if(app()->getLocale() == 'ms')
                echo '<h3>' .$offline->title_ms. '</h3>';
              if(app()->getLocale() == 'zh')
                echo '<h3>' .$offline->title_zh. '</h3>'; ?>

      <table>
        <tr>
          <th>{{__("Date")}}</th>
          <td>{{DateTime::createFromFormat('Y-m-j', $offline->date)->format('j M Y')}}</td>
        </tr>
        <tr>
          <th>{{__("Location")}}</th>
          <td>{{$offline->location}}</td>
        </tr>
        <tr>
          <th>{{__("Category")}}</th>
          <td>{{$offline->category}}</td>
        </tr>
        <tr>
          <th>{{__("Website")}}</th>
          <td><a href="{{$offline->website}}" target="_blank">{{__("Go to website")}}</a></td>
        </tr>
      </table></center>
    </div>

    <?php if(app()->getLocale() == 'en' && $offline->details_en != null) {
            echo '<div class="btm-details"><hr><b>Race Details</b>';
            echo $offline->details_en;
            echo '</div><br />';

          }
          if(app()->getLocale() == 'ms' && $offline->details_ms != null) {
            echo '<div class="btm-details"><hr><b>Butiran Larian</b>';
            echo $offline->details_ms;
            echo '</div><br />';
          }
          if(app()->getLocale() == 'zh' && $offline->details_zh != null) {
            echo '<div class="btm-details"><hr><b>赛事详情</b>';
            echo $offline->details_zh;
            echo '</div><br />';
          } ?>

    <div class="details-gallery"><center>
      @if($offline->raceimg_1 != null)
        <img src="<?php echo asset('storage/uploaded/offlinerace/' . $offline->raceimg_1) ?>"><br><br>
      @endif
      @if($offline->raceimg_2 != null)
        <img src="<?php echo asset('storage/uploaded/offlinerace/' . $offline->raceimg_2) ?>"><br><br>
      @endif
      @if($offline->raceimg_3 != null)
        <img src="<?php echo asset('storage/uploaded/offlinerace/' . $offline->raceimg_3) ?>"><br><br>
      @endif
      @if($offline->raceimg_4 != null)
        <img src="<?php echo asset('storage/uploaded/offlinerace/' . $offline->raceimg_4) ?>"><br><br>
      @endif
      @if($offline->raceimg_5 != null)
        <img src="<?php echo asset('storage/uploaded/offlinerace/' . $offline->raceimg_5) ?>"><br><br>
      @endif
      @if($offline->raceimg_6 != null)
        <img src="<?php echo asset('storage/uploaded/offlinerace/' . $offline->raceimg_6) ?>"><br><br>
      @endif
    </center></div>
  </div>
</div>

@endsection
