<?php

namespace App\Http\Controllers\Main;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Race;

class RacesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
         $races = Race::all();
         return view('auth.admin.races.index')->with('races',$races);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.admin.races.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        // $request->validate([
        //     'title' => 'required|string',
        //     'about' => 'required|string',
        //     'awards' => 'required|string',
        //     'awards' => 'required|string',
        //     'RaceDateFrom' => 'required|string',
        //     'RaceDateTo' => 'required|string',
        //     'RaceDeadlineFrom' => 'required|string',
        //     'RaceDeadlineTo' => 'required|string',
        //     'price' => 'required|string',
        // ]);

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
        
        if($request->hasFile('headerImg')){
            $headerimg = $request->file('headerImg');
            $filenameWithExt = $headerimg->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME );
            $ext = $headerimg->getClientOriginalExtension();
            $filenameToStore = $filename."_".time().".".$ext;
            $path = $headerimg->storeAs('public/uploaded', $filenameToStore);
            $race->header = $filenameToStore;
        } else {
            $filenameToStore = 'noimage.jpg';
        }

        $race->save();

        return response()->json(['success' => true ], 200 );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
