<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Laracasts\Flash\Flash;
use App\Http\Controllers\API\StravaController;
use App\Model\User;
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

      return view('user.dashboard')->with('user',$user);
    }

    public function updateProfile(Request $request){

      $id = $request->get('id');

      $user = User::find($id);
      $user->name = $request->get('name');
      $user->firstname = $request->get('firstname');
      $user->lastname = $request->get('lastname');
      $user->motto = $request->get('motto');
      $user->gender = $request->get('gender');
      $user->phone = $request->get('phone');
      $user->birthday = $request->get('birthday');

      //handle profile img
      if($request->hasFile('profileimg')){
          $profileimg = $request->file('profileimg');
          $filenameWithExt = $profile->getClientOriginalName();
          $filename =  str_replace(' ', '_', pathinfo($filenameWithExt, PATHINFO_FILENAME ));
          $ext = $profile->getClientOriginalExtension();
          $filenameToStore = $filename."_".time().".".$ext;
          $path = $profile->storeAs('public/uploaded/users', $filenameToStore);
      }

      $race->header = $filenameToStore;

      $user->save();

      return response()->json(['success' => true], 200 );
    }

    public function handleProfileImg(Request $request){
      dd($request->file('avatar'));
    }
}
