<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Model\Order;
use App\Model\OrderAddon;
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
     * Show the order list
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $orders = Order::sortable()->paginate(10);
      $races = Race::sortable()->get();
      $addons = Addon::sortable()->get();
      $users = User::sortable()->get();
      $order_addons = OrderAddon::sortable()->get();
      $allorders= Order::sortable()->get();

      return view('auth.admin.orders.index',compact('orders', 'races', 'addons', 'order_addons', 'allorders'));
    }

    public function search(Request $request)
    {
      $search = $request->get('search');
      $field = $request->get('field');

      $orders = Order::sortable()->where($field, 'like', '%' .$search. '%')->paginate(10);
      $races = DB::table('races')->get();
      $addons = DB::table('addons')->get();
      $allorders = Order::sortable()->get();

      return view('auth.admin.orders.index',compact('orders', 'races', 'addons', 'allorders'));
    }

    public function filter(Request $request)
    {
      $raceitem = $request->get('raceitem');
      $orders = DB::table('orders')->where('race_id', 'like', $raceitem)->paginate(10);
      $races = DB::table('races')->get();
      $allorders = Order::sortable()->get();
      $order_addons = OrderAddon::sortable()->get();
      $addons = Addon::sortable()->get();
      $users = User::sortable()->get();

      return view('auth.admin.orders.index',compact('orders', 'races', 'addons', 'users', 'order_addons', 'allorders'));
    }

    public function editForm($oid){

    }

    /**
     * Edit Order
     *
     * @param Request $request
     * @return void
     */
    public function edit(Request $request)
    {

    }

     /**
      * Delete Orders
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
