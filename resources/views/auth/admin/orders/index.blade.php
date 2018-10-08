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

  <div class="row">
    <div class="col-sm-4">
      <form action="{{route('admin.orders.search')}}" method="get">
        <div class="input-group">
          <input type="search" name="search" class="form-control" placeholder="Search by">
          <select name="field" class="form-control">
            <option value="oid">order id</option>
            <option value="o_firstname">first name</option>
            <option value="o_lastname">last name</option>
            <option value="o_phone">phone</option>
          </select>
          <span class="input-group-prepend">
            <button type="submit" class="btn btn-primary">Search</button>
          </span>
        </div>
      </form>
    </div>

    <div class="col-sm-4">
      <form action="{{route('admin.orders.filter')}}" method="get">
        <div class="input-group">
          <select name="categoryitem">
            <option value=”” disabled selected>Filter orders</option>
          </select>
          <span class="input-group-prepend">
            <button type="submit" class="btn btn-primary">Filter</button>
          </span>
        </div>
      </form>
    </div>
  </div>

  <br />

  <table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">No.</th>
      <th scope="col">@sortablelink('oid', 'Order ID')</th>
      <th scope="col">@sortablelink('o_firstname', 'First Name')</th>
      <th scope="col">@sortablelink('o_lastname', 'Last Name')</th>
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
      <td>
      <div class="btn-group " role="group" aria-label="Basic example">
        <a data-toggle="modal" data-target="#orderViewer-{{$order->oid}}" data-id="{{$order->oid}}">
          <button type="button" class="btn btn-success"><i class="far fa-eye"></i></button>
        </a>
        <form method="POST" action="{{route('admin.orders.destroy',['oid' => $order->oid ])}}">
          @method('DELETE')
          @csrf
          <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
        </form>
      </div>

      <!-- The Modal -->
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
                  <td>{{$order->o_add_sl}}</td>
                  <td>{{$order->o_city}}</td>
                  <td>{{$order->o_postal}}</td>
                  <td>{{$order->o_state}}</td>
                </tr>
                <tr>
                  <th>Race</th>
                  <td><?php foreach($races as $race) {
                              if($race->id == $order->races_id) { echo $race->title_en; } } ?>
                  </td>
                </tr>
                <tr>
                  <th>Category</th>
                  <td>{{$order->race_category}}</td>
                </tr>
                <?php if($order->engrave_name != '') { echo '<tr><th>Engrave<th><td>' .$order->engrave_name. '</td></tr>'; } ?>
                <?php if($order->o_addon != '') { echo '<tr><th>Addon<th><td>' .$order->o_addon. '</td></tr>'; } ?>
                <tr>
                  <th>Race Status</th>
                  <td>{{$order->race_status}}</td>
                </tr>
                <tr>
                  <th>Shipment</th>
                  <td>{{$order->shipment}}</td>
                </tr>
              </table>

            </div>
          </div>
        </div>
      </div>

      </td>
    </tr>
    @endforeach
  </tbody>
</table>

{{ $orders->links() }}

</div>

@endsection