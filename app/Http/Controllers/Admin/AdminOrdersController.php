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
use Mail;
use App\Mail\notifyEmail;

class AdminOrdersController extends Controller
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
      $orders = Order::sortable()->paginate(10);
      $races = Race::sortable()->get();
      $addons = Addon::sortable()->get();
      $users = User::sortable()->get();
      $order_addons = OrderAddon::sortable()->get();
      $allorders= Order::sortable()->get();
      $submissions = DB::table('submissions')
        ->orderBy('sid', 'DESC')
        ->get();

      return view('auth.admin.orders.index',compact('orders', 'races', 'addons', 'order_addons', 'allorders', 'submissions'));
    }

    public function searchBy(Request $request)
    {
      $search = $request->get('search');
      $field = $request->get('field');

      $orders = Order::sortable()
        ->where($field, 'like', '%' .$search. '%')
        ->paginate(10);

      $races = DB::table('races')->get();
      $addons = DB::table('addons')->get();
      $allorders = Order::sortable()->get();
      $order_addons = OrderAddon::sortable()->get();

      $submissions = DB::table('submissions')
        ->orderBy('sid', 'DESC')
        ->get();

      return view('auth.admin.orders.index',compact('orders', 'races', 'addons', 'allorders', 'order_addons', 'submissions'));
    }

    public function filterRace(Request $request)
    {
      $raceitem = $request->get('raceitem');

      $query = Order::sortable();
        if($raceitem != '') {
          $query->where('race_id', 'like', $raceitem);
        }
      $orders = $query->paginate(10);

      $races = DB::table('races')->get();
      $allorders = Order::sortable()->get();
      $order_addons = OrderAddon::sortable()->get();
      $addons = Addon::sortable()->get();
      $users = User::sortable()->get();

      $submissions = DB::table('submissions')
        ->orderBy('sid', 'DESC')
        ->get();

      return view('auth.admin.orders.index',compact('orders', 'races', 'addons', 'users', 'order_addons', 'allorders', 'submissions'));
    }

    public function editForm($oid){

    }

    /**
     * Edit Order
     *
     * @param Request $request
     * @return void
     */
    public function edit(Request $request)
    {

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

        if($raceStatus == 'success')
          $update->shipment = 'order confirmed';

        if($raceStatus == 'awaiting')
          $update->shipment = 'order placed';

        $update->save();

        $orders = Order::sortable()->paginate(10);
        $races = Race::sortable()->get();
        $addons = Addon::sortable()->get();
        $users = User::sortable()->get();
        $order_addons = OrderAddon::sortable()->get();
        $allorders= Order::sortable()->get();
        $submissions = DB::table('submissions')
          ->orderBy('sid', 'DESC')
          ->get();

        return view('auth.admin.orders.index',compact('orders', 'races', 'addons', 'order_addons', 'allorders', 'submissions'));
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
      $submissions = DB::table('submissions')
        ->orderBy('sid', 'DESC')
        ->get();

      return view('auth.admin.orders.index',compact('orders', 'races', 'addons', 'order_addons', 'allorders', 'submissions'));
    }

    public function notifyUser($oid) {

      $order = DB::table('orders')
        ->join('users', 'orders.user_id', '=', 'users.id')
        ->join('races', 'orders.race_id', '=', 'races.rid')
        ->where('oid', '=', $oid)
        ->first();

        $email = DB::table('users')
          ->join('orders', 'users.id', '=', 'orders.user_id')
          ->where('id', '=', $order->user_id)
          ->get(['email']);

        $race = DB::table('races')
        ->join('orders', 'races.rid', '=', 'orders.race_id')
        ->where('oid', '=', $oid)
        ->get(['title_en']);

        Mail::send('email.sendNotifyEmail', ['order' => $order], function ($m) use ($order) {
        $m->from('info@wasportsrun.com', 'WaSportsRun');
        $m->to($order->email, $order->name)->subject('Congratulations on completing ' . $order->title_en);
        });

      return redirect()->back();
    }
}
