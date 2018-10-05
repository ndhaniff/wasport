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

        $races = Race::sortable()
                  ->orderBy('date_from', 'DESC')
                  ->paginate(10);

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
            'time_from' => $request->get('time_from'),
            'time_to' => $request->get('time_to'),
            'deadtime_from' => $request->get('deadtime_from'),
            'deadtime_to' => $request->get('deadtime_to'),
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
        $race->time_from = $formdata['time_from'];
        $race->time_to = $formdata['time_to'];
        $race->deadtime_from = $formdata['deadtime_from'];
        $race->deadtime_to = $formdata['deadtime_to'];
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
             $race->header = $filenameToStore;
         }

        //handle awardimg 1
        if($request->hasFile('awardimg_1')){
             $awardimg_1 = $request->file('awardimg_1');
             $filenameWithExt = $awardimg_1->getClientOriginalName();
             $filename =  str_replace(' ', '_', pathinfo($filenameWithExt, PATHINFO_FILENAME ));
             $ext = $awardimg_1->getClientOriginalExtension();
             $filenameToStore = $filename."_".time().".".$ext;
             $path = $awardimg_1->storeAs('public/uploaded/awards/', $filenameToStore);
             $race->awardimg_1 = $filenameToStore;
        }

        //handle awardimg 2
        if($request->hasFile('awardimg_2')){
             $awardimg_2 = $request->file('awardimg_2');
             $filenameWithExt = $awardimg_2->getClientOriginalName();
             $filename =  str_replace(' ', '_', pathinfo($filenameWithExt, PATHINFO_FILENAME ));
             $ext = $awardimg_2->getClientOriginalExtension();
             $filenameToStore = $filename."_".time().".".$ext;
             $path = $awardimg_2->storeAs('public/uploaded/awards/', $filenameToStore);
             $race->awardimg_2 = $filenameToStore;
        }

        //handle awardimg 3
        if($request->hasFile('awardimg_3')){
             $awardimg_3 = $request->file('awardimg_3');
             $filenameWithExt = $awardimg_3->getClientOriginalName();
             $filename =  str_replace(' ', '_', pathinfo($filenameWithExt, PATHINFO_FILENAME ));
             $ext = $awardimg_3->getClientOriginalExtension();
             $filenameToStore = $filename."_".time().".".$ext;
             $path = $awardimg_3->storeAs('public/uploaded/awards/', $filenameToStore);
             $race->awardimg_3 = $filenameToStore;
        }

        //handle awardimg 4
        if($request->hasFile('awardimg_4')){
             $awardimg_4 = $request->file('awardimg_4');
             $filenameWithExt = $awardimg_4->getClientOriginalName();
             $filename =  str_replace(' ', '_', pathinfo($filenameWithExt, PATHINFO_FILENAME ));
             $ext = $awardimg_4->getClientOriginalExtension();
             $filenameToStore = $filename."_".time().".".$ext;
             $path = $awardimg_4->storeAs('public/uploaded/awards/', $filenameToStore);
             $race->awardimg_4 = $filenameToStore;
        }

        //handle awardimg 5
        if($request->hasFile('awardimg_5')){
             $awardimg_5 = $request->file('awardimg_5');
             $filenameWithExt = $awardimg_5->getClientOriginalName();
             $filename =  str_replace(' ', '_', pathinfo($filenameWithExt, PATHINFO_FILENAME ));
             $ext = $awardimg_5->getClientOriginalExtension();
             $filenameToStore = $filename."_".time().".".$ext;
             $path = $awardimg_5->storeAs('public/uploaded/awards/', $filenameToStore);
             $race->awardimg_5 = $filenameToStore;
        }

        //handle awardimg 6
        if($request->hasFile('awardimg_6')){
             $awardimg_6 = $request->file('awardimg_6');
             $filenameWithExt = $awardimg_6->getClientOriginalName();
             $filename =  str_replace(' ', '_', pathinfo($filenameWithExt, PATHINFO_FILENAME ));
             $ext = $awardimg_6->getClientOriginalExtension();
             $filenameToStore = $filename."_".time().".".$ext;
             $path = $awardimg_6->storeAs('public/uploaded/awards/', $filenameToStore);
             $race->awardimg_6 = $filenameToStore;
        }

        //handle medalimg 1
        if($request->hasFile('medalimg_1')){
             $medalimg_1 = $request->file('medalimg_1');
             $filenameWithExt = $medalimg_1->getClientOriginalName();
             $filename =  str_replace(' ', '_', pathinfo($filenameWithExt, PATHINFO_FILENAME ));
             $ext = $medalimg_1->getClientOriginalExtension();
             $filenameToStore = $filename."_".time().".".$ext;
             $path = $medalimg_1->storeAs('public/uploaded/medals/', $filenameToStore);
             $race->medalimg_1 = $filenameToStore;
        }

        //handle medalimg 2
        if($request->hasFile('medalimg_2')){
             $medalimg_2 = $request->file('medalimg_2');
             $filenameWithExt = $medalimg_2->getClientOriginalName();
             $filename =  str_replace(' ', '_', pathinfo($filenameWithExt, PATHINFO_FILENAME ));
             $ext = $medalimg_2->getClientOriginalExtension();
             $filenameToStore = $filename."_".time().".".$ext;
             $path = $medalimg_2->storeAs('public/uploaded/medals/', $filenameToStore);
             $race->medalimg_2 = $filenameToStore;
        }

        //handle medalimg 3
        if($request->hasFile('medalimg_3')){
             $medalimg_3 = $request->file('medalimg_3');
             $filenameWithExt = $medalimg_3->getClientOriginalName();
             $filename =  str_replace(' ', '_', pathinfo($filenameWithExt, PATHINFO_FILENAME ));
             $ext = $medalimg_3->getClientOriginalExtension();
             $filenameToStore = $filename."_".time().".".$ext;
             $path = $medalimg_3->storeAs('public/uploaded/medals/', $filenameToStore);
             $race->medalimg_3 = $filenameToStore;
        }

        //handle medalimg 4
        if($request->hasFile('medalimg_4')){
             $medalimg_4 = $request->file('medalimg_4');
             $filenameWithExt = $medalimg_4->getClientOriginalName();
             $filename =  str_replace(' ', '_', pathinfo($filenameWithExt, PATHINFO_FILENAME ));
             $ext = $medalimg_4->getClientOriginalExtension();
             $filenameToStore = $filename."_".time().".".$ext;
             $path = $medalimg_4->storeAs('public/uploaded/medals/', $filenameToStore);
             $race->medalimg_4 = $filenameToStore;
        }

        //handle medalimg 5
        if($request->hasFile('medalimg_5')){
             $medalimg_5 = $request->file('medalimg_5');
             $filenameWithExt = $medalimg_5->getClientOriginalName();
             $filename =  str_replace(' ', '_', pathinfo($filenameWithExt, PATHINFO_FILENAME ));
             $ext = $medalimg_5->getClientOriginalExtension();
             $filenameToStore = $filename."_".time().".".$ext;
             $path = $medalimg_5->storeAs('public/uploaded/medals/', $filenameToStore);
             $race->medalimg_15= $filenameToStore;
        }

        //handle medalimg 6
        if($request->hasFile('medalimg_6')){
             $medalimg_6 = $request->file('medalimg_6');
             $filenameWithExt = $medalimg_6->getClientOriginalName();
             $filename =  str_replace(' ', '_', pathinfo($filenameWithExt, PATHINFO_FILENAME ));
             $ext = $medalimg_6->getClientOriginalExtension();
             $filenameToStore = $filename."_".time().".".$ext;
             $path = $medalimg_6->storeAs('public/uploaded/medals/', $filenameToStore);
             $race->medalimg_6 = $filenameToStore;
        }

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
            'time_from' => $request->get('time_from'),
            'time_to' => $request->get('time_to'),
            'deadtime_from' => $request->get('deadtime_from'),
            'deadtime_to' => $request->get('deadtime_to'),
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
        $race->time_from = $formdata['time_from'];
        $race->time_to = $formdata['time_to'];
        $race->deadtime_from = $formdata['deadtime_from'];
        $race->deadtime_to = $formdata['deadtime_to'];
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
             $race->header = $filenameToStore;
         }

         //handle awardimg 1
         if($request->hasFile('awardimg_1')){
              $awardimg_1 = $request->file('awardimg_1');
              $filenameWithExt = $awardimg_1->getClientOriginalName();
              $filename =  str_replace(' ', '_', pathinfo($filenameWithExt, PATHINFO_FILENAME ));
              $ext = $awardimg_1->getClientOriginalExtension();
              $filenameToStore = $filename."_".time().".".$ext;
              $path = $awardimg_1->storeAs('public/uploaded/awards/', $filenameToStore);
              $race->awardimg_1 = $filenameToStore;
         }

         //handle awardimg 2
         if($request->hasFile('awardimg_2')){
              $awardimg_2 = $request->file('awardimg_2');
              $filenameWithExt = $awardimg_2->getClientOriginalName();
              $filename =  str_replace(' ', '_', pathinfo($filenameWithExt, PATHINFO_FILENAME ));
              $ext = $awardimg_2->getClientOriginalExtension();
              $filenameToStore = $filename."_".time().".".$ext;
              $path = $awardimg_2->storeAs('public/uploaded/awards/', $filenameToStore);
              $race->awardimg_2 = $filenameToStore;
         }

         //handle awardimg 3
         if($request->hasFile('awardimg_3')){
              $awardimg_3 = $request->file('awardimg_3');
              $filenameWithExt = $awardimg_3->getClientOriginalName();
              $filename =  str_replace(' ', '_', pathinfo($filenameWithExt, PATHINFO_FILENAME ));
              $ext = $awardimg_3->getClientOriginalExtension();
              $filenameToStore = $filename."_".time().".".$ext;
              $path = $awardimg_3->storeAs('public/uploaded/awards/', $filenameToStore);
              $race->awardimg_3 = $filenameToStore;
         }

         //handle awardimg 4
         if($request->hasFile('awardimg_4')){
              $awardimg_4 = $request->file('awardimg_4');
              $filenameWithExt = $awardimg_4->getClientOriginalName();
              $filename =  str_replace(' ', '_', pathinfo($filenameWithExt, PATHINFO_FILENAME ));
              $ext = $awardimg_4->getClientOriginalExtension();
              $filenameToStore = $filename."_".time().".".$ext;
              $path = $awardimg_4->storeAs('public/uploaded/awards/', $filenameToStore);
              $race->awardimg_4 = $filenameToStore;
         }

         //handle awardimg 5
         if($request->hasFile('awardimg_5')){
              $awardimg_5 = $request->file('awardimg_5');
              $filenameWithExt = $awardimg_5->getClientOriginalName();
              $filename =  str_replace(' ', '_', pathinfo($filenameWithExt, PATHINFO_FILENAME ));
              $ext = $awardimg_5->getClientOriginalExtension();
              $filenameToStore = $filename."_".time().".".$ext;
              $path = $awardimg_5->storeAs('public/uploaded/awards/', $filenameToStore);
              $race->awardimg_5 = $filenameToStore;
         }

         //handle awardimg 6
         if($request->hasFile('awardimg_6')){
              $awardimg_6 = $request->file('awardimg_6');
              $filenameWithExt = $awardimg_6->getClientOriginalName();
              $filename =  str_replace(' ', '_', pathinfo($filenameWithExt, PATHINFO_FILENAME ));
              $ext = $awardimg_6->getClientOriginalExtension();
              $filenameToStore = $filename."_".time().".".$ext;
              $path = $awardimg_6->storeAs('public/uploaded/awards/', $filenameToStore);
              $race->awardimg_6 = $filenameToStore;
         }

         //handle medalimg 1
         if($request->hasFile('medalimg_1')){
              $medalimg_1 = $request->file('medalimg_1');
              $filenameWithExt = $medalimg_1->getClientOriginalName();
              $filename =  str_replace(' ', '_', pathinfo($filenameWithExt, PATHINFO_FILENAME ));
              $ext = $medalimg_1->getClientOriginalExtension();
              $filenameToStore = $filename."_".time().".".$ext;
              $path = $medalimg_1->storeAs('public/uploaded/medals/', $filenameToStore);
              $race->medalimg_1 = $filenameToStore;
         }

         //handle medalimg 2
         if($request->hasFile('medalimg_2')){
              $medalimg_2 = $request->file('medalimg_2');
              $filenameWithExt = $medalimg_2->getClientOriginalName();
              $filename =  str_replace(' ', '_', pathinfo($filenameWithExt, PATHINFO_FILENAME ));
              $ext = $medalimg_2->getClientOriginalExtension();
              $filenameToStore = $filename."_".time().".".$ext;
              $path = $medalimg_2->storeAs('public/uploaded/medals/', $filenameToStore);
              $race->medalimg_2 = $filenameToStore;
         }

         //handle medalimg 3
         if($request->hasFile('medalimg_3')){
              $medalimg_3 = $request->file('medalimg_3');
              $filenameWithExt = $medalimg_3->getClientOriginalName();
              $filename =  str_replace(' ', '_', pathinfo($filenameWithExt, PATHINFO_FILENAME ));
              $ext = $medalimg_3->getClientOriginalExtension();
              $filenameToStore = $filename."_".time().".".$ext;
              $path = $medalimg_3->storeAs('public/uploaded/medals/', $filenameToStore);
              $race->medalimg_3 = $filenameToStore;
         }

         //handle medalimg 4
         if($request->hasFile('medalimg_4')){
              $medalimg_4 = $request->file('medalimg_4');
              $filenameWithExt = $medalimg_4->getClientOriginalName();
              $filename =  str_replace(' ', '_', pathinfo($filenameWithExt, PATHINFO_FILENAME ));
              $ext = $medalimg_4->getClientOriginalExtension();
              $filenameToStore = $filename."_".time().".".$ext;
              $path = $medalimg_4->storeAs('public/uploaded/medals/', $filenameToStore);
              $race->medalimg_4 = $filenameToStore;
         }

         //handle medalimg 5
         if($request->hasFile('medalimg_5')){
              $medalimg_5 = $request->file('medalimg_5');
              $filenameWithExt = $medalimg_5->getClientOriginalName();
              $filename =  str_replace(' ', '_', pathinfo($filenameWithExt, PATHINFO_FILENAME ));
              $ext = $medalimg_5->getClientOriginalExtension();
              $filenameToStore = $filename."_".time().".".$ext;
              $path = $medalimg_5->storeAs('public/uploaded/medals/', $filenameToStore);
              $race->medalimg_15= $filenameToStore;
         }

         //handle medalimg 6
         if($request->hasFile('medalimg_6')){
              $medalimg_6 = $request->file('medalimg_6');
              $filenameWithExt = $medalimg_6->getClientOriginalName();
              $filename =  str_replace(' ', '_', pathinfo($filenameWithExt, PATHINFO_FILENAME ));
              $ext = $medalimg_6->getClientOriginalExtension();
              $filenameToStore = $filename."_".time().".".$ext;
              $path = $medalimg_6->storeAs('public/uploaded/medals/', $filenameToStore);
              $race->medalimg_6 = $filenameToStore;
         }

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
