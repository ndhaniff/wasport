@extends('layouts.master')

@section('title')
Orders | WaSportsrun
@endsection

@section('content')

<style>
.anticon-close:before,
.anticon-cross:before,
svg:not(:root) { display: none; }
</style>


<?php $addons_arr = array();
      $orders_arr = array();
      $order_addons_arr = array();

      foreach($addons as $addon) {
        $addons_arr[] = array('aid' => $addon->aid,
                              'add_en' => $addon->add_en,
                              'add_ms' => $addon->add_ms,
                              'add_zh' => $addon->add_zh,
                              'race_id' => $addon->races_id,
                              'addprice' => $addon->addprice);
      }
      $addons_json = json_encode($addons_arr);

      foreach($orders as $order) {
        $orders_arr[] = array('oid' => $order->oid,
                              'firstname' => $order->o_firstname,
                              'lastname' => $order->o_lastname,
                              'phone_number' => $order->o_phone,
                              'address_fl' => $order->o_add_fl,
                              'address_sl' => $order->o_add_sl,
                              'city' => $order->o_city,
                              'state' => $order->o_state,
                              'postal' => $order->o_postal,
                              'race_category' => $order->race_category,
                              'engrave_name' => $order->engrave_name,
                              'race_status' => $order->race_status,
                              'shipment' => $order->shipment,
                              'courier' => $order->courier,
                              'tracking_number' => $order->tracking_number,
                              'race_id' => $order->race_id,
                              'title_en' => $order->title_en,
                              'title_ms' => $order->title_ms,
                              'title_zh' => $order->title_zh,
                              'price' => $order->price,
                              'header' => asset('storage/uploaded/races/' . $order->header));
      }
      $orders_json = json_encode($orders_arr);

      foreach($order_addons as $order_addon) {
        $order_addons_arr[] = array('oaid' => $order_addon->oaid,
                                    'a_type' => $order_addon->a_type,
                                    'order_id' => $order_addon->order_id,
                                    'addon_id' => $order_addon->addon_id);
      }
      $order_addons_json = json_encode($order_addons_arr); ?>

<script>
var addons = JSON.parse('<?= $addons_json; ?>');
var orders = JSON.parse('<?= $orders_json; ?>');
var order_addons = JSON.parse('<?= $order_addons_json; ?>');
</script>

  <div class="ordersdash p-5">
    <div class="container">

      <div class="orders-block">

        <?php if($orders->isEmpty()) {
                echo __("NO ORDERS AVAILABLE");
              } else {
                if(app()->getLocale() == 'en')
                  echo '<div id="user-orders-en"></div>';
                  if(app()->getLocale() == 'ms')
                  echo '<div id="user-orders-ms"></div>';
                  if(app()->getLocale() == 'zh')
                  echo '<div id="user-orders-zh"></div>';
              }?>

      </div>
    </div>
  </div>

@endsection
