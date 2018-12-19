<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Laracasts\Flash\Flash;
use App\Http\Controllers\API\StravaController;
use App\Model\User;
use App\Model\Race;
use App\Model\Medal;
use App\Model\Addon;
use App\Model\Order;
use App\Model\OrderAddon;
use App\Model\Submission;
use App\Model\Payment;
use Auth;
use DB;
use Mail;
use App\Mail\confirmEmail;

class UserController extends Controller
{
    private $merchantcode = 'M18793';
    private $merchantkey = 'flICG0S4Ul';
    private $responseurl = 'https://wasportsrun.com/payment/ipay88/callback';
    private $backendurl = 'https://wasportsrun.com/payment/ipay88/backendcallback';

    public function __construct(){
      $this->middleware('auth');
    }

    public function index(){
        return view('pages.index');
    }

    public function showLogin(){
      return view('auth.login');
    }

    public function dashboard(Request $request){

      $user = Auth::user();
      $strava = new StravaController();

      if(session('code') != null){
        $code = session('code');

        $stravaUser = $strava->getAuthToken($code);

        $user->strava_id = $stravaUser->athlete->id;
        $user->strava_access_token = $stravaUser->access_token;
        $user->strava_email = $stravaUser->athlete->email;
        $user->save();
      }

      $date = date('Y-m-d');

      $races = DB::table('races')
        ->where('dead_to', '>', $date)
        ->orderBy('date_from')
        ->limit(3)
        ->get();

      $number_count = DB::table('orders')
        ->where('user_id', '=', Auth::id())
        ->where('payment_status', '=', 'paid')
        ->get();

      $date = date('Y-m-d');

      $latest_race = DB::table('orders')
        ->join('races', 'races.rid', '=', 'race_id')
        ->where('user_id', '=', Auth::id())
        ->where('payment_status', '=', 'paid')
        ->orderBy('date_from', 'DESC')
        ->get();

      $race_count = $number_count->count();

      $allmedals = DB::table('medals')->get();

      $dashmedals = DB::table('medals')
        ->leftjoin('orders', 'medals.races_id', '=', 'orders.race_id')
        ->join('races', 'medals.races_id', '=', 'races.rid')
        ->orderBy('date_from', 'DESC')
        ->get();

      $joinedmedals = DB::table('medals')
        ->join('orders', 'medals.races_id', '=', 'orders.race_id')
        ->join('races', 'medals.races_id', '=', 'races.rid')
        ->where('user_id', '=', Auth::id())
        ->where('payment_status', '=', 'paid')
        ->orderBy('date_from', 'DESC')
        ->get();

      $usermedals = DB::table('medals')
        ->leftjoin('orders', 'medals.races_id', '=', 'orders.race_id')
        ->join('races', 'medals.races_id', '=', 'races.rid')
        ->where('user_id', '=', Auth::id())
        ->where('race_status', '=', 'success')
        ->get();

      $submissions = DB::table('submissions')
        ->where('user_id', '=', Auth::id())
        ->orderBy('sid', 'ASC')
        ->get();

      $certdatas = DB::table('submissions')
        ->where('user_id', '=', Auth::id())
        ->orderBy('sid', 'DESC')
        ->get();

      return view('user.dashboard', ['user' => $user, 'races' => $races, 'latest_race' => $latest_race,
                                      'race_count' => $race_count, 'allmedals' => $allmedals,
                                      'dashmedals' => $dashmedals, 'usermedals' => $usermedals,
                                      'joinedmedals' => $joinedmedals, 'submissions' => $submissions,
                                      'certdatas' => $certdatas]);
    }

    public function updateProfile(Request $request){

      $id = $request->get('id');

      $user = User::find($id);
      $user->name = $request->get('name');
      $user->firstname = $request->get('firstname');
      $user->lastname = $request->get('lastname');
      $user->motto = $request->get('motto');
      $user->gender = $request->get('gender');
      $user->birthday = $request->get('birthday');

      if($request->get('phone') === '60') {
        $user->phone = null;
      } else {
        $user->phone = $request->get('phone');
      }

      $user->save();

      return response()->json(['success' => true], 200 );
    }

