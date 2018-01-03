<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contact;
use DB;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;


class ContactController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index()
    {
//        $contacts = Contact::all()->orderBy('id', 'desc');
        $contacts= Contact::orderBy('id','desc')->get();
        $newcontact = DB::table('contact')->where('contact.state', '=', '0')->count();
        return view('admin.contact')->with(array('contacts'=>$contacts,'newcontact'=>$newcontact));
    }

    public function destroy($id) {

        $contact = Contact::findOrFail($id);

        $contact->delete();

        return redirect('admin/contact');
    }
    public function update(Request $request, $id)
    {

        Contact::where('id', $id)->update($request->except('_token','created_at','updated_at'));

        return redirect('admin/contact');
    }

}
