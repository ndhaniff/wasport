<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Model\User;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminUsersController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the users list
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $users = User::sortable()->paginate(10);

      return view('auth.admin.users.index',compact('users'));
    }

    public function search(Request $request)
    {
      $search = $request->get('search');
      $field = $request->get('field');
      $users = User::sortable()->where($field, 'like', '%' .$search. '%')->paginate(10);

      return view('auth.admin.users.index',compact('users'));
    }

    public function editForm($id){
        $user = DB::table('users')->where('id','=', $id)->first();

        return view('auth.admin.users.edit', ['user' => $user]);
    }

    /**
     * Edit users
     *
     * @param Request $request
     * @return void
     */
    public function edit(Request $request)
    {

      $request->validate([
          'name' => 'required|string',
          'email' => 'required|string',
      ]);

      $formdata = [
        'name' => $request->get('name'),
        'email' => $request->get('email'),
        'firstname' => $request->get('firstname'),
        'lastname' => $request->get('lastname'),
        'motto' => $request->get('motto'),
        'phone' => $request->get('phone'),
        'gender' => $request->get('gender'),
        'add_fl' => $request->get('add_fl'),
        'add_sl' => $request->get('add_sl'),
        'city' => $request->get('city'),
        'state' => $request->get('state'),
        'postal' => $request->get('postal'),
        'id' => $request->get('id')
      ];

      $user = User::find($formdata['id']);
      $user->name = $formdata['name'];
      $user->email = $formdata['email'];
      $user->firstname = $formdata['firstname'];
      $user->lastname = $formdata['lastname'];
      $user->motto = $formdata['motto'];
      $user->phone = '601' . $formdata['phone'];
      $user->gender = $formdata['gender'];
      $user->add_fl = $formdata['add_fl'];
      $user->add_sl = $formdata['add_sl'];
      $user->city = $formdata['city'];
      $user->state = $formdata['state'];
      $user->postal = $formdata['postal'];

      //handle profile img
      if($request->hasFile('profileimg')){
           $profileimg = $request->file('profileimg');
           $filenameWithExt = $profileimg->getClientOriginalName();
           $filename =  str_replace(' ', '_', pathinfo($filenameWithExt, PATHINFO_FILENAME ));
           $ext = $profileeimg->getClientOriginalExtension();
           $filenameToStore = $filename."_".time().".".$ext;
           $path = $profileimg->storeAs('public/uploaded/users/', $filenameToStore);
       } else {
           $filenameToStore = '';
       }

      $user->save();

      return response()->json(['success' => true, 'id' => $user->id ], 200 );
    }

    public function block($id)
    {
      $user = User::find($id);

      $user->status = 0;
      $user->save();

      return redirect()->back();
    }

    public function unblock($id)
    {
      $user = User::find($id);
      $user->status = 1;
      $user->save();

      return redirect()->back();
    }

    public function resetForm($id)
    {
      $user = DB::table('users')->where('id','=', $id)->first();

      return view('auth.admin.users.reset', ['user' => $user]);
    }

    public function reset(Request $request)
    {

      $request->validate([
          'password' => 'required',
      ]);

      $formdata = [
        'password' => $request->get('password'),
        'id' => $request->get('id')
      ];

      $user = User::find($formdata['id']);
      $user->password = Hash::make($formdata['password']);

      $user->save();

      return response()->json(['success' => true, 200]);
    }

     /**
      * Delete users
      *
      * @param [int] $id
      * @return void
      */
    public function destroy($id)
    {
      $user = User::find($id);
      if($user->count()  > 0){
          $user->delete();
          return redirect()->back();
      } else {
          return response()->json(['success' => false, 'msg' => 'user not found' ], 200 );
      }
    }
}
