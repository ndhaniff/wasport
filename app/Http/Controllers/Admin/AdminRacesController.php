<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Model\Race;
use Kyslik\ColumnSortable\Sortable;

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
      //$races = DB::table('races')->sortable()->paginate(10);

      //return view('auth.admin.races.index', ['races' => $races]);

        $races = Race::sortable()->paginate(10);

        return view('auth.admin.races.index',compact('races'));
    }

    public function search(Request $request)
    {
      $search = $request->get('search');
      $races = Race::sortable()->where('title_en', 'like', '%' .$search. '%')->paginate(10);

      return view('auth.admin.races.index', ['races' => $races]);
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
            'title_en' => 'required|string',
            'about_en' => 'required|string',
            'awards_en' => 'required|string',
            'RaceDateFrom' => 'required|string',
            'RaceDateTo' => 'required|string',
            'RaceDeadlineFrom' => 'required|string',
            'RaceDeadlineTo' => 'required|string',
            'medals_en' => 'required|string',
            'price' => 'required|string',
        ]);

        $formdata = [
            'title_en' => $request->get('title_en'),
            'title_ms' => $request->get('title_ms'),
            'title_zh' => $request->get('title_zh'),
            'about_en' => $request->get('about_en'),
            'about_ms' => $request->get('about_ms'),
            'about_zh' => $request->get('about_zh'),
            'awards_en' => $request->get('awards_en'),
            'awards_ms' => $request->get('awards_ms'),
            'awards_zh' => $request->get('awards_zh'),
            'RaceDateFrom' => $request->get('RaceDateFrom'),
            'RaceDateTo' => $request->get('RaceDateTo'),
            'RaceDeadlineFrom' => $request->get('RaceDeadlineFrom'),
            'RaceDeadlineTo' => $request->get('RaceDeadlineTo'),
            'medals_en' => $request->get('medals_en'),
            'medals_ms' => $request->get('medals_ms'),
            'medals_zh' => $request->get('medals_zh'),
            'price' => $request->get('price'),
            'category' => $request->get('category'),
            'engrave' => $request->get('engrave'),
        ];

        $race = new Race();
        $race->title_en = $formdata['title_en'];
        $race->title_ms = $formdata['title_ms'];
        $race->title_zh = $formdata['title_zh'];
        $race->date_from = $formdata['RaceDateFrom'];
        $race->date_to = $formdata['RaceDateTo'];
        $race->dead_from = $formdata['RaceDeadlineFrom'];
        $race->dead_to = $formdata['RaceDeadlineTo'];
        $race->medals_en = $formdata['medals_en'];
        $race->medals_ms = $formdata['medals_ms'];
        $race->medals_zh = $formdata['medals_zh'];
        $race->about_en = $formdata['about_en'];
        $race->about_ms = $formdata['about_ms'];
        $race->about_zh = $formdata['about_zh'];
        $race->awards_en = $formdata['awards_en'];
        $race->awards_ms = $formdata['awards_ms'];
        $race->awards_zh = $formdata['awards_zh'];
        $race->price = $formdata['price'];
        $race->category = $formdata['category'];
        $race->engrave = $formdata['engrave'];

        //handle header img
        if($request->hasFile('headerImg')){
             $headerimg = $request->file('headerImg');
             $filenameWithExt = $headerimg->getClientOriginalName();
             $filename =  str_replace(' ', '_', pathinfo($filenameWithExt, PATHINFO_FILENAME ));
             $ext = $headerimg->getClientOriginalExtension();
             $filenameToStore = $filename."_".time().".".$ext;
             $path = $headerimg->storeAs('public/uploaded/races/', $filenameToStore);
         } else {
             $filenameToStore = 'noimage.png';
         }
        $race->header = $filenameToStore;
        $race->save();

        return response()->json(['success' => true, 'rid' => $race->rid ], 200 );
    }

    public function editForm($rid){
        $race = Race::where('rid','=', $rid)->first();
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
            'title_en' => 'required|string',
            'about_en' => 'required|string',
            'awards_en' => 'required|string',
            'RaceDateFrom' => 'required|string',
            'RaceDateTo' => 'required|string',
            'RaceDeadlineFrom' => 'required|string',
            'RaceDeadlineTo' => 'required|string',
            'price' => 'required|string',
            'medals_en' => 'required|string',
        ]);

        $formdata = [
            'title_en' => $request->get('title_en'),
            'title_ms' => $request->get('title_ms'),
            'title_zh' => $request->get('title_zh'),
            'about_en' => $request->get('about_en'),
            'about_ms' => $request->get('about_ms'),
            'about_zh' => $request->get('about_zh'),
            'awards_en' => $request->get('awards_en'),
            'awards_ms' => $request->get('awards_ms'),
            'awards_zh' => $request->get('awards_zh'),
            'RaceDateFrom' => $request->get('RaceDateFrom'),
            'RaceDateTo' => $request->get('RaceDateTo'),
            'RaceDeadlineFrom' => $request->get('RaceDeadlineFrom'),
            'RaceDeadlineTo' => $request->get('RaceDeadlineTo'),
            'medals_en' => $request->get('medals_en'),
            'medals_ms' => $request->get('medals_ms'),
            'medals_zh' => $request->get('medals_zh'),
            'price' => $request->get('price'),
            'category' => $request->get('category'),
            'engrave' => $request->get('engrave'),
            'rid' => $request->get('rid')
        ];

        $race = Race::find($formdata['rid']);
        $race->title_en = $formdata['title_en'];
        $race->title_ms = $formdata['title_ms'];
        $race->title_zh = $formdata['title_zh'];
        $race->date_from = $formdata['RaceDateFrom'];
        $race->date_to = $formdata['RaceDateTo'];
        $race->dead_from = $formdata['RaceDeadlineFrom'];
        $race->dead_to = $formdata['RaceDeadlineTo'];
        $race->medals_en = $formdata['medals_en'];
        $race->medals_ms = $formdata['medals_ms'];
        $race->medals_zh = $formdata['medals_zh'];
        $race->about_en = $formdata['about_en'];
        $race->about_ms = $formdata['about_ms'];
        $race->about_zh = $formdata['about_zh'];
        $race->awards_en = $formdata['awards_en'];
        $race->awards_ms = $formdata['awards_ms'];
        $race->awards_zh = $formdata['awards_zh'];
        $race->price = $formdata['price'];
        $race->category = $formdata['category'];
        $race->engrave = $formdata['engrave'];

        //handle header img
        if($request->hasFile('headerImg')){
             $headerimg = $request->file('headerImg');
             $filenameWithExt = $headerimg->getClientOriginalName();
             $filename =  str_replace(' ', '_', pathinfo($filenameWithExt, PATHINFO_FILENAME ));
             $ext = $headerimg->getClientOriginalExtension();
             $filenameToStore = $filename."_".time().".".$ext;
             $path = $headerimg->storeAs('public/uploaded/races/', $filenameToStore);
         } else {
             $filenameToStore = 'noimage.png';
         }
        $race->header = $filenameToStore;
        $race->save();

        return response()->json(['success' => true, 'rid' => $race->rid ], 200 );
    }

    /**
     * Duplicate Race
     *
     * @param [int] $rid
     * @return void
     */
    public function duplicate($rid)
    {
        $race = Race::find($rid);
        if($race->count()  > 0){
            $race = Race::find($rid);
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
      * @param [int] $rid
      * @return void
      */
    public function destroy($rid)
    {
        $race = Race::find($rid);
        if($race->count()  > 0){
            $race->delete();
            return redirect()->back();
        } else {
            return response()->json(['success' => false, 'msg' => 'race not found' ], 200 );
        }
    }
}