    public function handleProfileImg(Request $request){
      dd($request->file('profileimg'));
    }

    public function uploadProfileImg(Request $request){

      $id = $request->get('id');
      $user = User::find($id);
      $profileimg = $request->file('profileimg');
      $filenameWithExt = $user->id;
      $filename =  str_replace(' ', '_', pathinfo($filenameWithExt, PATHINFO_FILENAME ));
      $ext = $profileimg->getClientOriginalExtension();
      $filenameToStore = $filename."_".time().".".$ext;
      $path = $profileimg->storeAs('public/uploaded/users', $filenameToStore);
      $user->profileimg = $filenameToStore;
      $user->save();

      return response()->json(['success' => true], 200 );
    }

    public function updateAddress(Request $request){

      $id = $request->get('id');

      $user = User::find($id);
      $user->add_fl = $request->get('add_fl');
      $user->add_sl = $request->get('add_sl');
      $user->city = $request->get('city');
      $user->state = $request->get('state');
      $user->postal = $request->get('postal');

      $user->save();

      return response()->json(['success' => true], 200 );
    }

    public function updatePassword(Request $request){

      $id = $request->get('id');
      $newP = $request->get('new_password');
      $confirmP = $request->get('confirm_password');

      if( $newP == $confirmP) {
        $user = User::find($id);
        $user->password = password_hash($newP, PASSWORD_DEFAULT);

        $user->save();

        return response()->json(['success' => true], 200 );
      } else
          return response()->json(['success' => false], 200 );
    }

    public function submitRace(Request $request) {

      $order = new Order();
      $order->o_firstname = $request->get('firstname');
      $order->o_lastname = $request->get('lastname');
      $order->o_phone = $request->get('phone');
      $order->o_gender = $request->get('gender');
      $order->o_birthday = $request->get('birthday');
      $order->o_email = $request->get('email');
      $order->o_add_fl = $request->get('add_fl');
      $order->o_add_sl = $request->get('add_sl');
      $order->o_city = $request->get('city');
      $order->o_state = $request->get('state');
      $order->o_postal = $request->get('postal');
      $order->race_category = $request->get('race_category');
      $order->race_status = 'awaiting';
      $order->shipment = 'order placed';
      $order->race_id = $request->get('rid');
      $order->user_id = $request->get('uid');

      $engraveName = $request->get('engrave_name');

      if($engraveName == 'undefined') {
        $order->engrave_name = null;
      } else {
        $order->engrave_name = $engraveName;
      }

      $orderamount = $request->get('order_amount');

      //if race is not free update payment status to pending
      if($orderamount != '0.00') {
        $order->payment_status = 'pending';
      } else {
        //if race is race is free update payment status to paid
        $order->payment_status = 'paid';
      }

      $order->save();

      $oid = $order->oid;

      $all_addons = $request->get('addons_selected');

      $addons_selected = json_decode($all_addons);

      if (is_array($addons_selected) || is_object($addons_selected)) {
        foreach($addons_selected as $addon_selected) {
          $order_addon = new OrderAddon();
          $order_addon->order_id = $oid;
          $order_addon->addon_id = $addon_selected->aid;
          $order_addon->a_type = $addon_selected->type;
          $order_addon->save();
        }
      }

      //if race is free send race confirm email
      if($orderamount == '0.00') {
        $race = DB::table('races')
          ->join('orders', 'races.rid', '=', 'orders.race_id')
          ->where('oid', '=', $oid)
          ->first();

        $remark = 'Order for ' .$race->title_en. '(Order ID: ' .$oid. ')';

        $payment = new Payment();
        $payment->order_id = $oid;
        $payment->p_status = '1';
        $payment->amount_paid = '0.00';
        $payment->remark = $remark;
        $payment->save();

        $order = DB::table('orders')
          ->join('users', 'orders.user_id', '=', 'users.id')
          ->join('races', 'orders.race_id', '=', 'races.rid')
          ->join('payments', 'orders.oid', '=', 'payments.order_id')
          ->where('oid', '=', $oid)
          ->first();

        $email = DB::table('users')
          ->join('orders', 'users.id', '=', 'orders.user_id')
          ->where('id', '=', $order->user_id)
          ->get(['email']);

        Mail::send('email.sendConfirmEmail', ['order' => $order], function ($m) use ($order) {
          $m->from('info@wasportsrun.com', 'WaSportsRun');
          $m->to($order->email, $order->o_firstname)->subject('[WaSports] You had joined ' . $order->title_en);
        });
      }

      //generate digital signature
      $orderamount = $request->get('order_amount');
      $hashamount = str_replace('.','',str_replace(',','',$orderamount));
      $merchantkey = $this->merchantkey;
      $merchantcode = $this->merchantcode;
      $responseURL = $this->responseurl;
      $backendURL = $this->backendurl;
      $digital_signature = $merchantkey.$merchantcode.$oid.$hashamount.'MYR';
      $hashsign = hash('sha256', $digital_signature);

      return response()->json(['success' => true, 'oid' => $oid,
                                'hashsign' => $hashsign, 'merchantkey' => $merchantkey,
                                'merchantcode' => $merchantcode, 'responseURL' => $responseURL,
                                'backendURL' => $backendURL], 200);
    }

