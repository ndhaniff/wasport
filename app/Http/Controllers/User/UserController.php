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

      $medals = DB::table('medals')
        ->join('races', 'medals.races_id', '=', 'races.rid')
        ->limit(3)
        ->get();

      //return view('user.dashboard')->with('user',$user);
      return view('user.dashboard', ['user' => $user, 'races' => $races, 'medals' => $medals]);
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

    public function viewMedals() {

      $medals = DB::table('medals')
                ->join('races', 'medals.races_id', '=', 'races.rid')
                ->get();

      return view('user.medals', ['medals' => $medals]);
    }

    public function registerRace($rid) {
      $user = Auth::user();

      $date = date('Y-m-d');

      $new = DB::table('races')
        ->where('date_to', '>', $date)
        ->orderBy('date_from', 'ASC')
        ->limit(3)
        ->get();

      $race = DB::table('races')
        ->where('rid', '=', $rid)
        ->first();

      $addons = DB::table('addons')
        ->where('races_id', '=', $rid)
        ->get();

      if (Auth::check())
      {
        $user = Auth::user();
        return view('pages.registerrace', ['new' => $new, 'user' => $user, 'race' => $race, 'addons' => $addons]);
      } else {
        return view('pages.registerrace', ['new' => $new, 'race' => $race, 'addons' => $addons]);
      }
    }

}
