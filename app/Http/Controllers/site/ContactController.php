<?php

namespace App\Http\Controllers\site;

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
//    public function __construct()
//    {
//        $this->middleware('admin');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('site.contact');
    }
    public function save(Request $request) {

        $data=$request->all();

        Contact::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'subject' => $data['subject'],
            'message' => $data['message'],
            'state' => "0",
            'fromstate' => "0",
        ]);

        return redirect('/contact')->with('message', 'Message sent successfull!');
    }
    public function tailorcontactindex()
    {

        return view('site.tailorcontact');
    }
    public function tailorcontactsave(Request $request) {

        $data=$request->all();

        Contact::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'subject' => $data['subject'],
            'message' => $data['message'],
            'state' => "0",
            'fromstate' => "1",
        ]);

        return redirect('/tailorcontact')->with('message', 'Message sent successfull!');
    }

}