    public function viewMedals() {
      $user = Auth::user();

      $allmedals = DB::table('medals')
        ->leftjoin('orders', 'medals.races_id', '=', 'orders.race_id')
        ->join('races', 'medals.races_id', '=', 'races.rid')
        ->get();

      $joinedmedals = DB::table('medals')
        ->join('orders', 'medals.races_id', '=', 'orders.race_id')
        ->join('races', 'medals.races_id', '=', 'races.rid')
        ->where('user_id', '=', Auth::id())
        ->where('payment_status', '=', 'paid')
        ->get();

      $usermedals = DB::table('medals')
        ->leftjoin('orders', 'medals.races_id', '=', 'orders.race_id')
        ->join('races', 'medals.races_id', '=', 'races.rid')
        ->where('user_id', '=', Auth::id())
        ->where('race_status', '=', 'success')
        ->get();

      return view('user.medals', ['allmedals' => $allmedals, 'joinedmedals' => $joinedmedals,
                                  'usermedals' => $usermedals]);
    }

    public function viewJoined() {
      $user = Auth::user();
      date_default_timezone_set("Asia/Kuala_Lumpur");
      $date = date('Y-m-d');

      $current_races = DB::table('orders')
        ->join('races', 'races.rid', '=', 'race_id')
        ->where('user_id', '=', Auth::id())
        ->where('payment_status', '=', 'paid')
        ->where('date_to', '>', $date)
        ->orderBy('date_from', 'ASC')
        ->get();

      $past_races = DB::table('orders')
        ->join('races', 'races.rid', '=', 'race_id')
        ->where('user_id', '=', Auth::id())
        ->where('payment_status', '=', 'paid')
        ->where('date_to', '<', $date)
        ->orderBy('date_from', 'DESC')
        ->get();

      $now_races = DB::table('orders')
        ->join('races', 'races.rid', '=', 'race_id')
        ->where('user_id', '=', Auth::id())
        ->where('payment_status', '=', 'paid')
        ->where('date_to', '=', $date)
        ->get();

      $allmedals = DB::table('medals')->get();

      $submissions = DB::table('submissions')
        ->where('user_id', '=', Auth::id())
        ->get();

      $certdatas = DB::table('submissions')
        ->where('user_id', '=', Auth::id())
        ->orderBy('sid', 'DESC')
        ->get();

      return view('user.joined', ['user' => $user, 'current_races' => $current_races,
                                  'past_races' => $past_races, 'now_races' => $now_races,
                                  'allmedals' => $allmedals, 'submissions' => $submissions,
                                  'certdatas' => $certdatas]);
    }

