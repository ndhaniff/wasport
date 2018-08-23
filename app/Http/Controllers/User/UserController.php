<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

    public function dashboard(){
      $user = Auth::user();
      return view('user.dashboard')->with('user',$user);
    }
}
