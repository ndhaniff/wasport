<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Model\Medal;
use App\Model\Race;
use Kyslik\ColumnSortable\Sortable;

class AdminMedalsController extends Controller
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
      $medals = Medal::sortable()->paginate(10);
      $races = Race::sortable()->get();
      $allmedals = Medal::sortable()->get();

      return view('auth.admin.medals.index',compact('medals', 'races', 'allmedals'));
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

    /**
     * Show create medals form
     *
     * @return void
     */
    public function create()
    {
        $races = DB::table('races')->get();

        return view('auth.admin.medals.create', ['races' => $races]);
    }

    /**
     * Insert Medals data to db
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        //validate request server side
        $request->validate([
            'name' => 'required|string',
        ]);

        $formdata = [
            'name' => $request->get('name'),
            'races_id' => $request->get('races_id'),
        ];

        $medal = new Medal();
        $medal->name = $formdata['name'];
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

    public function editForm($mid){
        $medal = DB::table('medals')->where('mid','=', $mid)->first();
        $races = DB::table('races')->get();

        return view('auth.admin.medals.edit', ['medal' => $medal, 'races' => $races]);
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
        'races_id' => $request->get('races_id'),
        'mid' => $request->get('mid')
      ];


      $medal = Medal::find($formdata['mid']);
      $medal->name = $formdata['name'];

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
