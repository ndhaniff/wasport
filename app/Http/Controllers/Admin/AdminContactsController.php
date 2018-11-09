<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Model\Contact;
use Kyslik\ColumnSortable\Sortable;

class AdminContactsController extends Controller
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
     * Show the contacts list
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $contacts = Contact::sortable()->paginate(10);
      $allcontacts = Contact::sortable()->get();

      return view('auth.admin.contacts.index',compact('contacts', 'allcontacts'));
    }

    public function search(Request $request)
    {
      $search = $request->get('search');
      $field = $request->get('field');
      $contacts = Contact::sortable()->where($field, 'like', '%' .$search. '%')->paginate(10);
      $allcontacts = Contact::sortable()->get();

      return view('auth.admin.contacts.index',compact('contacts', 'allcontacts'));
    }

    public function filter(Request $request)
    {
      $categoryitem = $request->get('categoryitem');

      $query = Contact::sortable();
        if($categoryitem != '') {
          $query->where('category', 'like', $categoryitem);
        }
      $contacts = $query->paginate(10);
      
      $allcontacts = Contact::sortable()->get();

      return view('auth.admin.contacts.index',compact('contacts', 'allcontacts'));
    }

     /**
      * Delete Contacts
      *
      * @param [int] $id
      * @return void
      */
    public function destroy($cid)
    {
        $contacts = Contact::find($cid);
        if($contacts->count()  > 0){
            $contacts->delete();
            return redirect()->back();
        } else {
            return response()->json(['success' => false, 'msg' => 'contact not found' ], 200 );
        }
    }
}
