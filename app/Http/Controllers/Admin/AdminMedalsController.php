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
            'medal_grey' => $request->get('medal_grey'),
            'medal_color' => $request->get('medal_color'),
            'cert' => $request->get('cert'),
            'bib' => $request->get('bib'),
            'races_id' => $request->get('races_id'),
        ];

        $medals = new Medal();
        $medals->name = $formdata['name'];
        $medals->medal_grey = $formdata['medal_grey'];
        $medals->medal_color = $formdata['medal_color'];
        $medals->cert = $formdata['cert'];
        $medals->bib = $formdata['bib'];
        $medals->races_id = $formdata['races_id'];

        $medals->save();

        return response()->json(['success' => true, 'mid' => $medals->mid ], 200 );
    }

    public function editForm($mid){
        $medals = DB::table('medals')->where('mid','=', $mid)->first();
        $races = DB::table('races')->get();

        return view('auth.admin.medals.edit', ['medals' => $medals, 'races' => $races]);
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
      ];


      $medals = Medal::find($formdata['mid']);
      $medals->name = $formdata['name'];
      $medals->medal_grey = $formdata['medal_grey'];
      $medals->medal_color = $formdata['medal_color'];
      $medals->cert = $formdata['cert'];
      $medals->bib = $formdata['bib'];
      $medals->races_id = $formdata['races_id'];

      $medals->save();

      return response()->json(['success' => true, 'mid' => $medals->mid ], 200 );
    }

     /**
      * Delete Medals
      *
      * @param [int] $id
      * @return void
      */
    public function destroy($mid)
    {
        $medals = Medal::find($mid);
        if($medals->count()  > 0){
            $medals->delete();
            return redirect()->back();
        } else {
            return response()->json(['success' => false, 'msg' => 'addon not found' ], 200 );
        }
    }
}
