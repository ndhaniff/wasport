<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Model\Race;
use App\Model\User;
use App\Model\Contact;
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

    public function aboutus(){
      return view('pages.aboutus');
    }

    public function guide(){
      return view('pages.guide');
    }

    public function howitworks(){
      return view('pages.howitworks');
    }

    public function privacypolicy(){
      return view('pages.privacypolicy');
    }

    public function relatedCooperation(){
      return view('pages.relatedcooperation');
    }

    public function termsandconditions(){
      return view('pages.termsandconditions');
    }

    public function registersuccess(){
      return view('pages.registersuccess');
    }

}
