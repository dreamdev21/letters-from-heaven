<?php

namespace App\Http\Controllers\admin;

use App\user;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Orders;
use Auth;
use PDF;

class OrdersController extends Controller
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
    public function emailinbox()
    {
        $items = Orders::where('orderstate','=','1')->where('pro_type','=','0')->get();
        $user = User::findOrFail(Auth::user()->id);
        $newcontact = DB::table('contact')->where('contact.state', '=', '0')->count();
        return view('admin.orders.emailinbox')->with(array('items'=>$items,'newcontact'=>$newcontact,'user'=>$user));
    }
    public function emailsent()
    {
        $items = Orders::where('orderstate','=','5')->where('pro_type','=','0')->get();
        $user = User::findOrFail(Auth::user()->id);
        $newcontact = DB::table('contact')->where('contact.state', '=', '0')->count();
        return view('admin.orders.emailsent')->with(array('items'=>$items,'newcontact'=>$newcontact,'user'=>$user));
    }
    public function emaildraft()
    {
        $items = Orders::where('orderstate','=','0')->where('pro_type','=','0')->get();
        $user = User::findOrFail(Auth::user()->id);
        $newcontact = DB::table('contact')->where('contact.state', '=', '0')->count();
        return view('admin.orders.emaildraft')->with(array('items'=>$items,'newcontact'=>$newcontact,'user'=>$user));
    }
    public function flowerstandby()
    {
        $items = Orders::select('orders.id','orders.order_id','orders.orderstate','users.email as useremail','users.firstname as userfirstname','users.lastname as userlastname','users.phone as userphone','orders.pro_id','orders.pro_name','orders.pro_price','orders.pro_qty','orders.pro_image','orders.title','orders.extendedinfo','orders.firstname','orders.lastname','orders.deliveryadd1','orders.deliveryadd2','orders.city','orders.state','orders.postalcode','orders.country','orders.rephone','orders.reemail','orders.deliverydate','orders.cardmessage','orders.signature','orders.adminnote','orders.created_at','orders.updated_at')->whereIn('orderstate',[1,2])->where('pro_type','=','1')->join('users','users.id','=','orders.userid')->get();
        $newcontact = DB::table('contact')->where('contact.state', '=', '0')->count();
        return view('admin.orders.flowerstandby')->with(array('items'=>$items,'newcontact'=>$newcontact));
    }
    public function flowersent()
    {
        $items = Orders::select('orders.id','orders.order_id','orders.orderstate','users.email as useremail','users.firstname as userfirstname','users.lastname as userlastname','users.phone as userphone','orders.pro_id','orders.pro_name','orders.pro_price','orders.pro_qty','orders.pro_image','orders.title','orders.extendedinfo','orders.firstname','orders.lastname','orders.deliveryadd1','orders.deliveryadd2','orders.city','orders.state','orders.postalcode','orders.country','orders.rephone','orders.reemail','orders.deliverydate','orders.cardmessage','orders.signature','orders.adminnote','orders.created_at','orders.updated_at')->where('orderstate','=','5')->where('pro_type','=','1')->join('users','users.id','=','orders.userid')->get();
        $newcontact = DB::table('contact')->where('contact.state', '=', '0')->count();
        return view('admin.orders.flowersent')->with(array('items'=>$items,'newcontact'=>$newcontact));
    }
    public function flowerdraft()
    {
        $items = Orders::select('orders.id','orders.order_id','orders.orderstate','users.email as useremail','users.firstname as userfirstname','users.lastname as userlastname','users.phone as userphone','orders.pro_id','orders.pro_name','orders.pro_price','orders.pro_qty','orders.pro_image','orders.title','orders.extendedinfo','orders.firstname','orders.lastname','orders.deliveryadd1','orders.deliveryadd2','orders.city','orders.state','orders.postalcode','orders.country','orders.rephone','orders.reemail','orders.deliverydate','orders.cardmessage','orders.signature','orders.adminnote','orders.created_at','orders.updated_at')->whereIn('orderstate',[0,3,4])->where('pro_type','=','1')->join('users','users.id','=','orders.userid')->get();
        $newcontact = DB::table('contact')->where('contact.state', '=', '0')->count();
        return view('admin.orders.flowerdraft')->with(array('items'=>$items,'newcontact'=>$newcontact));
    }
    public function flowerupdate(Request $request,$id)
    {
        $data = $request->all();
        unset($data['_token']);
        Orders::where('id', $id)->update($data);
        return back()->with('message', 'Flower Order state changed successfull!');
    }
    public function delete($id)
    {
        $deleteorder = Orders::where('id', $id);
        $deleteorder->delete();
        return back()->with('message', 'Flower Order deleted successfull!');
    }
//    public function emailgoprint(Request $request,$id)
//    {
//        $order = Orders::findOrFail($id);
//        return view('admin.orders.emailprint')->with('order',$order);
//    }

    public function emailgoprint($id)
    {
        $order = Orders::findOrFail($id);
        $pdf = PDF::loadView('admin.orders.emailprint',array('order'=>$order));
        return $pdf->download(($order->id).'.pdf');
//        return view('admin.orders.emailprint')->with('order',$order);
    }
}
