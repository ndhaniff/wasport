<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Race;
use App\Model\Addon;
use App\Model\Order;
use App\Model\User;
use Auth;
use DB;

class RacesController extends Controller
{
    public function index(){

        $date = date('Y-m-d');

        $new = DB::table('races')
          ->where('date_to', '>', $date)
          ->orderBy('date_from', 'ASC')
          ->get();

        $old = DB::table('races')
          ->where('date_to', '<', $date)
          ->orderBy('date_from', 'DESC')
          ->get();

        return view('pages.races', ['new' => $new, 'old' => $old]);
    }

    public function details($rid) {

      $race = DB::table('races')
        ->where('rid', '=', $rid)
        ->first();

      $addons = DB::table('addons')
        ->where('races_id', '=', $rid)
        ->get();

      return view('pages.racedetails', ['race' => $race, 'addons' => $addons]);
    }

    public function registerRace($rid) {
      $race = DB::table('races')
        ->where('rid', '=', $rid)
        ->first();

      $addons = DB::table('addons')
        ->where('races_id', '=', $rid)
        ->get();

      if (Auth::check())
      {
        $user = Auth::user();
        return view('pages.registerrace', ['user' => $user, 'race' => $race, 'addons' => $addon]);
      } else {
        return view('pages.registerrace');
      }
    }
}
