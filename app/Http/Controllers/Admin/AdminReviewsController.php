<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Model\Order;
use App\Model\OrderAddon;
use App\Model\Race;
use App\Model\Addon;
use App\Model\User;
use App\Model\Submission;
use Kyslik\ColumnSortable\Sortable;
use Session;

class AdminReviewsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the order list
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $orders = Order::sortable()
        ->where('payment_status', '=', 'paid')
        ->paginate(10);

      $races = Race::sortable()->get();
      $addons = Addon::sortable()->get();
      $users = User::sortable()->get();
      $order_addons = OrderAddon::sortable()->get();
      $allorders = Order::sortable()->get();
      $submissions = DB::table('submissions')
        ->orderBy('sid', 'DESC')
        ->get();

      return view('auth.admin.reviews.index',compact('orders', 'races', 'addons', 'order_addons', 'allorders', 'submissions'));
    }

    public function searchBy(Request $request)
    {
      $search = $request->get('search');
      $field = $request->get('field');
      $race_id = $request->get('race_id');
      $race_status = $request->get('race_status');
      $orders = '';

      $query = Order::sortable()
        ->where($field, 'like', '%' .$search. '%')
        ->where('payment_status', '=', 'paid')

      if($race_id != '') {
        $query->where('race_id', '=', $race_id);
      }
      if($race_status != '') {
        $query->where('race_status', '=', $race_status)
      }
      $orders = $query->paginate(10);

      /*if($race_id == '' && $race_status == '') {
        $orders = Order::sortable()
          ->where($field, 'like', '%' .$search. '%')
          ->where('payment_status', '=', 'paid')
          ->paginate(10);
      }
      if($race_id == '' && $race_status != '') {
        $orders = Order::sortable()
          ->where($field, 'like', '%' .$search. '%')
          ->where('payment_status', '=', 'paid')
          ->where('race_status', '=', $race_status)
          ->paginate(10);
      }
      if($race_id != '' && $race_status == '') {
        $orders = Order::sortable()
          ->where($field, 'like', '%' .$search. '%')
          ->where('payment_status', '=', 'paid')
          ->where('race_id', '=', $race_id)
          ->paginate(10);
      }
      if($race_id != '' && $race_status != '') {
        $orders = Order::sortable()
          ->where($field, 'like', '%' .$search. '%')
          ->where('payment_status', '=', 'paid')
          ->where('race_status', '=', $race_status)
          ->where('race_id', '=', $race_id)
          ->paginate(10);
      }*/

      $races = DB::table('races')->get();
      $addons = DB::table('addons')->get();
      $allorders = Order::sortable()->get();
      $order_addons = OrderAddon::sortable()->get();

      $submissions = DB::table('submissions')
        ->orderBy('sid', 'DESC')
        ->get();

      return view('auth.admin.reviews.index',compact('orders', 'races', 'addons', 'allorders', 'order_addons', 'submissions'));
    }

    public function filterRace(Request $request)
    {
      $raceitem = $request->get('raceitem');

      $query = Order::sortable();
        if($raceitem != '') {
          $query->where('race_id', 'like', $raceitem);
        }
      $orders = $query->where('payment_status', '=', 'paid')->paginate(10);

      $races = DB::table('races')->get();
      $allorders = Order::sortable()->get();
      $order_addons = OrderAddon::sortable()->get();
      $addons = Addon::sortable()->get();
      $users = User::sortable()->get();

      $submissions = DB::table('submissions')
        ->orderBy('sid', 'DESC')
        ->get();

      return view('auth.admin.reviews.index',compact('orders', 'races', 'addons', 'users', 'order_addons', 'allorders', 'submissions'));
    }

     /**
      * Delete Orders
      *
      * @param [int] $id
      * @return void
      */
    public function destroy($oid)
    {
        $order = Order::find($oid);
        if($order->count()  > 0){
            $order->delete();
            return redirect()->back();
        } else {
            return response()->json(['success' => false, 'msg' => 'order not found' ], 200 );
        }
    }

    public function updateRaceStatus($oid)
    {
        $update = Order::find($oid);
        $raceStatus = request('racestatus');
        $update->race_status = $raceStatus;

        if($raceStatus == 'fail')
          $update->shipment = 'order closed';

        if($raceStatus == 'awaiting')
          $update->shipment = 'order placed';

        if($raceStatus == 'success') {
          $update->shipment = 'order confirmed';

          $submission = DB::table('submissions')
              ->where('order_id' , '=', $oid)
              ->orderBy('updated_at', 'DESC')
              ->first();

          $update->pace_min = $submission->s_pace_min;
          $update->pace_sec = $submission->s_pace_sec;
        }

        $update->save();

        /*$orders = Order::sortable()
          ->where('payment_status', '=', 'paid')
          ->paginate(10);
        $races = Race::sortable()->get();
        $addons = Addon::sortable()->get();
        $users = User::sortable()->get();
        $order_addons = OrderAddon::sortable()->get();
        $allorders= Order::sortable()->get();
        $submissions = DB::table('submissions')
          ->orderBy('sid', 'DESC')
          ->get();*/

        //return view('auth.admin.orders.index',compact('orders', 'races', 'addons', 'order_addons', 'allorders', 'submissions'));
        return redirect()->back();
    }

    public function updateDeliveryStatus($oid)
    {
      $order = Order::find($oid);
      $order->shipment = request('shipment');
      $order->tracking_number = request('tracking_number');
      $order->courier = request('courier');
      $order->save();

      /*$orders = Order::sortable()->paginate(10);
      $races = Race::sortable()->get();
      $addons = Addon::sortable()->get();
      $users = User::sortable()->get();
      $order_addons = OrderAddon::sortable()->get();
      $allorders= Order::sortable()->get();
      $submissions = DB::table('submissions')
        ->orderBy('sid', 'DESC')
        ->get();*/

      //return view('auth.admin.orders.index',compact('orders', 'races', 'addons', 'order_addons', 'allorders', 'submissions'));
      return redirect()->back();
    }
}
