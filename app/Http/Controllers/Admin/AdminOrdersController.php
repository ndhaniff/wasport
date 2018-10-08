<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Model\Order;
use App\Model\Race;
use App\Model\Addon;
use App\Model\User;
use Kyslik\ColumnSortable\Sortable;

class AdminOrdersController extends Controller
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
     * Show the medals list
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $orders = Order::sortable()->paginate(10);
      $races = Race::sortable()->get();
      $addons = Addon::sortable()->get();
      $users = User::sortable()->get();

      return view('auth.admin.orders.index',compact('orders', 'races', 'addons'));
    }

    public function search(Request $request)
    {
      $search = $request->get('search');
      $field = $request->get('field');

      $orders = Order::sortable()->where($field, 'like', '%' .$search. '%')->paginate(10);

      $races = DB::table('races')->get();
      $addons = DB::table('addons')->get();

      return view('auth.admin.medals.index',compact('orders', 'races', 'addons'));
    }

    public function filter(Request $request)
    {
      $raceitem = $request->get('raceitem');
      $medals = DB::table('medals')->where('races_id', 'like', $raceitem)->paginate(10);
      $races = DB::table('races')->get();
      $allmedals = Medal::sortable()->get();

      return view('auth.admin.medals.index',compact('medals', 'races', 'allmedals'));
    }

    public function editForm($oid){

    }

    /**
     * Edit Medals
     *
     * @param Request $request
     * @return void
     */
    public function edit(Request $request)
    {

    }

     /**
      * Delete Medals
      *
      * @param [int] $id
      * @return void
      */
    public function destroy($oid)
    {
        $order = Order::find($oid);
        if($order->count()  > 0){
            $order->delete();
            return redirect()->back();
        } else {
            return response()->json(['success' => false, 'msg' => 'order not found' ], 200 );
        }
    }
}
