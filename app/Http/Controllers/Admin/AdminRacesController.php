<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Race;

class AdminRacesController extends Controller
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
     * Show the race list
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $races = Race::all();
      return view('auth.admin.races.index')->with('races',$races);
    }

    /**
     * Show create races form
     *
     * @return void
     */
    public function create()
    {
        return view('auth.admin.races.create');
    }

    /**
     * Insert Races data to db
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        //validate request server side
        $request->validate([
            'title' => 'required|string',
            'about' => 'required|string',
            'awards' => 'required|string',
            'awards' => 'required|string',
            'RaceDateFrom' => 'required|string',
            'RaceDateTo' => 'required|string',
            'RaceDeadlineFrom' => 'required|string',
            'RaceDeadlineTo' => 'required|string',
            'price' => 'required|string',
        ]);

        $formdata = [
            'title' => $request->get('title'),
            'about' => $request->get('about'),
            'awards' => $request->get('awards'),
            'RaceDateFrom' => $request->get('RaceDateFrom'),
            'RaceDateTo' => $request->get('RaceDateTo'),
            'RaceDeadlineFrom' => $request->get('RaceDeadlineFrom'),
            'RaceDeadlineTo' => $request->get('RaceDeadlineTo'),
            'price' => $request->get('price'),
        ];

        $race = new Race();
        $race->title = $formdata['title'];
        $race->date_from = $formdata['RaceDateFrom'];
        $race->date_to = $formdata['RaceDateTo'];
        $race->dead_from = $formdata['RaceDeadlineFrom'];
        $race->dead_to = $formdata['RaceDeadlineTo'];
        $race->price = $formdata['price'];
        $race->about = $formdata['about'];
        $race->awards = $formdata['awards'];

        //handle header img
        if($request->hasFile('headerImg')){
            $headerimg = $request->file('headerImg');
            $filenameWithExt = $headerimg->getClientOriginalName();
            $filename =  str_replace(' ', '_', pathinfo($filenameWithExt, PATHINFO_FILENAME ));
            $ext = $headerimg->getClientOriginalExtension();
            $filenameToStore = $filename."_".time().".".$ext;
            $path = $headerimg->storeAs('public/uploaded', $filenameToStore);
            $race->header = $filenameToStore;
        } else {
            $filenameToStore = 'noimage.jpg';
        }

        $race->save();

        return response()->json(['success' => true, 'id' => $race->id ], 200 );
    }

    public function editForm($id){
        $race = Race::where('id','=', $id)->first();
        return view('auth.admin.races.edit')->with('race',$race);
    }

    /**
     * Edit Race
     *
     * @param Request $request
     * @return void
     */
    public function edit(Request $request)
    {
        //validate request server side
        $request->validate([
            'title' => 'required|string',
            'about' => 'required|string',
            'awards' => 'required|string',
            'awards' => 'required|string',
            'RaceDateFrom' => 'required|string',
            'RaceDateTo' => 'required|string',
            'RaceDeadlineFrom' => 'required|string',
            'RaceDeadlineTo' => 'required|string',
            'price' => 'required|string',
        ]);

        $formdata = [
            'title' => $request->get('title'),
            'about' => $request->get('about'),
            'awards' => $request->get('awards'),
            'RaceDateFrom' => $request->get('RaceDateFrom'),
            'RaceDateTo' => $request->get('RaceDateTo'),
            'RaceDeadlineFrom' => $request->get('RaceDeadlineFrom'),
            'RaceDeadlineTo' => $request->get('RaceDeadlineTo'),
            'price' => $request->get('price'),
            'id' => $request->get('id')
        ];
        $race = Race::find($formdata['id']);
        $race->title = $formdata['title'];
        $race->date_from = $formdata['RaceDateFrom'];
        $race->date_to = $formdata['RaceDateTo'];
        $race->dead_from = $formdata['RaceDeadlineFrom'];
        $race->dead_to = $formdata['RaceDeadlineTo'];
        $race->price = $formdata['price'];
        $race->about = $formdata['about'];
        $race->awards = $formdata['awards'];

        //handle header img
        if($request->hasFile('headerImg')){
            $headerimg = $request->file('headerImg');
            $filenameWithExt = $headerimg->getClientOriginalName();
            $filename =  str_replace(' ', '_', pathinfo($filenameWithExt, PATHINFO_FILENAME ));
            $ext = $headerimg->getClientOriginalExtension();
            $filenameToStore = $filename."_".time().".".$ext;
            $path = $headerimg->storeAs('public/uploaded', $filenameToStore);
            $race->header = $filenameToStore;
        } else {
            $filenameToStore = 'noimage.jpg';
        }

        $race->save();

        return response()->json(['success' => true, 'id' => $race->id ], 200 );
    }

    /**
     * Duplicate Race
     *
     * @param [int] $id
     * @return void
     */
    public function duplicate($id)
    {
        $race = Race::find($id);
        if($race->count()  > 0){
            $race = Race::find($id);
            $newRace = $race->replicate();
            $newRace->save();
            return redirect()->back();
        } else {
            return response()->json(['success' => false, 'msg' => 'error' ], 200 );
        }
    }

     /**
      * Delete Race
      *
      * @param [int] $id
      * @return void
      */
    public function destroy($id)
    {

        $race = Race::find($id);
        if($race->count()  > 0){
            $race->delete();
            return redirect()->back();
        } else {
            return response()->json(['success' => false, 'msg' => 'race not found' ], 200 );
        }
    }
}
