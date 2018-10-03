<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
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
      $orders = Medal::sortable()->paginate(10);
      $races = Race::sortable()->get();
      $addons = Addon::sortable()->get();
      $users = User::sortable()->get();

      return view('auth.admin.orders.index',compact('orders', 'races', 'addons'));
    }

    public function search(Request $request)
    {
      $search = $request->get('search');
      $medals = Medal::sortable()->where('name', 'like', '%' .$search. '%')->paginate(10);
      $races = DB::table('races')->get();
      $allmedals = Medal::sortable()->get();

      return view('auth.admin.medals.index',compact('medals', 'races', 'allmedals'));
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
        $orders = DB::table('orders')->where('oid','=', $oid)->first();
        $races = DB::table('races')->where('races_id' = )->get();
        $addons = DB::table('addons')->get();
        $users = DB::table('users')->get();

        return view('auth.admin.medals.edit', ['order' => $order, 'races' => $races]);
    }

    /**
     * Edit Medals
     *
     * @param Request $request
     * @return void
     */
    public function edit(Request $request)
    {
      //validate request server side
      $request->validate([
          'name' => 'required|string',
      ]);

      $formdata = [
        'name' => $request->get('name'),
        'medal_grey' => $request->get('medal_grey'),
        'medal_color' => $request->get('medal_color'),
        'cert' => $request->get('cert'),
        'bib' => $request->get('bib'),
        'races_id' => $request->get('races_id'),
        'mid' => $request->get('mid')
      ];


      $medal = Medal::find($formdata['mid']);
      $medal->name = $formdata['name'];
      $medal->medal_grey = $formdata['medal_grey'];
      $medal->medal_color = $formdata['medal_color'];
      $medal->cert = $formdata['cert'];
      $medal->bib = $formdata['bib'];
      $medal->races_id = $formdata['races_id'];

      //handle grey medal
      if($request->hasFile('medal_grey')){
           $medal_grey = $request->file('medal_grey');
           $filenameWithExt = $medal_grey->getClientOriginalName();
           $filename =  str_replace(' ', '_', pathinfo($filenameWithExt, PATHINFO_FILENAME ));
           $ext = $medal_grey->getClientOriginalExtension();
           $filenameToStore = $filename."_".time().".".$ext;
           $path = $medal_grey->storeAs('public/uploaded/medals/grey/', $filenameToStore);
           $medal->medal_grey = $filenameToStore;
       }

      //handle color medal
      if($request->hasFile('medal_color')){
           $medal_color = $request->file('medal_color');
           $filenameWithExt = $medal_color->getClientOriginalName();
           $filename =  str_replace(' ', '_', pathinfo($filenameWithExt, PATHINFO_FILENAME ));
           $ext = $medal_color->getClientOriginalExtension();
           $filenameToStore = $filename."_".time().".".$ext;
           $path = $medal_color->storeAs('public/uploaded/medals/color/', $filenameToStore);
           $medal->medal_color = $filenameToStore;
       }

      //handle cert
      if($request->hasFile('cert')){
           $cert = $request->file('cert');
           $filenameWithExt = $cert->getClientOriginalName();
           $filename =  str_replace(' ', '_', pathinfo($filenameWithExt, PATHINFO_FILENAME ));
           $ext = $medal_color->getClientOriginalExtension();
           $filenameToStore = $filename."_".time().".".$ext;
           $path = $cert->storeAs('public/uploaded/cert/', $filenameToStore);
           $medal->cert = $filenameToStore;
       }


      //handle bib
      if($request->hasFile('bib')){
           $bib = $request->file('bib');
           $filenameWithExt = $bib->getClientOriginalName();
           $filename =  str_replace(' ', '_', pathinfo($filenameWithExt, PATHINFO_FILENAME ));
           $ext = $bib->getClientOriginalExtension();
           $filenameToStore = $filename."_".time().".".$ext;
           $path = $bib->storeAs('public/uploaded/bib/', $filenameToStore);
           $medal->bib = $filenameToStore;
       }

      $medal->save();

      return response()->json(['success' => true, 'mid' => $medal->mid ], 200 );
    }

     /**
      * Delete Medals
      *
      * @param [int] $id
      * @return void
      */
    public function destroy($mid)
    {
        $medal = Medal::find($mid);
        if($medal->count()  > 0){
            $medal->delete();
            return redirect()->back();
        } else {
            return response()->json(['success' => false, 'msg' => 'medal not found' ], 200 );
        }
    }
}
