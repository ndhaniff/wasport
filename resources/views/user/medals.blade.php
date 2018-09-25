@extends('layouts.master')

@section('title')
Medals | WaSportsrun
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
</style>

  <div class="medaldash p-5">
    <div class="container">

      <div class="medal-block">

        <div class="tabs">
          <div class="tab-2">
            <label for="tab2-1">All Medals</label>
            <input id="tab2-1" name="tabs-two" type="radio" checked="checked">

            <div>
              <div id="user-medal-frame">
                <div class="row">
                  @foreach($medals as $medal)
                  <div class="col-md-4">
                    <a data-toggle="modal" data-target="#medalViewer-{{$medal->mid}}" data-id="{{$medal->mid}}">
                      <img src="<?= asset('storage/uploaded/medals/grey/' . $medal->medal_grey) ?>" alt="{{$medal->title_en}}">
                    </a>
                  </div>

                  <!-- The Modal -->
                  <div class="modal fade" id="medalViewer-{{$medal->mid}}">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">

                        <!-- Modal body -->
                        <div class="modal-body">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>

                          <img src="<?= asset('storage/uploaded/medals/grey/' . $medal->medal_grey) ?>" alt="{{$medal->title_en}}" id="modal-img"> <br>

                          <h3>{{$medal->title_en}}</h3>

                        </div>
                      </div>
                    </div>
                  </div>

                  @endforeach
                </div>
              </div>
            </div>
          </div>

          <div class="tab-2">
            <label for="tab2-2">My Medals</label>
            <input id="tab2-2" name="tabs-two" type="radio">

            <div>

            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

<script>

</script>


@endsection