    public function viewOrders() {
      $user = Auth::user();
      date_default_timezone_set("Asia/Kuala_Lumpur");
      $date = date('Y-m-d');

      $orders = DB::table('orders')
        ->join('races', 'races.rid', '=', 'race_id')
        ->where('user_id', '=', Auth::id())
        ->where('payment_status', '=', 'paid')
        ->orderBy('date_to', 'DESC')
        ->get();

      $order_addons = DB::table('order_addons')
        ->join('orders', 'orders.oid', '=', 'order_id')
        ->where('user_id', '=', Auth::id())
        ->get();

      $addons = DB::table('addons')->get();

      return view('user.orders', ['orders' => $orders, 'order_addons' => $order_addons,
                                  'addons' => $addons]);
    }

    public function handleRouteImg(Request $request){
      dd($request->file('routeimg'));
    }

    public function updateSubmission(Request $request){

      //update submission to order table
      $oid = $request->get('oid');
      //$order = Order::find($oid);

      //add submission to submission table
      $submit = new Submission();

      /*$order->race_hour = $request->get('race_hour');
      $order->race_minute = $request->get('race_minute');
      $order->race_second = $request->get('race_minute');
      $order->distance = $request->get('distance');*/

      $submit->order_id = $oid;
      $submit->user_id = $request->get('user_id');
      $submit->race_id = $request->get('race_id');
      $submit->s_hour = $request->get('race_hour');
      $submit->s_minute = $request->get('race_minute');
      $submit->s_second = $request->get('race_second');
      $submit->s_distance = $request->get('distance');
      $submit->strava_activity = $request->get('strava_activity');

      $map_polyline = $request->get('map_polyline');

      if($map_polyline == null) {
        $routeimg = $request->file('routeimg');
        if($routeimg != null) {
          $filenameWithExt = $oid;
          $filename =  str_replace(' ', '_', pathinfo($filenameWithExt, PATHINFO_FILENAME ));
          $ext = $routeimg->getClientOriginalExtension();
          $filenameToStore = $filename."_".time().".".$ext;
          $path = $routeimg->storeAs('public/uploaded/submissions/', $filenameToStore);
          //$order->routeimg = $filenameToStore;
          $submit->s_routeimg = $filenameToStore;
        }
      }

      if($map_polyline != null) {
        //$order->routeimg = null;
        //$order->map_polyline = $map_polyline;
        $submit->s_map_polyline = $map_polyline;
      }

      $distance = $request->get('distance');
      $hour =  $request->get('race_hour');
      $minute =  $request->get('race_minute');
      $second =  $request->get('race_second');

      $time_second = ($hour * 3600) + ($minute * 60) + $second;

      $pace = $time_second / $distance;

      //$pace_min = floor($pace / 60);
      //$pace_sec = $pace % 60;
      //$avg_pace = $pace_min. '"' .floor($pace_sec);

      $submit->s_pace_min = floor($pace / 60);
      $submit->s_pace_sec = floor($pace % 60);

      //$order->save();
      $submit->save();

      return response()->json(['success' => true], 200 );
    }

    public function deleteSubmission(Request $request){
      $sid = $request->get('sid');
      $submission = Submission::find($sid);
      $submission->delete();

      return response()->json(['success' => true], 200 );
    }

