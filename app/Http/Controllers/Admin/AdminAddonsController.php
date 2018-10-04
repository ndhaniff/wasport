<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Model\Addon;
use App\Model\Race;
use Kyslik\ColumnSortable\Sortable;

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

      //$addons = DB::table('addons')->Sortable()->paginate(10);
      //$races = DB::table('races')->get();

      //return view('auth.admin.addons.index', ['addons' => $addons, 'races' => $races]);

      $addons = Addon::sortable()->paginate(10);
      $races = Race::sortable()->get();
      $alladdons = Addon::sortable()->get();

      return view('auth.admin.addons.index',compact('addons', 'races', 'alladdons'));
    }

    public function search(Request $request)
    {
      $search = $request->get('search');
      $addons = Addon::sortable()->where('add_en', 'like', '%' .$search. '%')->paginate(10);
      $races = DB::table('races')->get();
      $alladdons = Addon::sortable()->get();

      return view('auth.admin.addons.index',compact('addons', 'races', 'alladdons'));
    }

    public function filter(Request $request)
    {
      $raceitem = $request->get('raceitem');
      $addons = DB::table('addons')->where('races_id', 'like', $raceitem)->paginate(10);
      $races = DB::table('races')->get();
      $alladdons = Addon::sortable()->get();

      return view('auth.admin.addons.index',compact('addons', 'races', 'alladdons'));
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
            'addprice' => 'required',
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

        //handle descimg 1
        if($request->hasFile('descimg_1')){
             $descimg_1 = $request->file('descimg_1');
             $filenameWithExt = $descimg_1->getClientOriginalName();
             $filename =  str_replace(' ', '_', pathinfo($filenameWithExt, PATHINFO_FILENAME ));
             $ext = $descimg_1->getClientOriginalExtension();
             $filenameToStore = $filename."_".time().".".$ext;
             $path = $descimg_1->storeAs('public/uploaded/addons/', $filenameToStore);
             $addons->descimg_1 = $filenameToStore;
        }

        //handle descimg 2
        if($request->hasFile('descimg_2')){
             $descimg_2 = $request->file('descimg_2');
             $filenameWithExt = $descimg_1->getClientOriginalName();
             $filename =  str_replace(' ', '_', pathinfo($filenameWithExt, PATHINFO_FILENAME ));
             $ext = $descimg_2->getClientOriginalExtension();
             $filenameToStore = $filename."_".time().".".$ext;
             $path = $descimg_2->storeAs('public/uploaded/addons/', $filenameToStore);
             $addons->descimg_2 = $filenameToStore;
        }

        //handle descimg 3
        if($request->hasFile('descimg_3')){
             $descimg_3 = $request->file('descimg_3');
             $filenameWithExt = $descimg_3->getClientOriginalName();
             $filename =  str_replace(' ', '_', pathinfo($filenameWithExt, PATHINFO_FILENAME ));
             $ext = $descimg_3->getClientOriginalExtension();
             $filenameToStore = $filename."_".time().".".$ext;
             $path = $descimg_3->storeAs('public/uploaded/addons/', $filenameToStore);
             $addons->descimg_3 = $filenameToStore;
        }

        //handle descimg 4
        if($request->hasFile('descimg_4')){
             $descimg_4 = $request->file('descimg_4');
             $filenameWithExt = $descimg_4->getClientOriginalName();
             $filename =  str_replace(' ', '_', pathinfo($filenameWithExt, PATHINFO_FILENAME ));
             $ext = $descimg_4->getClientOriginalExtension();
             $filenameToStore = $filename."_".time().".".$ext;
             $path = $descimg_4->storeAs('public/uploaded/addons/', $filenameToStore);
             $addons->descimg_4 = $filenameToStore;
        }

        //handle descimg 5
        if($request->hasFile('descimg_5')){
             $descimg_5 = $request->file('descimg_5');
             $filenameWithExt = $descimg_5->getClientOriginalName();
             $filename =  str_replace(' ', '_', pathinfo($filenameWithExt, PATHINFO_FILENAME ));
             $ext = $descimg_5->getClientOriginalExtension();
             $filenameToStore = $filename."_".time().".".$ext;
             $path = $descimg_5->storeAs('public/uploaded/addons/', $filenameToStore);
             $addons->descimg_5 = $filenameToStore;
        }

        //handle descimg 6
        if($request->hasFile('descimg_6')){
             $descimg_6 = $request->file('descimg_6');
             $filenameWithExt = $descimg_6->getClientOriginalName();
             $filename =  str_replace(' ', '_', pathinfo($filenameWithExt, PATHINFO_FILENAME ));
             $ext = $descimg_6->getClientOriginalExtension();
             $filenameToStore = $filename."_".time().".".$ext;
             $path = $descimg_6->storeAs('public/uploaded/addons/', $filenameToStore);
             $addons->descimg_6 = $filenameToStore;
        }

        $addons->save();

        return response()->json(['success' => true, 'aid' => $addons->aid ], 200 );
    }

    public function editForm($aid){
        $addons = DB::table('addons')->where('aid','=', $aid)->first();
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
          'aid' => $request->get('aid')
      ];


      $addons = Addon::find($formdata['aid']);
      $addons->add_en = $formdata['add_en'];
      $addons->add_ms = $formdata['add_ms'];
      $addons->add_zh = $formdata['add_zh'];
      $addons->desc_en = $formdata['desc_en'];
      $addons->desc_ms = $formdata['desc_ms'];
      $addons->desc_zh = $formdata['desc_zh'];
      $addons->addprice = $formdata['addprice'];
      $addons->type = $formdata['type'];
      $addons->races_id = $formdata['races_id'];

      //handle descimg 1
      if($request->hasFile('descimg_1')){
           $descimg_1 = $request->file('descimg_1');
           $filenameWithExt = $descimg_1->getClientOriginalName();
           $filename =  str_replace(' ', '_', pathinfo($filenameWithExt, PATHINFO_FILENAME ));
           $ext = $descimg_1->getClientOriginalExtension();
           $filenameToStore = $filename."_".time().".".$ext;
           $path = $descimg_1->storeAs('public/uploaded/addons/', $filenameToStore);
           $addons->descimg_1 = $filenameToStore;
      }

      //handle descimg 2
      if($request->hasFile('descimg_2')){
           $descimg_2 = $request->file('descimg_2');
           $filenameWithExt = $descimg_1->getClientOriginalName();
           $filename =  str_replace(' ', '_', pathinfo($filenameWithExt, PATHINFO_FILENAME ));
           $ext = $descimg_2->getClientOriginalExtension();
           $filenameToStore = $filename."_".time().".".$ext;
           $path = $descimg_2->storeAs('public/uploaded/addons/', $filenameToStore);
           $addons->descimg_2 = $filenameToStore;
      }

      //handle descimg 3
      if($request->hasFile('descimg_3')){
           $descimg_3 = $request->file('descimg_3');
           $filenameWithExt = $descimg_3->getClientOriginalName();
           $filename =  str_replace(' ', '_', pathinfo($filenameWithExt, PATHINFO_FILENAME ));
           $ext = $descimg_3->getClientOriginalExtension();
           $filenameToStore = $filename."_".time().".".$ext;
           $path = $descimg_3->storeAs('public/uploaded/addons/', $filenameToStore);
           $addons->descimg_3 = $filenameToStore;
      }

      //handle descimg 4
      if($request->hasFile('descimg_4')){
           $descimg_4 = $request->file('descimg_4');
           $filenameWithExt = $descimg_4->getClientOriginalName();
           $filename =  str_replace(' ', '_', pathinfo($filenameWithExt, PATHINFO_FILENAME ));
           $ext = $descimg_4->getClientOriginalExtension();
           $filenameToStore = $filename."_".time().".".$ext;
           $path = $descimg_4->storeAs('public/uploaded/addons/', $filenameToStore);
           $addons->descimg_4 = $filenameToStore;
      }

      //handle descimg 5
      if($request->hasFile('descimg_5')){
           $descimg_5 = $request->file('descimg_5');
           $filenameWithExt = $descimg_5->getClientOriginalName();
           $filename =  str_replace(' ', '_', pathinfo($filenameWithExt, PATHINFO_FILENAME ));
           $ext = $descimg_5->getClientOriginalExtension();
           $filenameToStore = $filename."_".time().".".$ext;
           $path = $descimg_5->storeAs('public/uploaded/addons/', $filenameToStore);
           $addons->descimg_5 = $filenameToStore;
      }

      //handle descimg 6
      if($request->hasFile('descimg_6')){
           $descimg_6 = $request->file('descimg_6');
           $filenameWithExt = $descimg_6->getClientOriginalName();
           $filename =  str_replace(' ', '_', pathinfo($filenameWithExt, PATHINFO_FILENAME ));
           $ext = $descimg_6->getClientOriginalExtension();
           $filenameToStore = $filename."_".time().".".$ext;
           $path = $descimg_6->storeAs('public/uploaded/addons/', $filenameToStore);
           $addons->descimg_6 = $filenameToStore;
      }

      $addons->save();

      return response()->json(['success' => true, 'aid' => $addons->aid ], 200 );
    }

    /**
     * Duplicate Addons
     *
     * @param [int] $id
     * @return void
     */
    public function duplicate($aid)
    {
        $addons = Addon::find($aid);
        if($addons->count()  > 0){
            $addons = Addon::find($aid);
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
    public function destroy($aid)
    {
        $addons = Addon::find($aid);
        if($addons->count()  > 0){
            $addons->delete();
            return redirect()->back();
        } else {
            return response()->json(['success' => false, 'msg' => 'addon not found' ], 200 );
        }
    }
}
