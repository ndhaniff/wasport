<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Model\Offline;
use Kyslik\ColumnSortable\Sortable;
use Session;

class AdminOfflinesController extends Controller
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
        $offlines = Offline::sortable()
                  ->orderBy('date', 'DESC')
                  ->paginate(10);

        return view('auth.admin.offlines.index',compact('offlines'));
    }

    public function search(Request $request)
    {
      $search = $request->get('search');
      $offlines = Offline::sortable()->where('title_en', 'like', '%' .$search. '%')->paginate(10);

      return view('auth.admin.offlines.index', ['offlines' => $offlines]);
    }

    public function filter(Request $request)
    {
      $stateitem = $request->get('stateitem');

      $query = Offline::sortable();
        if($stateitem != '') {
          $query->where('state', 'like', $stateitem);
        }
      $offlines = $query->paginate(10);

      $allofflines = Offline::sortable()->get();

      return view('auth.admin.offlines.index',compact('offlines', 'allofflines'));
    }

    /**
     * Show create races form
     *
     * @return void
     */
    public function create()
    {
        return view('auth.admin.offlines.create');
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
            'state' => 'required|string',
            'date' => 'required|string',
            'place' => 'required|string',
            'category' => 'required|string'
        ]);

        $formdata = [
            'title_en' => $request->get('title_en'),
            'title_ms' => $request->get('title_ms'),
            'title_zh' => $request->get('title_zh'),
            'details_en' => $request->get('details_en'),
            'details_ms' => $request->get('details_ms'),
            'details_zh' => $request->get('details_zh'),
            'date' => $request->get('date'),
            'category' => $request->get('category'),
            'place' => $request->get('place'),
            'state' => $request->get('state'),
            'website' => $request->get('website'),
        ];

        $offline = new Offline();
        $offline->title_en = $formdata['title_en'];
        $offline->title_ms = $formdata['title_ms'];
        $offline->title_zh = $formdata['title_zh'];
        $offline->details_en = $formdata['details_en'];
        $offline->details_ms = $formdata['details_ms'];
        $offline->details_zh = $formdata['details_zh'];
        $offline->date = $formdata['date'];
        $offline->category = $formdata['category'];
        $offline->location = $formdata['place'];
        $offline->state = $formdata['state'];
        $offline->website = $formdata['website'];

        //handle header img
        if($request->hasFile('headerImg')){
             $headerimg = $request->file('headerImg');
             $filenameWithExt = $headerimg->getClientOriginalName();
             $filename =  str_replace(' ', '_', pathinfo($filenameWithExt, PATHINFO_FILENAME ));
             $ext = $headerimg->getClientOriginalExtension();
             $filenameToStore = $filename."_".time().".".$ext;
             $path = $headerimg->storeAs('public/uploaded/offline/', $filenameToStore);
             $offline->header = $filenameToStore;
         }

        //handle raceimg 1
        if($request->hasFile('raceimg_1')){
             $raceimg_1 = $request->file('raceimg_1');
             $filenameWithExt = $raceimg_1->getClientOriginalName();
             $filename =  str_replace(' ', '_', pathinfo($filenameWithExt, PATHINFO_FILENAME ));
             $ext = $raceimg_1->getClientOriginalExtension();
             $filenameToStore = $filename."_".time().".".$ext;
             $path = $raceimg_1->storeAs('public/uploaded/offlinerace/', $filenameToStore);
             $offline->raceimg_1 = $filenameToStore;
        }

        //handle raceimg 2
        if($request->hasFile('raceimg_2')){
             $raceimg_2 = $request->file('raceimg_2');
             $filenameWithExt = $raceimg_2->getClientOriginalName();
             $filename =  str_replace(' ', '_', pathinfo($filenameWithExt, PATHINFO_FILENAME ));
             $ext = $raceimg_2->getClientOriginalExtension();
             $filenameToStore = $filename."_".time().".".$ext;
             $path = $raceimg_2->storeAs('public/uploaded/offlinerace/', $filenameToStore);
             $offline->raceimg_2 = $filenameToStore;
        }

        //handle raceimg 3
        if($request->hasFile('raceimg_3')){
             $raceimg_3 = $request->file('raceimg_3');
             $filenameWithExt = $raceimg_3->getClientOriginalName();
             $filename =  str_replace(' ', '_', pathinfo($filenameWithExt, PATHINFO_FILENAME ));
             $ext = $raceimg_3->getClientOriginalExtension();
             $filenameToStore = $filename."_".time().".".$ext;
             $path = $raceimg_3->storeAs('public/uploaded/offlinerace/', $filenameToStore);
             $offline->raceimg_3 = $filenameToStore;
        }

        //handle raceimg 4
        if($request->hasFile('raceimg_4')){
             $raceimg_4 = $request->file('raceimg_4');
             $filenameWithExt = $raceimg_4->getClientOriginalName();
             $filename =  str_replace(' ', '_', pathinfo($filenameWithExt, PATHINFO_FILENAME ));
             $ext = $raceimg_4->getClientOriginalExtension();
             $filenameToStore = $filename."_".time().".".$ext;
             $path = $raceimg_4->storeAs('public/uploaded/offlinerace/', $filenameToStore);
             $offline->raceimg_4 = $filenameToStore;
        }

        //handle raceimg 5
        if($request->hasFile('raceimg_5')){
             $raceimg_5 = $request->file('raceimg_5');
             $filenameWithExt = $raceimg_5->getClientOriginalName();
             $filename =  str_replace(' ', '_', pathinfo($filenameWithExt, PATHINFO_FILENAME ));
             $ext = $raceimg_5->getClientOriginalExtension();
             $filenameToStore = $filename."_".time().".".$ext;
             $path = $raceimg_5->storeAs('public/uploaded/offline/', $filenameToStore);
             $offline->raceimg_5 = $filenameToStore;
        }

        //handle raceimg 6
        if($request->hasFile('raceimg_6')){
             $raceimg_6 = $request->file('raceimg_6');
             $filenameWithExt = $raceimg_6->getClientOriginalName();
             $filename =  str_replace(' ', '_', pathinfo($filenameWithExt, PATHINFO_FILENAME ));
             $ext = $raceimg_6->getClientOriginalExtension();
             $filenameToStore = $filename."_".time().".".$ext;
             $path = $raceimg_6->storeAs('public/uploaded/offlinerace/', $filenameToStore);
             $offline->raceimg_6 = $filenameToStore;
        }

        $offline->save();

        return response()->json(['success' => true, 'fid' => $offline->fid ], 200 );
    }

    public function editForm($fid){
        $offline = Offline::where('fid','=', $fid)->first();
        return view('auth.admin.offlines.edit')->with('offline',$offline);
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
          'state' => 'required|string',
          'date' => 'required|string',
          'place' => 'required|string',
          'category' => 'required|string'
        ]);

        $formdata = [
          'title_en' => $request->get('title_en'),
          'title_ms' => $request->get('title_ms'),
          'title_zh' => $request->get('title_zh'),
          'details_en' => $request->get('details_en'),
          'details_ms' => $request->get('details_ms'),
          'details_zh' => $request->get('details_zh'),
          'date' => $request->get('date'),
          'category' => $request->get('category'),
          'place' => $request->get('place'),
          'state' => $request->get('state'),
          'website' => $request->get('website'),
          'fid' => $request->get('fid')
        ];

        $offline = Offline::find($formdata['fid']);
        $offline->title_en = $formdata['title_en'];
        $offline->title_ms = $formdata['title_ms'];
        $offline->title_zh = $formdata['title_zh'];
        $offline->details_en = $formdata['details_en'];
        $offline->details_ms = $formdata['details_ms'];
        $offline->details_zh = $formdata['details_zh'];
        $offline->date = $formdata['date'];
        $offline->category = $formdata['category'];
        $offline->location = $formdata['place'];
        $offline->state = $formdata['state'];
        $offline->website = $formdata['website'];

        //handle header img
        if($request->hasFile('headerImg')){
             $headerimg = $request->file('headerImg');
             $filenameWithExt = $headerimg->getClientOriginalName();
             $filename =  str_replace(' ', '_', pathinfo($filenameWithExt, PATHINFO_FILENAME ));
             $ext = $headerimg->getClientOriginalExtension();
             $filenameToStore = $filename."_".time().".".$ext;
             $path = $headerimg->storeAs('public/uploaded/offline/', $filenameToStore);
             $offline->header = $filenameToStore;
         }

         //handle raceimg 1
         if($request->hasFile('raceimg_1')){
              $raceimg_1 = $request->file('raceimg_1');
              $filenameWithExt = $raceimg_1->getClientOriginalName();
              $filename =  str_replace(' ', '_', pathinfo($filenameWithExt, PATHINFO_FILENAME ));
              $ext = $raceimg_1->getClientOriginalExtension();
              $filenameToStore = $filename."_".time().".".$ext;
              $path = $raceimg_1->storeAs('public/uploaded/offlinerace/', $filenameToStore);
              $offline->raceimg_1 = $filenameToStore;
         }

         //handle raceimg 2
         if($request->hasFile('raceimg_2')){
              $raceimg_2 = $request->file('raceimg_2');
              $filenameWithExt = $raceimg_2->getClientOriginalName();
              $filename =  str_replace(' ', '_', pathinfo($filenameWithExt, PATHINFO_FILENAME ));
              $ext = $raceimg_2->getClientOriginalExtension();
              $filenameToStore = $filename."_".time().".".$ext;
              $path = $raceimg_2->storeAs('public/uploaded/offlinerace/', $filenameToStore);
              $offline->raceimg_2 = $filenameToStore;
         }

         //handle raceimg 3
         if($request->hasFile('raceimg_3')){
              $raceimg_3 = $request->file('raceimg_3');
              $filenameWithExt = $raceimg_3->getClientOriginalName();
              $filename =  str_replace(' ', '_', pathinfo($filenameWithExt, PATHINFO_FILENAME ));
              $ext = $raceimg_3->getClientOriginalExtension();
              $filenameToStore = $filename."_".time().".".$ext;
              $path = $raceimg_3->storeAs('public/uploaded/offlinerace/', $filenameToStore);
              $offline->raceimg_3 = $filenameToStore;
         }

         //handle raceimg 4
         if($request->hasFile('raceimg_4')){
              $raceimg_4 = $request->file('raceimg_4');
              $filenameWithExt = $raceimg_4->getClientOriginalName();
              $filename =  str_replace(' ', '_', pathinfo($filenameWithExt, PATHINFO_FILENAME ));
              $ext = $raceimg_4->getClientOriginalExtension();
              $filenameToStore = $filename."_".time().".".$ext;
              $path = $raceimg_4->storeAs('public/uploaded/offlinerace/', $filenameToStore);
              $offline->raceimg_4 = $filenameToStore;
         }

         //handle raceimg 5
         if($request->hasFile('raceimg_5')){
              $raceimg_5 = $request->file('raceimg_5');
              $filenameWithExt = $raceimg_5->getClientOriginalName();
              $filename =  str_replace(' ', '_', pathinfo($filenameWithExt, PATHINFO_FILENAME ));
              $ext = $raceimg_5->getClientOriginalExtension();
              $filenameToStore = $filename."_".time().".".$ext;
              $path = $raceimg_5->storeAs('public/uploaded/offline/', $filenameToStore);
              $offline->raceimg_5 = $filenameToStore;
         }

         //handle raceimg 6
         if($request->hasFile('raceimg_6')){
              $raceimg_6 = $request->file('raceimg_6');
              $filenameWithExt = $raceimg_6->getClientOriginalName();
              $filename =  str_replace(' ', '_', pathinfo($filenameWithExt, PATHINFO_FILENAME ));
              $ext = $raceimg_6->getClientOriginalExtension();
              $filenameToStore = $filename."_".time().".".$ext;
              $path = $raceimg_6->storeAs('public/uploaded/offlinerace/', $filenameToStore);
              $offline->raceimg_6 = $filenameToStore;
         }

        $offline->save();

        return response()->json(['success' => true, 'fid' => $offline->fid ], 200 );
    }

     /**
      * Delete Race
      *
      * @param [int] $rid
      * @return void
      */
    public function destroy($fid)
    {
        $offline = Offline::find($fid);
        if($offline->count()  > 0){
            $offline->delete();
            Session::flash('message', 'Successfully deleted');
            return redirect()->back();
        } else {
            Session::flash('message', 'Unable to delete');
            return response()->json(['success' => false, 'msg' => 'race not found' ], 200 );
        }
    }
}
