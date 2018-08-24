<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\API\StravaController;

use Auth;

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

    public function dashboard(request $request){

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
      
      return view('user.dashboard')->with('user',$user);
    }
}
