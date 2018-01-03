<?php
/**
 * Created by PhpStorm.
 * User: RSG
 * Date: 11/6/2017
 * Time: 11:13 AM
 */

namespace App\Console\Commands;

use Mail;
use Illuminate\Console\Command;
use App\Orders;
use App\User;
use DateTime;

class Emailorderconfirm extends Command
{
    protected $name = 'emailorderconfirm';

    protected $description = 'Email order confirm message.';

    public function __construct()
    {
        parent::__construct();
    }

    public function fire()
    {
        $today = new DateTime();
        $todaytimestamp = intval($today->getTimestamp()/3600/24);

        $orders =  Orders::all();

        foreach($orders as $order){
            $deliverydate = DateTime::createFromFormat('m-d-Y', $order->deliverydate);
            $deliverytimestamp = intval($deliverydate->getTimestamp()/3600/24);
            $user = User::findOrFail($order->userid);
            $data['senderemail'] =$user->email;
            $data['sendername'] =$user->firstname;
            $data['receivername'] =$order->firstname;
            $data['receiveremail'] =$order->reemail;
            $data['receiverphone'] =$order->rephone;
            $data['receiveradd1'] =$order->deliveryadd1;
            $data['receiveradd2'] =$order->deliveryadd2;
            $data['orderid'] =$order->id;
            $data['pro_name'] =$order->pro_name;
            $data['pro_price'] =$order->pro_price;
            $data['pro_qty'] =$order->pro_qty;
            $data['pro_type'] =$order->pro_type;
            $data['pro_image'] =$order->pro_image;
            $data['pro_text'] =$order->pro_text;
            $data['city'] =$order->city;
            $data['state'] =$order->state;
            $data['postalcode'] =$order->postalcode;
            $data['beforedate'] = $deliverytimestamp - $todaytimestamp;
            if($order->orderstate == 1){


                    if($deliverytimestamp == $todaytimestamp){

                        //                Mail::send( 'emails.emailorderconfirm', $data, function( $message ) use ($data)
                        //                {
                        //                {
                        //                    $message->to($data['senderemail'], $data['sendername'])->subject('Before your order is scheduled!');
                        //                });

                }elseif($deliverytimestamp == $todaytimestamp + 1 ){
                    Mail::send( 'emails.emailorderconfirm', $data, function( $message ) use ($data)
                    {
                        $message->to($data['senderemail'], $data['sendername'])->subject('Before your order is scheduled!');
                    });
                }elseif($deliverytimestamp == $todaytimestamp + 2 ){
                    Mail::send( 'emails.emailorderconfirm', $data, function( $message ) use ($data)
                    {
                        $message->to($data['senderemail'], $data['sendername'])->subject('Before your order is scheduled!');
                    });
                }elseif($deliverytimestamp == $todaytimestamp + 30 ){
                    Mail::send( 'emails.emailorderconfirm', $data, function( $message ) use ($data)
                    {
                        $message->to($data['senderemail'], $data['sendername'])->subject('Before your order is scheduled!');
                    });
                }elseif($deliverytimestamp == $todaytimestamp + 60 ){
                    Mail::send( 'emails.emailorderconfirm', $data, function( $message ) use ($data)
                    {
                        $message->to($data['senderemail'], $data['sendername'])->subject('Before your order is scheduled!');
                    });
                }else{

                }
            //////confirm date email send//
            }
        }

        $this->info('Test has fired.');
    }
}