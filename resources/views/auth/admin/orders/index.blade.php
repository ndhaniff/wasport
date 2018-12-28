@extends('auth.admin.dashboard', ['active' => ['parent' => 'orders', 'child' => null]])
@section('title')
Admin | Orders
@endsection
@section('meta')

@endsection

@section('dashboard-content')
<?php $i=1 ?>
<div class="p-3">

  <h1 style="font-size: 2.2rem">Orders</h1>

  <hr />

  @if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
  @endif

  <div class="row">
    <div class="col-sm-8">
      <form action="{{route('admin.orders.searchBy')}}" method="get">
        <div class="input-group">
          <input type="search" name="search" class="form-control" placeholder="Search by">
          <select name="field" class="form-control">
            <option value="oid">order id</option>
            <option value="o_firstname">first name</option>
            <option value="o_lastname">last name</option>
            <option value="o_phone">phone</option>
            <option value="o_email">email</option>
          </select>
          <select name="race_id">
            <option value="" disabled selected>Filter race</option>
            @foreach($allorders as $allorder)
              <?php foreach($races as $race) {
                  echo "<option value='" .$race->rid. "'>" .$race->title_en. "</option>";
                } ?>
            @endforeach
          </select>
          <select name="race_status">
            <option value="" disabled selected>Race status</option>
            <option value="awaiting">awaiting</option>
            <option value="success">success</option>
            <option value="fail">fail</option>
          </select>
          <select name="shipment">
            <option value="" disabled selected>Shipment status</option>
            <option value="order placed">order placed</option>
            <option value="order confirmed">order confirmed</option>
            <option value="order being processed">order being processed</option>
            <option value="shipped">shipped</option>
            <option value="delivered">delivered</option>
            <option value="order closed">order closed</option>
          </select>
          <span class="input-group-prepend">
            <button type="submit" class="btn btn-primary">Search</button>
          </span>
        </div>
      </form>
    </div>

    <!--<div class="col-sm-4">
      <form action="{{route('admin.orders.filterRace')}}" method="get">
        <div class="input-group">
          <select name="raceitem">
            <option value="" disabled selected>Filter race</option>
            @foreach($allorders as $allorder)
              <?php //foreach($races as $race) {
                  //echo "<option value='" .$race->rid. "'>" .$race->title_en. "</option>";
                //} ?>
            @endforeach
          </select>
          <span class="input-group-prepend">
            <button type="submit" class="btn btn-primary">Filter</button>
          </span>
        </div>
      </form>
    </div>-->
  </div>

  <br />

  <table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">No.</th>
      <th scope="col">@sortablelink('oid', 'Order ID')</th>
      <th scope="col">@sortablelink('o_firstname', 'First Name')</th>
      <th scope="col">@sortablelink('o_lastname', 'Last Name')</th>
      <th scope="col">@sortablelink('payment_status', 'Payment Status')</th>
      <th scope="col">@sortablelink('race_status', 'Race Status')</th>
      <th scope="col">Race</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    @foreach($orders as $order)
    <tr>
      <th scope="row">{{$i++ .'.'}}</th>
      <td>{{$order->oid}}</td>
      <td>{{$order->o_firstname}}</td>
      <td>{{$order->o_lastname}}</td>
      <td>{{$order->payment_status}}</td>
      <td><?php if($order->race_status == null || $order->race_status == 'undefined') echo '<i>Awaiting review</i>'; else echo $order->race_status; ?></td>
      <td><?php foreach($races as $race) {
                  if($order->race_id == $race->rid) echo $race->title_en; } ?></td>
      <td>
      <div class="btn-group " role="group" aria-label="Basic example">
        <a data-toggle="modal" data-target="#orderViewer-{{$order->oid}}">
          <button type="button" class="btn btn-success"><i class="far fa-eye"></i></button>
        </a>
        <a data-toggle="modal" data-target="#reviewViewer-{{$order->oid}}">
          <button type="button" class="btn btn-info"><i class="fas fa-clipboard-list"></i></button>
        </a>
        <a data-toggle="modal" data-target="#shipmentViewer-{{$order->oid}}">
          <button type="button" class="btn btn-warning"><i class="fas fa-truck"></i></button>
        </a>
        <form method="POST" action="{{route('admin.orders.destroy',['oid' => $order->oid ])}}">
          @method('DELETE')
          @csrf
          <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
        </form>
        <form method="POST" action="{{route('admin.orders.notifyUser',['oid' => $order->oid ])}}">
          @csrf
          <button onclick="return confirm('Send Email?')" type="submit" class="btn btn-default"><i class="far fa-envelope"></i></button>
        </form>
      </div>

      <!-- The Order Modal -->
      <div class="modal fade" id="orderViewer-{{$order->oid}}">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">

            <!-- Modal body -->
            <div class="modal-body">
              <button type="button" class="close" data-dismiss="modal">&times;</button>

              <table class="admin-modal-table">
                <tr>
                  <th>Name</th>
                  <td>{{$order->o_firstname}}, {{$order->o_lastname}}</td>
                </tr>
                <tr>
                  <th>Phone</th>
                  <td>{{$order->o_phone}}</td>
                </tr>
                <tr>
                  <th>Email</th>
                  <td>{{$order->o_email}}</td>
                </tr>
                <tr>
                  <th>Birthday</th>
                  <td>{{$order->o_birthday}}</td>
                </tr>
                <tr>
                  <th>Gender</th>
                  <td>{{$order->o_gender}}</td>
                </tr>
                <tr>
                  <th rowspan="5">Address</th>
                  <td>{{$order->o_add_fl}}</td>
                </tr>
                <tr>
                  <td>{{$order->o_add_sl}}</td>
                </tr>
                <tr>
                  <td>{{$order->o_city}}</td>
                </tr>
                <tr>
                  <td>{{$order->o_postal}}</td>
                </tr>
                <tr>
                  <td>{{$order->o_state}}</td>
                </tr>
                <tr>
                  <th>Race</th>
                  <td><?php foreach($races as $race) {
                      if($order->race_id == $race->rid)
                        echo $race->title_en;
                      } ?></td>
                </tr>
                <tr>
                  <th>Category</th>
                  <td>{{$order->race_category}}</td>
                </tr>
                <?php if($order->engrave_name != null)
                        echo '<tr><th>Engrave</th><td>' .$order->engrave_name. '</td></tr>'; ?>
                <?php
                    foreach($order_addons as $order_add) {
                      if($order_add->order_id == $order->oid) {
                        echo '<tr><th colspan="2">Addon:</th></tr>';

                        foreach($order_addons as $order_addon) {
                          if($order_addon->order_id == $order->oid) {
                            $addon_id = $order_addon->addon_id;
                            $addon_type = $order_addon->a_type;

                            foreach($addons as $addon) {
                              if($addon->aid == $addon_id) {
                                $addon_name = $addon->add_en;
                              }
                            }
                            echo '<tr><th>' .$addon_name. '</th><td>' .$addon_type. '</td></tr>';
                          }
                        }
                        break;
                      }
                    }
                ?>
                <tr>
                  <th>Payment Status</th>
                  <td>{{$order->payment_status}}</td>
                </tr>
                <tr>
                  <th>Race Status</th>
                  <td><?php if($order->race_status == null || $order->race_status == 'undefined') echo '<i>Awaiting review</i>'; else echo $order->race_status; ?></td>
                </tr>
                <tr>
                  <th>Shipment</th>
                  <td>{{$order->shipment}}</td>
                </tr>
                <tr>
                  <th>Courier</th>
                  <td><?php if($order->courier == null || $order->courier == 'undefined') echo '-'; else echo $order->courier ?></td>
                </tr>
                <tr>
                  <th>Tracking Number</th>
                  <td><?php if($order->tracking_number == null || $order->tracking_number == 'undefined') echo '-'; else echo $order->tracking_number ?></td>
                </tr>
              </table>

            </div>
          </div>
        </div>
      </div> <!-- end of orderViewer -->

      <!-- The Review Modal -->
      <div class="modal fade" id="reviewViewer-{{$order->oid}}">
        <div class="modal-dialog modal-dialog-centered" style="max-width:800px;">
          <div class="modal-content">

            <!-- Modal body -->
            <div class="modal-body">
              <button type="button" class="close" data-dismiss="modal">&times;</button>

              <?php $distanceCompleted = '0km';
                    $timeTaken = '0';
                    $routeImage = 'null';
                    $strava_activity = ''; ?>

              @foreach($submissions as $submission)
                @if($submission->order_id == $order->oid)
                    <?php
                      $distance = $submission->s_distance;
                      $hour = $submission->s_hour;
                      $min = $submission->s_minute;
                      $sec = $submission->s_second;
                      $submitimg = $submission->s_routeimg;
                      $strava_activity = $submission->strava_activity;
                      $polyline = $submission->s_map_polyline;

                      $distanceCompleted = $distance .'km';

                      $hour = ($hour > 10) ? $hour : '0' .$hour;
                      $min = ($min > 10) ? $min : '0' .$min;
                      $sec = ($sec > 10) ? $sec : '0' .$sec;
                      $timeTaken = $hour. ':' .$min. ':' .$sec;

                      if($submitimg != null) {
                        $routeImage = asset('storage/uploaded/submissions/' . $submitimg);
                      }

                      if($polyline != null) {
                        $routeImage = 'https://maps.googleapis.com/maps/api/staticmap?size=640x640&key=AIzaSyD72_ThnAh5eTa7BAlAA-2XhwZ_AKDy_Iw&zoom=16&path=weight:3%7Ccolor:red%7Cenc:' . $polyline;
                      }
                    ?> @break
                  @endif
                @endforeach

                <table id="review-table">
                  <tr>
                    <th>Route Image</th>
                    <td><?php if($routeImage == 'null') echo $routeImage; else echo '<img src="' .$routeImage. '"/ style="max-width: 100%;">'; ?></td>
                  </tr>
                  <tr>
                    <th>Race Category</th>
                    <td>{{$order->race_category}}</td>
                  </tr>
                  <tr>
                    <th>Distance completed</th>
                    <td>{{$distanceCompleted}}</td>
                  </tr>
                  <tr>
                    <th>Time used</th>
                    <td>{{$timeTaken}}</td>
                  </tr>
                  <tr>
                    <th>Strava Activity ID</th>
                    <td><?php echo ($strava_activity != null) ? $strava_activity : '-'; ?></td>
                  </tr>
                  <tr>
                    <th>Race Status</th>
                    <td>
                      <form method="POST" action="{{route('admin.orders.updateRaceStatus',['oid' => $order->oid ])}}" id="racestatus-form">
                        @csrf
                        <?php echo Form::select('racestatus', array('awaiting' => 'awaiting', 'success' => 'success', 'fail' => 'fail'), $order->race_status); ?>
                        <button type="submit" class="btn btn-danger" id="racestatus-btn">Submit</button>
                      </form>
                    </td>
                  </tr>
                </table>
            </div>
          </div>
        </div>
      </div> <!-- end of reviewViewer -->

      <!-- The Shipment Modal -->
      <div class="modal fade" id="shipmentViewer-{{$order->oid}}">
        <div class="modal-dialog modal-dialog-centered" style="max-width:800px;">
          <div class="modal-content">

            <!-- Modal body -->
            <div class="modal-body">
              <button type="button" class="close" data-dismiss="modal">&times;</button>

              <?php $price = '';
                    foreach($races as $race) {
                      if($race->rid == $order->race_id) {
                        $price = $race->price;
                    }
                } ?>
              <table id="review-table">
                <tr>
                  <th>Payment Status</th>
                  <td>{{$order->payment_status}}</td>
                </tr>
                <tr>
                  <th>Race Status</th>
                  <td>{{$order->race_status}}</td>
                </tr>
                <tr>
                  <th>To be shipped</th>
                  @if($price == 0)
                    <td>-</td>
                  @else
                    <td>
                      <ul>
                        <li>Medal <?php if($order->engrave_name != null) echo ' - ' .$order->engrave_name; ?></li>
                        <?php foreach($order_addons as $order_addon) {
                                if($order_addon->order_id == $order->oid) {
                                  foreach($addons as $addon) {
                                    if($addon->aid == $order_addon->addon_id) {
                                      echo '<li>' .$addon->add_en. ' - '.$order_addon->a_type. '</li>';
                                    }
                                  }
                                }
                              } ?>
                      </ul>
                    </td>
                  @endif
                </tr>
                <tr>
                  <th>Shipment Status</th>
                  <td>
                    <form method="POST" action="{{route('admin.orders.updateDeliveryStatus',['oid' => $order->oid ])}}" id="shipment-form">
                      @csrf
                      <?php echo Form::select('shipment', array('order placed' => 'order placed',
                                                                'order confirmed' => 'order confirmed',
                                                                'order being processed' => 'order being processed',
                                                                'shipped' => 'shipped',
                                                                'delivered' => 'delivered',
                                                                'order closed' => 'order closed'), $order->shipment); ?>
                  </td>
                </tr>
                <tr>
                  <th>Courier</th>
                  <td><?php echo Form::select('courier', array('' => '',
                                                                'POS LAJU' => 'Pos Laju',
                                                                'CITYLINK EXPRESS' => 'Citylink Express',
                                                                'FEDEX EXPRESS' => 'FedEx Express',
                                                                'GDEX EXPRESS' => 'Gdex Express',
                                                                'NINJA VAN' => 'Ninja Van',
                                                                'PGEON DELIVERY' => 'Pgeon Delivery',
                                                                'SKYNET EXPRESS' => 'Skynet Express'), $order->courier); ?></td>
                </tr>
                <tr>
                  <th>Tracking Number</th>
                  <td>
                      <?php echo Form::text('tracking_number', $order->tracking_number); ?>
                      <button type="submit" class="btn btn-danger" id="racestatus-btn">Submit</button>
                    </form>
                  </td>
                </tr>
              </table>

            </div>
          </div>
        </div>
      </div> <!-- end of shipmentViewer -->

      </td>
    </tr>
    @endforeach
  </tbody>
</table>

{{ $orders->links() }}

</div>

@endsection

<script>
  var orderid = ''
  function orderFunction(d){
    orderid = d.getAttribute("data-id")
  }
</script>
