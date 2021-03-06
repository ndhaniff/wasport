<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Race;
use App\Model\Addon;
use App\Model\Order;
use App\Model\OrderAddon;
use App\Model\Submission;
use App\Model\Offline;
use DB;
use Auth;

class RacesController extends Controller
{
    public function index(){

        $date = date('Y-m-d');

        $new = DB::table('races')
          ->where('date_to', '>', $date)
          ->orderBy('date_from', 'DESC')
          ->get();

        $old = DB::table('races')
          ->where('date_to', '<', $date)
          ->orderBy('date_from', 'DESC')
          ->get();

        $current = DB::table('races')
          ->where('date_to', '=', $date)
          ->orderBy('date_from', 'DESC')
          ->get();

        return view('pages.races', ['new' => $new, 'old' => $old, 'current' => $current]);
    }

    public function details($rid) {

      $user = Auth::user();

      $race = DB::table('races')
        ->where('rid', '=', $rid)
        ->first();

      $addons = DB::table('addons')
        ->where('races_id', '=', $rid)
        ->get();

      $orders = DB::table('orders')
        ->where('user_id', '=', Auth::id())
        ->where('race_id', '=', $rid)
        ->get();

      $date = date('Y-m-d');

      $new = DB::table('races')
        ->where('date_to', '>', $date)
        ->orderBy('date_from', 'ASC')
        ->limit(3)
        ->get();

      if (Auth::check())
      {
        $user = Auth::user();
        return view('pages.racedetails', ['new' => $new, 'user' => $user, 'race' => $race, 'addons' => $addons, 'orders' => $orders]);
      } else {
        return view('pages.racedetails', ['new' => $new, 'race' => $race, 'addons' => $addons, 'orders' => $orders]);
      }

      //return view('pages.racedetails', ['race' => $race, 'addons' => $addons, 'orders' => $orders]);
    }

    public function ranking($rid) {

      $race = DB::table('races')
        ->where('rid', '=', $rid)
        ->first();

      $orders = DB::table('orders')
        ->where('race_id', '=', $rid)
        ->where('race_status', '=', 'success')
        ->orderBy('pace_min', 'ASC')
        ->orderBy('pace_sec', 'ASC')
        ->paginate(10);

      return view('pages.ranking', ['race' => $race, 'orders' => $orders]);
      //return view('pages.ranking',compact('race', 'orders'));
    }

    public function offline(){
      $offlines = DB::table('offlines')
        ->orderBy('date', 'DESC')
        ->get();

      return view('pages.offlineraces', ['offlines' => $offlines]);
    }

    public function offlinedetails($fid){
      $offline = DB::table('offlines')
        ->where('fid', '=', $fid)
        ->first();

      return view('pages.offlinedetails', ['offline' => $offline]);
    }
}
