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
use App\Model\Payment;
use Kyslik\ColumnSortable\Sortable;
use Mail;
use Session;
use App\Mail\notifyEmail;

class AdminPaymentsController extends Controller
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
      $payments = Payment::sortable()
        ->join('orders', 'orders.oid', '=', 'order_id')
        ->paginate(10);
      $orders = Order::sortable()->get();
      $races = Race::sortable()->get();
      $allpayments = Payment::sortable()
        ->join('orders', 'orders.oid', '=', 'order_id')
        ->get();

      return view('auth.admin.payments.index',compact('payments', 'orders', 'races', 'allpayments'));
    }

    public function searchBy(Request $request)
    {
      $search = $request->get('search');
      $field = $request->get('field');
      $race_id = $request->get('race_id');
      $payment_status = $request->get('p_status');
      $payments = '';

      $query = Payment::sortable()->where($field, 'like', '%' .$search. '%');

      if($race_id != '') {
        $query->where('race_id', '=', $race_id);
      }
      if($payment_status != '') {
        $query->where('p_status', '=', $payment_status);
      }
      $payments = $query->join('orders', 'orders.oid', '=', 'order_id')->paginate(10);

      $payments = Payment::sortable()->paginate(10);
      $orders = Order::sortable()->get();
      $races = Race::sortable()->get();
      $allpayments = Payment::sortable()
        ->join('orders', 'orders.oid', '=', 'order_id')
        ->get();

      return view('auth.admin.payments.index',compact('payments', 'orders', 'races', 'allpayments'));
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
      * Delete Payment
      *
      * @param [int] $id
      * @return void
      */
    public function destroy($pid)
    {
        $payment = Payment::find($pid);
        if($payment->count()  > 0){
            $payment->delete();
            return redirect()->back();
        } else {
            return response()->json(['success' => false, 'msg' => 'payment not found' ], 200 );
        }
    }

    public function updatePaymentStatus($pid)
    {
        $updatePayment = Payment::find($pid);
        $paymentStatus = request('paymentstatus');
        $updatePayment->p_status = $paymentStatus;

        $oid = $updatePayment->order_id;

        if($paymentStatus == '1') {
          $paymentRemark = 'paid';
          //send receipt
        }
        if($paymentStatus == '0') {
          $paymentRemark = 'pending';
        }

        $updatePayment->save();

        $updateOrder = Order::find($oid);
        $updateOrder->payment_status = $paymentRemark;
        $updateOrder->save();

        $payments = Payment::sortable()
          ->join('orders', 'orders.oid', '=', 'order_id')
          ->paginate(10);
        $orders = Order::sortable()->get();
        $races = Race::sortable()->get();
        $allpayments = Payment::sortable()
          ->join('orders', 'orders.oid', '=', 'order_id')
          ->get();

        return view('auth.admin.payments.index',compact('payments', 'orders', 'races', 'allpayments'));
    }
}
