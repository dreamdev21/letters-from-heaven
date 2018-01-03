<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\Orders;
use App\Addressbook;
use App\User;
use App\Review;
use Session;
use PDF;
use App;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $userid =Auth::user()->id;
        $items = Orders::select('*')->where('userid','=',$userid)->get();
        $addresses =Addressbook::select('*')->where('userid','=',$userid)->get();
        $userinfo = User::select('*')->where('id','=',$userid)->get();
        return view('home')->with(array('user'=>$userinfo,'items'=>$items));

    }
    public function orderreviewwrite(Request $request,$id)
    {
        $data = $request->all();
        $userid =Auth::user()->id;
        Review::create([
            'userid' => $userid,
            'pro_id' => $data['pro_id'],
            'orderid' => $data['orderid'],
            'pro_type' => $data['pro_type'],
            'note' => $data['orderreview'.$id],
            'rating' => $data['rating'.$id],
        ]);
        return back()->with('message', 'Thank you!');
    }
    public function cancelorder($id)
    {
        $order = Orders::findOrFail($id);
        $order->delete();
        return back()->with('message', 'Order canceled successfully!');
    }
    public function editorder($id)
    {
        $order = Orders::findOrFail($id);
        if($order->pro_type == "0"){
            return view('site.ordered_email_edit')->with('template',$order);
        }else{
            return view('/home/edit/flower')->with('template',$order);
        }
    }
    public function editrecorder($id)
    {
        $order = Orders::findOrFail($id);
        if($order->pro_type == "0"){
            return view('site.ordered_rec_edit')->with('template',$order);
        }else{
            return view('/home/edit/flower')->with('template',$order);
        }
    }
    public function editedemailsave(Request $request,$id)
    {
        $order = Orders::findOrFail($id);
        $order['pro_text'] = $request['textcontent'];
        $order->update();
        return redirect('/home');
    }
    public function vieworder($id)
    {
        $order = Orders::findOrFail($id);
        if($order->pro_type == "0"){
            return view('site.vieworder_email')->with('template',$order);
        }else{
            return view('site.vieworder_flower')->with('template',$order);
        }
    }
    public function reorder($id)
    {
        $order = Orders::findOrFail($id);
        if($order->pro_type == "0"){
            return view('site.reorder_email')->with('template',$order);
        }else{
            return view('site.vieworder_flower')->with('template',$order);
        }
    }
    public function reordercreate(Request $request,$id)
    {
        $oldorder = Orders::findOrFail($id);
        $order = $oldorder->replicate();
        $order['pro_text'] = $request['textcontent'];
        $order['order_id'] = uniqid();
        $order['orderstate'] = 0;
        $order->save();
        return redirect('/home');
    }
    public function invoice($id)
    {
        $order = Orders::findOrFail($id);
        $user = User::findOrFail(Auth::user()->id);
        return view('site.invoice')->with(array('order'=>$order,'user'=>$user));
    }
    public function invoicepdf($id)
    {
        $order = Orders::findOrFail($id);
        $user = User::findOrFail(Auth::user()->id);
        $pdf = PDF::loadView('site.invoice',array('order'=>$order,'user'=>$user));
        return $pdf->download('invoice.pdf');
    }
    public function updatereceipinfo(Request $request,$id)
    {
        $data = $request->all();
        $order = Orders::findOrFail($id);
        $order['title'] = $request['title'];
        $order['extendedinfo'] = $request['extendedinfo'];
        $order['firstname'] = $request['delivery_firstname'];
        $order['lastname'] = $request['delivery_lastname'];
        $order['deliveryadd1'] = $request['delivery_address1'];
        $order['deliveryadd2'] = $request['delivery_address2'];
        $order['city'] = $request['delivery_city'];
        $order['state'] = $request['delivery_state'];
        $order['postalcode'] = $request['delivery_postalcode'];
        $order['country'] = $request['country'];
        $order['reemail'] = $request['delivery_email'];
        $order['rephone'] = $request['delivery_phone'];
        $order['deliverydate'] = $request['delivery_date'];
        if($request['deliverytype']){
            if($request['deliverytype'] == "0"){
                $addmoney = 50;
            }elseif($request['deliverytype'] == "1"){
                $addmoney = 100;
            }else{
                $addmoney = 80;
            }
            $order['pro_price'] += $addmoney;
        }
        if($order['orderstate'] != "1"){
            $order['deliverytype'] = $request['deliverytype'];
        }
        $order->update();
        if($request['buttonstate'] == "0"){
            return redirect('/home');
        }else{
            Session::put('order_id',$order['order_id']);
            return view('site.orderreview_editemail')->with('item',$order);
        }
    }
}
