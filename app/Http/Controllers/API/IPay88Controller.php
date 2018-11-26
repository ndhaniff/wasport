<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ixudra\Curl\Facades\Curl;
use App\Model\Order;
use App\Model\OrderAddon;
use Auth;
use DB;

class Ipay88ControllerController extends Controller
{
  private $merchantcode = 'M18793';
  private $merchantkey = 'flICG0S4Ul';
  private $responseurl = 'http://localhost:8000/payment/ipay88/callback';
  private $backendurl = 'http://localhost:8000/payment/ipay88/backendcallback';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
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
      $order->payment_status = 'pending';
      $order->shipment = 'order placed';
      $order->race_id = $request->get('rid');
      $order->user_id = $request->get('uid');

      $engraveName = $request->get('engrave_name');

      if($engraveName == 'undefined') {
        $order->engrave_name = null;
      } else {
        $order->engrave_name = $engraveName;
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

      //generate digial signature
      $orderamount = $request->get('order_amount');
      $digital_signature = $merchantkey.$merchantcode.$oid.$orderamount.'MYR';
      $hashsign = hash('sha256', $digital_signature);

      return response()->json(['success' => true, 'oid' => $oid, 'hashsign' => $hashsign], 200);
    }

    public function makePayment(Request $request) {

      $id = $request->get('id');
      $access_token = $request->get('access_token');
      $url = 'https://payment.ipay88.com.my/epayment/entry.asp';

      $ch = curl_init();

      curl_setopt_array($ch,array(
         CURLOPT_URL => $url,
         CURLOPT_HTTPHEADER => array('Accept: application/json'),
         CURLOPT_RETURNTRANSFER => true,
     ));

     $json_response = curl_exec($ch);
     $http_response_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

     if ($http_response_code == 401) {
         throw new \Exception('Error: getOAuthToken() - Access has been revoked.');
     }

     curl_close($ch);
     return response()->json(["success" => true, "data" => json_decode($json_response)]);

      paymentdata.append('MerchantCode', merchantcode)
      paymentdata.append('RefNo', order_id)
      paymentdata.append('Amount', order_amount)
      paymentdata.append('Currency', 'MYR')
      paymentdata.append('ProdDesc', order_desc)
      paymentdata.append('UserName', order_name)
      paymentdata.append('UserEmail', order_email)
      paymentdata.append('UserContact', order_phone)
      paymentdata.append('Remark', order_remarks)
      paymentdata.append('Lang', 'UTF-8')
      paymentdata.append('Signature', signature)
    }
  }
