<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\EmailTemplate;
use DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Session;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use App\Orders;

class ShopEmailController extends Controller
{
    public function index()
    {
        $templates = EmailTemplate::select('*')->where('email_templates.state','0')->get();
        return view('site.shop_email')->with('templates',$templates);
    }

    public function edit($id) {

        $template = EmailTemplate::findOrFail($id);
        \Cart::add($id, $template->name, $template->price,  1, array('image'=>($template->image),'pro_text'=>''));
        return view('site.shop_email_edit')->with('template',$template);
    }
    public function editcart($id) {

        $template = EmailTemplate::findOrFail($id);
        return view('site.shop_email_edit')->with('template',$template);
    }

    public function saveemail() {
        $emailcontent = $_GET;
        Session::put('cartId',$emailcontent['id']);
        $draftstate = $emailcontent['draft'];
        if($draftstate == 0){
            \Cart::update($emailcontent['id'], array('pro_text'=>$emailcontent['textcontent'],
            ));
            return response('/savedraft');
        }else{
            \Cart::update($emailcontent['id'], array('pro_text'=>$emailcontent['textcontent'],
            ));
            return response('/shop/email/delivery');
        }
    }

    public function updatetext() {
        $emailcontent = $_GET;
        $draftstate = $emailcontent['draft'];
        \Cart::update($emailcontent['id'], array('pro_text'=>$emailcontent['textcontent'],
        ));
        return response(Cart::getContent());
    }

    public function updateorderedtext() {
        $emailcontent = $_GET;
        $order = Orders::findOrFail($emailcontent['id']);
        $order['pro_text'] = $emailcontent['textcontent'];
        $order->update();
        return response($order->pro_text);
    }

    public function orderdelivery(Request $request,$id) {
        $data = $request->all();
        $template = EmailTemplate::findOrFail($id);
        return view('site.shop_email_edit')->with('template',$template);
    }

    public function delivery() {

        return view('site.shop_email_delivery');
    }

    public function addcart(Request $request) {
        $data = $request->all();
        $cartId = Session::get('cartId');
        $oldprice = Cart::get($cartId)->getPriceSum();
        $image = EmailTemplate::findOrFail($cartId)->image;
        if($data['deliverytype']==0){
            $price = $oldprice + 50;
        }elseif($data['deliverytype']==1){
            $price = $oldprice + 100;
        }else{
            $price = $oldprice + 80;
        }

        if($data['draft'] == "0"){
            \Cart::update($cartId,  array(
                'image'=>$image,
                'price'=>$price,
                'pro_type' =>0,
                'title' => $data['title'],
                'extendedinfo' => $data['extendedinfo'],
                'firstname' => $data['delivery_firstname'],
                'lastname' => $data['delivery_lastname'],
                'deliveryadd1' => $data['delivery_address1'],
                'deliveryadd2' => $data['delivery_address2'],
                'city' => $data['delivery_city'],
                'state' => $data['delivery_state'],
                'postalcode' => $data['delivery_postalcode'],
                'country' => $data['country'],
                'rephone' => $data['delivery_phone'],
                'reemail' => $data['delivery_email'],
                'deliverydate' => $data['delivery_date'],
                'deliverytype' => $data['deliverytype'],
                'orderstate' => '0',
                'draftstate' => '0',
                ));
            return redirect('/savedraft');
        }else{
            \Cart::update($cartId,  array(
                'image'=>$image,
                'price'=>$price,
                'pro_type' =>0,
                'title' => $data['title'],
                'extendedinfo' => $data['extendedinfo'],
                'firstname' => $data['delivery_firstname'],
                'lastname' => $data['delivery_lastname'],
                'deliveryadd1' => $data['delivery_address1'],
                'deliveryadd2' => $data['delivery_address2'],
                'city' => $data['delivery_city'],
                'state' => $data['delivery_state'],
                'postalcode' => $data['delivery_postalcode'],
                'country' => $data['country'],
                'rephone' => $data['delivery_phone'],
                'reemail' => $data['delivery_email'],
                'deliverydate' => $data['delivery_date'],
                'deliverytype' => $data['deliverytype'],
                'orderstate' => '0',
                'draftstate' => '1',
                ));
            return redirect('/cart');
        }
    }
}