    public function callback() {

		  $expected_sign = $_POST['Signature'];
	    $merchantcode = $this->merchantcode;
      $merchantkey = $this->merchantkey;

		  $check_sign = '';
		  //$ipaySignature = '';
		  $str = '';
		  $HashAmount = '';
      $orderID = $_POST['RefNo'];
      $paymentID = $_POST['PaymentId'];
      $paymentStatus = $_POST['Status'];
      $amountPaid = $_POST['Amount'];
      $transID = $_POST['TransId'];
      $remark = $_POST['Remark'];
      $errDesc = $_POST['ErrDesc'];

		  $HashAmount = str_replace(array(',','.'), "", $_POST['Amount']);
		  $str = $merchantkey . $merchantcode . $paymentID .trim(stripslashes($orderID)). $HashAmount . $_POST['Currency'] . $paymentStatus;
      //$str = sha1($str);
      $check_sign = hash('sha256', $str);

	    /*for ($i=0;$i<strlen($str);$i=$i+2) {
        $ipaySignature .= chr(hexdec(substr($str,$i,2)));
		  }

		  $check_sign = base64_encode($ipaySignature);*/

      $payment = new Payment();
      $payment->check_sign = $check_sign;
      $payment->expected_sign = $expected_sign;
      $payment->order_id = $orderID;
      $payment->payment_id = $paymentID;
      $payment->p_status = $paymentStatus;
      $payment->amount_paid = $amountPaid;
      $payment->trans_id = $transID;
      $payment->remark = $remark . "(callback)";
      $payment->err_desc = $errDesc;
      $payment->save();

      //Payment success
	    if ($paymentStatus == "1" && $expected_sign == $check_sign) {
         //update order payment to success
         $order = Order::find($orderID);
         $order->payment_status = 'paid';
         $order->save();

         /*$race = DB::table('races')
           ->join('orders', 'races.rid', '=', 'orders.race_id')
           ->where('oid', '=', $orderID)
           ->first();

         $order = DB::table('orders')
           ->join('users', 'orders.user_id', '=', 'users.id')
           ->join('races', 'orders.race_id', '=', 'races.rid')
           ->join('payments', 'orders.oid', '=', 'payments.order_id')
           ->where('oid', '=', $orderID)
           ->first();

         $email = DB::table('users')
           ->join('orders', 'users.id', '=', 'orders.user_id')
           ->where('id', '=', $order->user_id)
           ->get(['email']);

         Mail::send('email.sendConfirmEmail', ['order' => $order], function ($m) use ($order) {
           $m->from('info@wasportsrun.com', 'WaSportsRun');
           $m->to($order->email, $order->o_firstname)->subject('[WaSports] You had joined ' . $order->title_en);
         });*/

         return view('payment.paymentsuccess');

		  } else { return view('payment.paymentfailure'); }

	}

  public function backendcallback() {

    $expected_sign = $_POST['Signature'];
    $merchantcode = $this->merchantcode;
    $merchantkey = $this->merchantkey;

    $check_sign = '';
    //$ipaySignature = '';
    $str = '';
    $HashAmount = '';
    $orderID = $_POST['RefNo'];
    $paymentID = $_POST['PaymentId'];
    $paymentStatus = $_POST['Status'];
    $amountPaid = $_POST['Amount'];
    $transID = $_POST['TransId'];
    $remark = $_POST['Remark'];
    $errDesc = $_POST['ErrDesc'];

    $HashAmount = str_replace(array(',','.'), "", $_POST['Amount']);
    $str = $merchantkey . $merchantcode . $paymentID .trim(stripslashes($orderID)). $HashAmount . $_POST['Currency'] . $paymentStatus;
    //$str = sha1($str);
    $check_sign = hash('sha256', $str);

    /*for ($i=0;$i<strlen($str);$i=$i+2) {
      $ipaySignature .= chr(hexdec(substr($str,$i,2)));
    }

    $check_sign = base64_encode($ipaySignature);*/

    $payment = new Payment();
    $payment->check_sign = $check_sign;
    $payment->expected_sign = $expected_sign;
    $payment->order_id = $orderID;
    $payment->payment_id = $paymentID;
    $payment->p_status = $paymentStatus;
    $payment->amount_paid = $amountPaid;
    $payment->trans_id = $transID;
    $payment->remark = $remark . "(backend)";
    $payment->err_desc = $errDesc;
    $payment->save();

    /*for ($i=0;$i<strlen($str);$i=$i+2) {
      $ipaySignature .= chr(hexdec(substr($str,$i,2)));
    }

    $check_sign = base64_encode($ipaySignature);*/

    //Payment success
     if ($paymentStatus == "1" && $expected_sign == $check_sign) {

       return view('payment.paymentsuccessbackend');

     } else { return view('payment.paymentfailure'); }
   }
}
