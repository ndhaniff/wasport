<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Model\User;
use App\Model\Contact;
use Auth;
use DB;
use Mail;
use App\Mail\contactEmail;

class ContactController extends Controller
{
  public function contactus(){

    if (Auth::check())
    {
      $user = Auth::user();
      return view('pages.contactus', ['user' => $user]);
    } else {
      return view('pages.contactus');
    }
}

  public function submitContact(Request $request){

    $contact = new Contact();
    $contact->name = $request->get('name');
    $contact->email = $request->get('email');
    $contact->phone = $request->get('phone');
    $contact->category = $request->get('category');
    $contact->message = $request->get('message');
    $contact->save();

    $cid = $contact->cid;
    $contact = Contact::findOrFail($cid);

    Mail::send('email.sendContactEmail', ['contact' => $contact], function ($m) use ($contact) {
      $m->from($contact->email, $contact->name);
      $m->to('yunni@jumix.com.my', 'WaSports')->subject('[WaSports Contact] ' . $contact->category);
    });

    Mail::send('email.sendContactEmail', ['contact' => $contact], function ($m) use ($contact) {
      $m->from($contact->email, $contact->name);
      $m->to('yunni_yeoh@outlook.com', 'WaSports')->subject('[WaSports Contact] ' . $contact->category);
    });

    return response()->json(['success' => true], 200 );

  }

}
