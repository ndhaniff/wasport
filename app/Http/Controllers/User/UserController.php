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
use Auth;
use DB;

class UserController extends Controller
{
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
        ->where('dead_from', '>', $date)
        ->orderBy('date_from')
        ->limit(3)
        ->get();

      $number_count = DB::table('orders')
        ->where('user_id', '=', Auth::id())
        ->get();

      $date = date('Y-m-d');

      $latest_race = DB::table('orders')
        ->join('races', 'races.rid', '=', 'race_id')
        ->where('user_id', '=', Auth::id())
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
      $order->o_add_fl = $request->get('add_fl');
      $order->o_add_sl = $request->get('add_sl');
      $order->o_city = $request->get('city');
      $order->o_state = $request->get('state');
      $order->o_postal = $request->get('postal');
      $order->race_category = $request->get('race_category');
      $order->engrave_name = $request->get('engrave_name');
      $order->race_status = 'awaiting';
      $order->race_id = $request->get('rid');
      $order->user_id = $request->get('uid');

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

      return response()->json(['success' => true], 200);
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
        ->where('date_to', '>', $date)
        ->orderBy('date_from', 'ASC')
        ->get();

      $past_races = DB::table('orders')
        ->join('races', 'races.rid', '=', 'race_id')
        ->where('user_id', '=', Auth::id())
        ->where('date_to', '<', $date)
        ->orderBy('date_from', 'DESC')
        ->get();

      $now_races = DB::table('orders')
        ->join('races', 'races.rid', '=', 'race_id')
        ->where('user_id', '=', Auth::id())
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
      $submit->s_second = $request->get('race_minute');
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
}
