<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Race;
use DB;

class HomeController extends Controller
{
    public function index(){

        $date = date('Y-m-d');

        $new = DB::table('races')
          ->where('date_from', '>', $date)
          ->orderBy('date_from')
          ->first();

        $old = DB::table('races')
          ->where('date_from', '<', $date)
          ->orderBy('date_from', 'DESC')
          ->first();

        return view('pages.index', ['new' => $new, 'old' => $old]);
    }

    public function howitworks(){
        return view('pages.howitworks');
    }

    public function privacypolicy(){
        return view('pages.privacypolicy');
    }
}
