<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Orders;
use Illuminate\Http\Request;
use App\EmailTemplate;
use DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Session;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use DateTime;
use App\User;
use Mail;

class EmailConfirmController extends Controller
{
    public function index()
    {
        $today = new DateTime();
        $todaytimestamp = intval($today->getTimestamp()/3600/24);

        $orders =  Orders::all();

        foreach($orders as $order) {
            $deliverydate = DateTime::createFromFormat('m-d-Y', $order->deliverydate);
            $deliverytimestamp = intval($deliverydate->getTimestamp() / 3600 / 24);
            $user = User::findOrFail($order->userid);
            $data['senderemail'] = $user->email;
            $data['sendername'] = $user->firstname;
            $data['receivername'] = $order->firstname;
            $data['receiveremail'] = $order->reemail;
            $data['receiverphone'] = $order->rephone;
            $data['receiveradd1'] = $order->deliveryadd1;
            $data['receiveradd2'] = $order->deliveryadd2;
            $data['orderid'] = $order->id;
            $data['pro_name'] = $order->pro_name;
            $data['pro_price'] = $order->pro_price;
            $data['pro_qty'] = $order->pro_qty;
            $data['pro_type'] = $order->pro_type;
            $data['pro_image'] = $order->pro_image;
            $data['pro_text'] = $order->pro_text;
            $data['city'] = $order->city;
            $data['state'] = $order->state;
            $data['postalcode'] = $order->postalcode;
            $data['beforedate'] = $deliverytimestamp - $todaytimestamp;
            if ($order->orderstate == 1) {


                if ($deliverytimestamp == $todaytimestamp) {

                    //                Mail::send( 'emails.emailorderconfirm', $data, function( $message ) use ($data)
                    //                {
                    //                {
                    //                    $message->to($data['senderemail'], $data['sendername'])->subject('Before your order is scheduled!');
                    //                });

                } elseif ($deliverytimestamp == $todaytimestamp + 1) {
                    Mail::send('emails.emailorderconfirm', $data, function ($message) use ($data) {
                        $message->to($data['senderemail'], $data['sendername'])->subject('Before your order is scheduled!');
                    });
                } elseif ($deliverytimestamp == $todaytimestamp + 2) {
                    Mail::send('emails.emailorderconfirm', $data, function ($message) use ($data) {
                        $message->to($data['senderemail'], $data['sendername'])->subject('Before your order is scheduled!');
                    });
                } elseif ($deliverytimestamp == $todaytimestamp + 30) {
                    Mail::send('emails.emailorderconfirm', $data, function ($message) use ($data) {
                        $message->to($data['senderemail'], $data['sendername'])->subject('Before your order is scheduled!');
                    });
                } elseif ($deliverytimestamp == $todaytimestamp + 60) {
                    Mail::send('emails.emailorderconfirm', $data, function ($message) use ($data) {
                        $message->to($data['senderemail'], $data['sendername'])->subject('Before your order is scheduled!');
                    });
                } else {

                }
                //////confirm date email send//
            }
        }
    }
    public function month(Request $request,$id){
        $order = Orders::findOrFail($id);
        $data['olddate'] = $order->deliverydate;
        $deliverydate = DateTime::createFromFormat('m-d-Y', $order->deliverydate);
        $deliverytimestamp = intval($deliverydate->getTimestamp()+30*3600*24);
        $order->deliverydate =  date('m-d-Y', $deliverytimestamp);
        $data['newdate'] = $order->deliverydate;
        $order->save();

        $user = User::findOrFail($order->userid);
        $data['senderemail'] = $user->email;
        $data['sendername'] = $user->firstname;
        $data['receivername'] = $order->firstname;
        $data['receiveremail'] = $order->reemail;
        $data['receiverphone'] = $order->rephone;
        $data['receiveradd1'] = $order->deliveryadd1;
        $data['receiveradd2'] = $order->deliveryadd2;
        $data['orderid'] = $order->id;
        $data['pro_name'] = $order->pro_name;
        $data['pro_price'] = $order->pro_price;
        $data['pro_qty'] = $order->pro_qty;
        $data['pro_type'] = $order->pro_type;
        $data['pro_image'] = $order->pro_image;
        $data['pro_text'] = $order->pro_text;
        $data['city'] = $order->city;
        $data['state'] = $order->state;
        $data['postalcode'] = $order->postalcode;

        $today = new DateTime();
        $todaytimestamp = intval($today->getTimestamp()/3600/24);

        $data['beforedate'] = $deliverytimestamp - $todaytimestamp;

        Mail::send('emails.emailorderschedule', $data, function ($message) use ($data) {
            $message->to($data['senderemail'], $data['sendername'])->subject('Your order is scheduled!');
        });

        return redirect('/emailconfirm/orderchangedadminconfirm/'.$order->id);
    }
    public function month6(Request $request,$id){
        $order = Orders::findOrFail($id);
        $data['olddate'] = $order->deliverydate;
        $deliverydate = DateTime::createFromFormat('m-d-Y', $order->deliverydate);
        $deliverytimestamp = intval($deliverydate->getTimestamp()+183*3600*24);
        $order->deliverydate =  date('m-d-Y', $deliverytimestamp);
        $data['newdate'] = $order->deliverydate;
        $order->save();

        $user = User::findOrFail($order->userid);
        $data['senderemail'] = $user->email;
        $data['sendername'] = $user->firstname;
        $data['receivername'] = $order->firstname;
        $data['receiveremail'] = $order->reemail;
        $data['receiverphone'] = $order->rephone;
        $data['receiveradd1'] = $order->deliveryadd1;
        $data['receiveradd2'] = $order->deliveryadd2;
        $data['orderid'] = $order->id;
        $data['pro_name'] = $order->pro_name;
        $data['pro_price'] = $order->pro_price;
        $data['pro_qty'] = $order->pro_qty;
        $data['pro_type'] = $order->pro_type;
        $data['pro_image'] = $order->pro_image;
        $data['pro_text'] = $order->pro_text;
        $data['city'] = $order->city;
        $data['state'] = $order->state;
        $data['postalcode'] = $order->postalcode;

        $today = new DateTime();
        $todaytimestamp = intval($today->getTimestamp()/3600/24);

        $data['beforedate'] = $deliverytimestamp - $todaytimestamp;

        Mail::send('emails.emailorderschedule', $data, function ($message) use ($data) {
            $message->to($data['senderemail'], $data['sendername'])->subject('Your order is scheduled!');
        });
        return redirect('/emailconfirm/orderchangedadminconfirm/'.$order->id);
    }
    public function year(Request $request,$id){
        $order = Orders::findOrFail($id);
        $data['olddate'] = $order->deliverydate;
        $deliverydate = DateTime::createFromFormat('m-d-Y', $order->deliverydate);
        $deliverytimestamp = intval($deliverydate->getTimestamp()+365*3600*24);
        $order->deliverydate =  date('m-d-Y', $deliverytimestamp);
        $data['newdate'] = $order->deliverydate;
        $order->save();

        $user = User::findOrFail($order->userid);
        $data['senderemail'] = $user->email;
        $data['sendername'] = $user->firstname;
        $data['receivername'] = $order->firstname;
        $data['receiveremail'] = $order->reemail;
        $data['receiverphone'] = $order->rephone;
        $data['receiveradd1'] = $order->deliveryadd1;
        $data['receiveradd2'] = $order->deliveryadd2;
        $data['orderid'] = $order->id;
        $data['pro_name'] = $order->pro_name;
        $data['pro_price'] = $order->pro_price;
        $data['pro_qty'] = $order->pro_qty;
        $data['pro_type'] = $order->pro_type;
        $data['pro_image'] = $order->pro_image;
        $data['pro_text'] = $order->pro_text;
        $data['city'] = $order->city;
        $data['state'] = $order->state;
        $data['postalcode'] = $order->postalcode;

        $today = new DateTime();
        $todaytimestamp = intval($today->getTimestamp()/3600/24);

        $data['beforedate'] = $deliverytimestamp - $todaytimestamp;

        Mail::send('emails.emailorderschedule', $data, function ($message) use ($data) {
            $message->to($data['senderemail'], $data['sendername'])->subject('Your order is scheduled!');
        });
        return redirect('/emailconfirm/orderchangedadminconfirm/'.$order->id);
    }
    public function orderchangedadminconfirm(Request $request,$id){
        $order = Orders::findOrFail($id);
        $data['olddate'] = $order->deliverydate;

        $user = User::findOrFail($order->userid);
        $data['senderemail'] = $user->email;
        $data['sendername'] = $user->firstname;
        $data['receivername'] = $order->firstname;
        $data['receiveremail'] = $order->reemail;
        $data['receiverphone'] = $order->rephone;
        $data['receiveradd1'] = $order->deliveryadd1;
        $data['receiveradd2'] = $order->deliveryadd2;
        $data['orderid'] = $order->id;
        $data['pro_name'] = $order->pro_name;
        $data['pro_price'] = $order->pro_price;
        $data['pro_qty'] = $order->pro_qty;
        $data['pro_type'] = $order->pro_type;
        $data['pro_image'] = $order->pro_image;
        $data['pro_text'] = $order->pro_text;
        $data['city'] = $order->city;
        $data['state'] = $order->state;
        $data['postalcode'] = $order->postalcode;
        $admin =  DB::table('users')->where('users.is_Admin', '=', '1')->get();
        $data['adminemail'] = $admin[0]->email;
        $data['adminname'] = $admin[0]->firstname;
        Mail::send('emails.orderchangedadminconfrim', $data, function ($message) use ($data) {
            $message->to($data['adminemail'], $data['adminname'])->subject('Order schedule date changed!');
        });
        return redirect('/home');
        echo "<script>window.close();</script>";
    }

}
