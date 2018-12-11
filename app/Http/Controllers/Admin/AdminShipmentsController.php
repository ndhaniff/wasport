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
use Kyslik\ColumnSortable\Sortable;
use Session;
use Mail;
use App\Mail\notifyEmail;

class AdminShipmentsController extends Controller
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
        ->where('race_status', '=', 'success')
        ->paginate(10);

      $races = Race::sortable()->get();
      $addons = Addon::sortable()->get();
      $users = User::sortable()->get();
      $order_addons = OrderAddon::sortable()->get();
      $allorders = Order::sortable()->get();

      return view('auth.admin.shipments.index',compact('orders', 'races', 'addons', 'order_addons', 'allorders'));
    }

    public function searchBy(Request $request)
    {
      $search = $request->get('search');
      $field = $request->get('field');

      $orders = Order::sortable()
        ->where($field, 'like', '%' .$search. '%')
        ->where('race_status', '=', 'success')
        ->paginate(10);

      $races = DB::table('races')->get();
      $addons = DB::table('addons')->get();
      $allorders = Order::sortable()->get();
      $order_addons = OrderAddon::sortable()->get();

      return view('auth.admin.shipments.index',compact('orders', 'races', 'addons', 'allorders', 'order_addons'));
    }

    public function filterRace(Request $request)
    {
      $raceitem = $request->get('raceitem');

      $query = Order::sortable();
        if($raceitem != '') {
          $query->where('race_id', 'like', $raceitem);
        }
      $orders = $query->where('race_status', '=', 'success')->paginate(10);

      $races = DB::table('races')->get();
      $allorders = Order::sortable()->get();
      $order_addons = OrderAddon::sortable()->get();
      $addons = Addon::sortable()->get();
      $users = User::sortable()->get();

      return view('auth.admin.shipments.index',compact('orders', 'races', 'addons', 'users', 'order_addons', 'allorders'));
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

    public function updateDeliveryStatus($oid)
    {
      $order = Order::find($oid);
      $order->shipment = request('shipment');
      $order->tracking_number = request('tracking_number');
      $order->courier = request('courier');
      $order->save();

      $orders = Order::sortable()->paginate(10);
      $races = Race::sortable()->get();
      $addons = Addon::sortable()->get();
      $users = User::sortable()->get();
      $order_addons = OrderAddon::sortable()->get();
      $allorders= Order::sortable()->get();

      //return view('auth.admin.orders.index',compact('orders', 'races', 'addons', 'order_addons', 'allorders', 'submissions'));
      return redirect()->back();
    }
}
