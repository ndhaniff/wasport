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
use Session;
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

      //return view('auth.admin.orders.index',compact('orders', 'races', 'addons', 'order_addons', 'allorders', 'submissions'));
      return redirect()->back();
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
        $m->to($order->email, $order->name)->subject('[WaSports] Congratulations for Completing ' . $order->title_en);
      });

      // check for failures
      if (Mail::failures()) {
        //return back()->with('error','Email unable sent to ' .$order->o_firstname. ', ' . $order->lastname);
        Session::flash('message', 'Email unable send to ' .$order->o_firstname. ', ' . $order->lastname);
        return redirect()->back();
      } else {
        return redirect()->back();
        Session::flash('message', 'Email successfully sent to ' .$order->o_firstname. ', ' . $order->lastname);
      }

      //return redirect()->back();
    }
}
