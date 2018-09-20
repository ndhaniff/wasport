<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Model\User;
use Kyslik\ColumnSortable\Sortable;

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

    /**
     * Show create users form
     *
     * @return void
     */
    public function create()
    {
        
    }

    /**
     * Insert users data to db
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {

    }

    public function editForm($id){

    }

    /**
     * Edit users
     *
     * @param Request $request
     * @return void
     */
    public function edit(Request $request)
    {

    }

    /**
     * Duplicate users
     *
     * @param [int] $id
     * @return void
     */
    public function duplicate($id)
    {

    }

     /**
      * Delete users
      *
      * @param [int] $id
      * @return void
      */
    public function destroy($id)
    {

    }
}
