<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Addon;
use App\Model\Race;
use DB;

class AdminAddonsController extends Controller
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
     * Show the addons list
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //$addons = DB::table('addons')->join('races', 'races.id', '=', 'races_id')->get();

      $addons = DB::table('addons')->get();
      $races = DB::table('races')->get();

      return view('auth.admin.addons.index', ['addons' => $addons, 'races' => $races]);
    }

    /**
     * Show create addons form
     *
     * @return void
     */
    public function create()
    {
        $races = DB::table('races')->get();

        return view('auth.admin.addons.create', ['races' => $races]);
    }

    /**
     * Insert Addons data to db
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        //validate request server side
        $request->validate([
            'add_en' => 'required|string',
            'desc_en' => 'required|string',
            'addprice' => 'required|string',
        ]);

        $formdata = [
            'add_en' => $request->get('add_en'),
            'add_ms' => $request->get('add_ms'),
            'add_zh' => $request->get('add_zh'),
            'desc_en' => $request->get('desc_en'),
            'desc_ms' => $request->get('desc_ms'),
            'desc_zh' => $request->get('desc_zh'),
            'addprice' => $request->get('addprice'),
            'type' => $request->get('type'),
            'races_id' => $request->get('races_id'),
        ];

        $addons = new Addon();
        $addons->add_en = $formdata['add_en'];
        $addons->add_ms = $formdata['add_ms'];
        $addons->add_zh = $formdata['add_zh'];
        $addons->desc_en = $formdata['desc_en'];
        $addons->desc_ms = $formdata['desc_ms'];
        $addons->desc_zh = $formdata['desc_zh'];
        $addons->addprice = $formdata['addprice'];
        $addons->type = $formdata['type'];
        $addons->races_id = $formdata['races_id'];

        $addons->save();

        return response()->json(['success' => true, 'id' => $addons->id ], 200 );
    }

    public function editForm($id){
        $addons = DB::table('addons')->where('id','=', $id)->first();
        $races = DB::table('races')->get();

        return view('auth.admin.addons.edit', ['addons' => $addons, 'races' => $races]);
    }

    /**
     * Edit Addons
     *
     * @param Request $request
     * @return void
     */
    public function edit(Request $request)
    {
      //validate request server side
      $request->validate([
          'add_en' => 'required|string',
          'desc_en' => 'required|string',
          'addprice' => 'required|string',
      ]);

      $formdata = [
          'add_en' => $request->get('add_en'),
          'add_ms' => $request->get('add_ms'),
          'add_zh' => $request->get('add_zh'),
          'desc_en' => $request->get('desc_en'),
          'desc_ms' => $request->get('desc_ms'),
          'desc_zh' => $request->get('desc_zh'),
          'addprice' => $request->get('addprice'),
          'type' => $request->get('type'),
          'races_id' => $request->get('races_id'),
          'id' => $request->get('id')
      ];


      $addons = Addon::find($formdata['id']);
      $addons->add_en = $formdata['add_en'];
      $addons->add_ms = $formdata['add_ms'];
      $addons->add_zh = $formdata['add_zh'];
      $addons->desc_en = $formdata['desc_en'];
      $addons->desc_ms = $formdata['desc_ms'];
      $addons->desc_zh = $formdata['desc_zh'];
      $addons->addprice = $formdata['addprice'];
      $addons->type = $formdata['type'];
      $addons->races_id = $formdata['races_id'];

      $addons->save();

      return response()->json(['success' => true, 'id' => $addons->id ], 200 );
    }

    /**
     * Duplicate Addons
     *
     * @param [int] $id
     * @return void
     */
    public function duplicate($id)
    {
        $addons = Addon::find($id);
        if($addons->count()  > 0){
            $addons = Addon::find($id);
            $newAddons = $addons->replicate();
            $newAddons->save();
            return redirect()->back();
        } else {
            return response()->json(['success' => false, 'msg' => 'error' ], 200 );
        }
    }

     /**
      * Delete Addons
      *
      * @param [int] $id
      * @return void
      */
    public function destroy($id)
    {
        $addons = Addon::find($id);
        if($addons->count()  > 0){
            $addons->delete();
            return redirect()->back();
        } else {
            return response()->json(['success' => false, 'msg' => 'addon not found' ], 200 );
        }
    }
}
