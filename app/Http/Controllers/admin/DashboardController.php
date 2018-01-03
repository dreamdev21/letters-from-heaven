<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contact;
use DB;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $newcontact = DB::table('contact')->where('contact.state', '=', '0')->count();
        $users = DB::table('users')->where('users.is_Admin','=',0)->count();
        $revenue = DB::table('orders')->where('orders.orderstate','=','1')->sum('orders.pro_price');
        $emailorders = DB::table('orders')->where('orders.orderstate','=','1')->where('orders.pro_type','=','0')->count();
        $flowerorders = DB::table('orders')->where('orders.orderstate','=','1')->where('orders.pro_type','=','1')->count();
        $letterorders = DB::table('orders')->where('orders.orderstate','=','1')->where('orders.pro_type','=','2')->count();
        $giftorders = DB::table('orders')->where('orders.orderstate','=','1')->where('orders.pro_type','=','3')->count();

        return view('admin.dashboard')->with(array('users'=>$users,'revenue'=>$revenue,'emailorders'=>$emailorders,'flowerorders'=>$flowerorders,'giftorders'=>$giftorders,'letterorders'=>$letterorders,'newcontact'=>$newcontact));
    }
}
