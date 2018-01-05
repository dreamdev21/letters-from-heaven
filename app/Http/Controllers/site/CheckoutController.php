<?php

namespace App\Http\Controllers\site;

require base_path().'/vendor/PayPalPHPSDK/sample/bootstrap.php';

use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PhpParser\Node\Expr\Print_;
use ResultPrinter;
use PayPal\Api\PaymentCard;
use PayPal\Api\FundingInstrument;
use Illuminate\Http\Request;
use App\FlowerTemplate;
use App\EmailTemplate;
use App\Orders;
use App\Addressbook;
use App\BillingAddressbook;
use App\Creditcard;
use App\Http\Controllers\Controller;
use App\User;
use Mail;
use DB;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Support\Facades\URL;
use Session;
use Auth;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Config;
use \Illuminate\Http\Response;
use Anouar\Paypalpayment\PaypalPayment;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Validator;


class CheckoutController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     */
    private $_apiContext;

    protected function bilingvalidator(array $data)
    {
        return Validator::make($data, [
            'billingfirstname' => 'required|string|max:255',
            'billinglastname' => 'required|string|max:255',
            'billingaddress1' => 'required|string|max:255',
            'billingcity' => 'required|string|max:255',
            'billingcountry' => 'required|string|max:255',
            'billingpostalcode' => 'required|string|max:255',
            'billingaddressstate' => 'required|string|max:255',

        ]);
    }
    protected function cardvalidator(array $data)
    {
        return Validator::make($data, [
            'cardfirstname' => 'required|string|max:255',
            'cardlastname' => 'required|string|max:255',
            'card-number' => 'required|digits:16',
            'expiredatemonth' => 'required|string|max:2',
            'expiredateyear' => 'required|string|max:4',
            'cvv' => 'required|digits:3',
        ]);
    }

    public function __construct(Request $request)
    {
        Session::put('form-data',  $request->all());
        $this->middleware('auth');
    }

    public function index(Request $request,$id)
    {
        if (strpos(URL::previous(), 'email') !== false) {
            $product = EmailTemplate::findOrFail($id);
            $pro_type = 0;
        }
        else{
            $product = FlowerTemplate::findOrFail($id);
            $alltemplates = FlowerTemplate::all();
            $pro_type = 1;
        }
        $name = $product['name'];
        $price = $product['price'];
        $image= $product['image'];
        $qty = 1;
        $data = Session::get('form-data');
        \Cart::add($id, $name, $price,  $qty, array('image'=>$image,
            'pro_type'=>$pro_type,
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
            'cardmessage' => $data['cardmessage'],
            'signature' => $data['signature'],
            'orderstate' => '0',));

        if($data['saveaddress'] == "0"){
            Addressbook::create([
                'userid' => Auth::user()->id,
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
            ]);
        }

        session::forget('form-data');
        return redirect('/cart');

    }

    public function paywithpaypal(Request $request){

        $orderid = uniqid();
        Session::put('orderid',$orderid);
        $payer = new Payer();
        $payer->setPaymentMethod("paypal");


        $carts = Cart::getContent();
        $cart_items = array();
        $total = 0;
        foreach ($carts as $cart) {
            $item = new Item();
            $item->setName($cart->name)
                ->setCurrency('USD')
                ->setQuantity($cart->quantity)
                ->setPrice($cart->price);
            $total += ($cart->quantity) * ($cart->price);
            $cart_items[] = $item;

            Orders::create([
                'userid' => Auth::user()->id,
                'pro_id' => $cart->id,
                'order_id' => $orderid,
                'pro_name' => $cart['name'],
                'pro_type' => $cart->pro_type,
                'pro_text' => $cart->pro_text,
                'pro_price' => $cart['price'],
                'pro_image' => $cart->image,
                'pro_qty' => $cart['quantity'],
                'title' => $cart->title,
                'extendedinfo' =>$cart->extendedinfo,
                'firstname' =>$cart->firstname,
                'lastname' => $cart->lastname,
                'deliveryadd1' => $cart->deliveryadd1,
                'deliveryadd2' => $cart->deliveryadd2,
                'city' => $cart->city,
                'state' => $cart->state,
                'postalcode' => $cart->postalcode,
                'country' => $cart->country,
                'rephone' => $cart->rephone,
                'reemail' => $cart->reemail,
                'deliverydate' => $cart->deliverydate,
                'deliverytype' =>  $cart->deliverytype,
                'cardmessage' => $cart->cardmessage,
                'signature' => $cart->signature,
                'orderstate' => '0',
            ]);
        }
        $itemList = new ItemList();
        $itemList->setItems($cart_items);

        $details = new Details();
        $details->setShipping(0)
            ->setTax(0)
            ->setSubtotal($total);

        $amount = new Amount();
        $amount->setCurrency("USD")
            ->setTotal($total)
            ->setDetails($details);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Payment description")
            ->setInvoiceNumber(uniqid());

        $baseUrl = getBaseUrl();
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(Config::get('app.url') . "/paypal/success")
            ->setCancelUrl(Config::get('app.url') . "/paypal/cancel");

        $payment = new Payment();
        $payment->setIntent("order")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));


        $request = clone $payment;


//            $clientId = Config::get('paypal_payment.clientId');
//            $clientSecret = Config::get('paypal_payment.clientSecret');
//            $apiContext = getApiContext($clientId, $clientSecret);
        $clientId = 'AVGpMyv8woePMEOTOK-9iFPGwIx7hmeZdQ_SZXyfhUQFYDmwX2ZlhacF9wK6iKGRse7kfOO_R0XZXNQo';
        $clientSecret = 'EEDHKoIayoHPPIrklbu4d3S9eYctSaCU0jNTl7_gfO_RX3bS3qnmeSO-EG0OCuTz4V6zolJ7oHUJ-6zh';
        $apiContext = getApiContext($clientId, $clientSecret);

        try {
            $payment->create($apiContext);
        } catch (Exception $ex) {
            ResultPrinter::printError("Created Payment Order Using PayPal. Please visit the URL to Approve.", "Payment", null, $request, $ex);
            exit(1);
        }


        $approvalUrl = $payment->getApprovalLink();


        return redirect($approvalUrl);




    }
    public function paywithpaypalordered($id){
        $order = Orders::findOrFail($id);
        Session::put('orderid',$order->order_id);
        $payer = new Payer();
        $payer->setPaymentMethod("paypal");
        $order = Orders::findOrFail($id);

        $total = 0;
        $item = new Item();
        $item->setName($order->pro_name)
            ->setCurrency('USD')
            ->setQuantity($order->pro_qty)
            ->setPrice($order->pro_price);
        $total = ($order->pro_qty) * ($order->pro_price);

        $cart_items = array();
        $cart_items[] = $item;
        $itemList = new ItemList();
        $itemList->setItems($cart_items);


        $details = new Details();
        $details->setShipping(0)
            ->setTax(0)
            ->setSubtotal($total);

        $amount = new Amount();
        $amount->setCurrency("USD")
            ->setTotal($total)
            ->setDetails($details);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Payment description")
            ->setInvoiceNumber(uniqid());

        $baseUrl = getBaseUrl();
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(Config::get('app.url') . "/paypal/success")
            ->setCancelUrl(Config::get('app.url') . "/paypal/cancel");

        $payment = new Payment();
        $payment->setIntent("order")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));


        $request = clone $payment;


//            $clientId = Config::get('paypal_payment.clientId');
//            $clientSecret = Config::get('paypal_payment.clientSecret');
//            $apiContext = getApiContext($clientId, $clientSecret);
        $clientId = 'AVGpMyv8woePMEOTOK-9iFPGwIx7hmeZdQ_SZXyfhUQFYDmwX2ZlhacF9wK6iKGRse7kfOO_R0XZXNQo';
        $clientSecret = 'EEDHKoIayoHPPIrklbu4d3S9eYctSaCU0jNTl7_gfO_RX3bS3qnmeSO-EG0OCuTz4V6zolJ7oHUJ-6zh';
        $apiContext = getApiContext($clientId, $clientSecret);

        try {
            $payment->create($apiContext);
        } catch (Exception $ex) {
            ResultPrinter::printError("Created Payment Order Using PayPal. Please visit the URL to Approve.", "Payment", null, $request, $ex);
            exit(1);
        }


        $approvalUrl = $payment->getApprovalLink();


        return redirect($approvalUrl);




    }
    public function paywithcreditcard(Request $request)
    {
        $orderid = uniqid();
        Session::put('orderid',$orderid);

        $data = $request->all();
        $this->cardvalidator($data)->validate();
        Creditcard::create([
            'userid' => Auth::user()->id,
            'order_id' => $orderid,
            'cardfirstname' => $data['cardfirstname'],
            'cardlastname' => $data['cardlastname'],
            'card-number' => $data['card-number'],
            'expiredatemonth' => $data['expiredatemonth'],
            'expiredateyear' => $data['expiredateyear'],
            'cvv' => $data['cvv'],
        ]);
        if ($data['billingmethod'] == "0") {
            $billing = BillingAddressbook::select("*")->where("billingaddressbook.userid", "=", Auth::user()->id)->get();
        } else {
            $this->bilingvalidator($data)->validate();
            BillingAddressbook::create([
                'userid' => Auth::user()->id,
                'billingfirstname' => $data['billingfirstname'],
                'billinglastname' => $data['billinglastname'],
                'billingaddress1' => $data['billingaddress1'],
                'billingaddress2' => $data['billingaddress2'],
                'billingcity' => $data['billingcity'],
                'billingcountry' => $data['billingcountry'],
                'billingpostalcode' => $data['billingpostalcode'],
                'billingaddressstate' => $data['billingaddressstate'],
            ]);
            $billing = $data;
        }


        $cardinfo = Creditcard::select('*')->where('order_id', '=', $orderid)->get();

        return view('site.orderreviewcreditcard')->with(array(
            'cardinfo' => $cardinfo,'billingaddress'=>$billing
        ));
    }
    public function paywithcreditcardordered(Request $request,$id)
    {
        $order = Orders::findOrFail($id);
        $orderid= $order->order_id;
        Session::put('orderid',$order->order_id);

        $data = $request->all();
        $this->cardvalidator($data)->validate();
        Creditcard::create([
            'userid' => Auth::user()->id,
            'order_id' => $orderid,
            'cardfirstname' => $data['cardfirstname'],
            'cardlastname' => $data['cardlastname'],
            'card-number' => $data['card-number'],
            'expiredatemonth' => $data['expiredatemonth'],
            'expiredateyear' => $data['expiredateyear'],
            'cvv' => $data['cvv'],
        ]);
        if ($data['billingmethod'] == "0") {
            $billing = BillingAddressbook::select("*")->where("billingaddressbook.userid", "=", Auth::user()->id)->get();
        } else {
            $this->bilingvalidator($data)->validate();
            BillingAddressbook::create([
                'userid' => Auth::user()->id,
                'billingfirstname' => $data['billingfirstname'],
                'billinglastname' => $data['billinglastname'],
                'billingaddress1' => $data['billingaddress1'],
                'billingaddress2' => $data['billingaddress2'],
                'billingcity' => $data['billingcity'],
                'billingcountry' => $data['billingcountry'],
                'billingpostalcode' => $data['billingpostalcode'],
                'billingaddressstate' => $data['billingaddressstate'],
            ]);
            $billing = $data;
        }

        $cardinfo = Creditcard::select('*')->where('order_id', '=', $orderid)->get();

        return view('site.orderreviewcreditcard_editorder')->with(array(
            'cardinfo' => $cardinfo,'billingaddress'=>$billing,'order'=>$order
        ));
    }

    public function paywithcreditcardprocess()
    {
        $orderid = Session::get('orderid');
        $cardinfo = Creditcard::select('*')->where('order_id', '=', $orderid)->get();
        $card = new PaymentCard();
        $card->setType("visa")
            ->setNumber($cardinfo[0]['card-number'])
            ->setExpireMonth($cardinfo[0]['expiredatemonth'])
            ->setExpireYear($cardinfo[0]['expiredateyear'])
            ->setCvv2($cardinfo[0]['cvv'])
            ->setFirstName($cardinfo[0]['cardfirstname'])
            ->setBillingCountry("US")
            ->setLastName($cardinfo[0]['cardlastname']);

        $fi = new FundingInstrument();
        $fi->setPaymentCard($card);

        $payer = new Payer();
        $payer->setPaymentMethod("credit_card")
            ->setFundingInstruments(array($fi));

        $carts = Cart::getContent();
        $cart_items = array();
        $total = 0;
        foreach ($carts as $cart) {
            $item = new Item();
            $item->setName($cart->name)
                ->setCurrency('USD')
                ->setQuantity($cart->quantity)
                ->setPrice($cart->price);
            $total += ($cart->quantity) * ($cart->price);
            $cart_items[] = $item;
            Orders::create([
                'userid' => Auth::user()->id,
                'pro_id' => $cart->id,
                'order_id' => $orderid,
                'pro_name' => $cart['name'],
                'pro_type' => $cart->pro_type,
                'pro_price' => $cart['price'],
                'pro_image' => $cart->image,
                'pro_text' => $cart->pro_text,
                'pro_qty' => $cart['quantity'],
                'title' => $cart->title,
                'extendedinfo' =>$cart->extendedinfo,
                'firstname' =>$cart->firstname,
                'lastname' => $cart->lastname,
                'deliveryadd1' => $cart->deliveryadd1,
                'deliveryadd2' => $cart->deliveryadd2,
                'city' => $cart->city,
                'state' => $cart->state,
                'postalcode' => $cart->postalcode,
                'country' => $cart->country,
                'rephone' => $cart->rephone,
                'reemail' => $cart->reemail,
                'deliverydate' => $cart->deliverydate,
                'deliverytype' =>  $cart->deliverytype,
                'cardmessage' => $cart->cardmessage,
                'signature' => $cart->signature,
                'orderstate' => '0',
            ]);
        }
        $itemList = new ItemList();
        $itemList->setItems($cart_items);

        $details = new Details();
        $details->setShipping(0)
            ->setTax(0)
            ->setSubtotal($total);

        $amount = new Amount();
        $amount->setCurrency("USD")
            ->setTotal($total)
            ->setDetails($details);
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Payment description")
            ->setInvoiceNumber(uniqid());
        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setTransactions(array($transaction));
        $request = clone $payment;
        $clientId = 'AVGpMyv8woePMEOTOK-9iFPGwIx7hmeZdQ_SZXyfhUQFYDmwX2ZlhacF9wK6iKGRse7kfOO_R0XZXNQo';
        $clientSecret = 'EEDHKoIayoHPPIrklbu4d3S9eYctSaCU0jNTl7_gfO_RX3bS3qnmeSO-EG0OCuTz4V6zolJ7oHUJ-6zh';
        $apiContext = getApiContext($clientId, $clientSecret);
        try {
            $payment->create($apiContext);
        } catch (Exception $ex) {
            ResultPrinter::printError('Create Payment Using Credit Card. If 500 Exception, try creating a new Credit Card using <a href="https://www.paypal-knowledge.com/infocenter/index?page=content&widgetview=true&id=FAQ1413">Step 4, on this link</a>, and using it.', 'Payment', null, $request, $ex);
            exit(1);
        }
        if($payment->state == "approved"){
            return redirect('/paypal/success');
        }else{
            return redirect('/paypal/cancel');
        }

    }
    public function paywithcreditcardorderedprocess()
    {
        $orderid = Session::get('orderid');
        $cardinfo = Creditcard::select('*')->where('order_id', '=', $orderid)->get();
        $order = Orders::select('*')->where('order_id', '=', $orderid)->get();
        $card = new PaymentCard();
        $card->setType("visa")
            ->setNumber($cardinfo[0]['card-number'])
            ->setExpireMonth($cardinfo[0]['expiredatemonth'])
            ->setExpireYear($cardinfo[0]['expiredateyear'])
            ->setCvv2($cardinfo[0]['cvv'])
            ->setFirstName($cardinfo[0]['cardfirstname'])
            ->setBillingCountry("US")
            ->setLastName($cardinfo[0]['cardlastname']);

        $fi = new FundingInstrument();
        $fi->setPaymentCard($card);

        $payer = new Payer();
        $payer->setPaymentMethod("credit_card")
            ->setFundingInstruments(array($fi));

        $cart_items = array();
        $total = 0;

        $item = new Item();
        $item->setName($order[0]->pro_name)
            ->setCurrency('USD')
            ->setQuantity($order[0]->pro_qty)
            ->setPrice($order[0]->pro_price);
        $total = ($order[0]->pro_qty) * ($order[0]->pro_price);
        $cart_items = array();
        $cart_items[] = $item;
        $itemList = new ItemList();
        $itemList->setItems($cart_items);

        $details = new Details();
        $details->setShipping(0)
            ->setTax(0)
            ->setSubtotal($total);

        $amount = new Amount();
        $amount->setCurrency("USD")
            ->setTotal($total)
            ->setDetails($details);
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Payment description")
            ->setInvoiceNumber(uniqid());
        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setTransactions(array($transaction));
        $request = clone $payment;
        $clientId = 'AVGpMyv8woePMEOTOK-9iFPGwIx7hmeZdQ_SZXyfhUQFYDmwX2ZlhacF9wK6iKGRse7kfOO_R0XZXNQo';
        $clientSecret = 'EEDHKoIayoHPPIrklbu4d3S9eYctSaCU0jNTl7_gfO_RX3bS3qnmeSO-EG0OCuTz4V6zolJ7oHUJ-6zh';
        $apiContext = getApiContext($clientId, $clientSecret);
        try {
            $payment->create($apiContext);
        } catch (Exception $ex) {
            ResultPrinter::printError('Create Payment Using Credit Card. If 500 Exception, try creating a new Credit Card using <a href="https://www.paypal-knowledge.com/infocenter/index?page=content&widgetview=true&id=FAQ1413">Step 4, on this link</a>, and using it.', 'Payment', null, $request, $ex);
            exit(1);
        }
        if($payment->state == "approved"){
            return redirect('/paypal/success');
        }else{
            return redirect('/paypal/cancel');
        }

    }
    public function orderreview(){
        $order_id = Session::get('order_id');
        $orders = Orders::select("*")->where("orders.order_id","=",$order_id)->get();
        return view('site.orderreview')->with('orders', $orders);
    }

    public function success(Request $request){

        $orderid = Session::get('orderid');
            $orders = DB::table('orders')->select('id')->where('orders.order_id', '=', $orderid)->get();
            foreach ($orders as $order) {
                $updateorder = Orders::findOrFail($order->id);
                $updateorder->orderstate = "1";
                $updateorder->save();

                $data['olddate'] = $updateorder->deliverydate;

                $user = User::findOrFail($updateorder->userid);
                $data['senderemail'] = $user->email;
                $data['sendername'] = $user->firstname;
                $data['receivername'] = $updateorder->firstname;
                $data['receiveremail'] = $updateorder->reemail;
                $data['receiverphone'] = $updateorder->rephone;
                $data['receiveradd1'] = $updateorder->deliveryadd1;
                $data['receiveradd2'] = $updateorder->deliveryadd2;
                $data['orderid'] = $updateorder->id;
                $data['pro_name'] = $updateorder->pro_name;
                $data['pro_price'] = $updateorder->pro_price;
                $data['pro_qty'] = $updateorder->pro_qty;
                $data['pro_type'] = $updateorder->pro_type;
                $data['pro_image'] = $updateorder->pro_image;
                $data['pro_text'] = $updateorder->pro_text;
                $data['city'] = $updateorder->city;
                $data['state'] = $updateorder->state;
                $data['postalcode'] = $updateorder->postalcode;


                Mail::send('emails.orderconfirm', $data, function ($message) use ($data) {
                    $message->to($data['senderemail'], $data['sendername'])->subject('Thank you for your order!');
                });
                $admin =  DB::table('users')->where('users.is_Admin', '=', '1')->get();
                $data['adminemail'] = $admin[0]->email;
                $data['adminname'] = $admin[0]->firstname;
                Mail::send('emails.orderconfirmtoadmin', $data, function ($message) use ($data) {
                    $message->to($data['adminemail'], $data['adminname'])->subject('New order created!');
                });
            }

        Cart::clear();
        Session::forget('orderid');
       return redirect('/home')->with('message', 'Thank you!');
    }
    public function cancel(){
        echo ("Woop!");
        return redirect('/home')->with('message', 'Sorry!');
    }
    public function savedraft(){
        $orderid = uniqid();
        $carts = Cart::getContent();
        $cart_items = array();
        $total = 0;
        foreach ($carts as $cart) {
            $item = new Item();
            $item->setName($cart->name)
                ->setCurrency('USD')
                ->setQuantity($cart->quantity)
                ->setPrice($cart->price);
            $total += ($cart->quantity) * ($cart->price);
            $cart_items[] = $item;
            $image = EmailTemplate::findOrFail($cart->id)->image;
            Orders::create([
                'userid' => Auth::user()->id,
                'pro_id' => $cart->id,
                'order_id' => $orderid,
                'pro_name' => $cart['name'],
                'pro_type' => 0,
                'pro_text' =>$cart->pro_text,
                'pro_price' => $cart['price'],
                'pro_image' =>$image,
                'pro_qty' => $cart['quantity'],
                'title' => $cart->title,
                'extendedinfo' =>$cart->extendedinfo,
                'firstname' =>$cart->firstname,
                'lastname' => $cart->lastname,
                'deliveryadd1' => $cart->deliveryadd1,
                'deliveryadd2' => $cart->deliveryadd2,
                'city' => $cart->city,
                'state' => $cart->state,
                'postalcode' => $cart->postalcode,
                'country' => $cart->country,
                'rephone' => $cart->rephone,
                'reemail' => $cart->reemail,
                'deliverydate' => $cart->deliverydate,
                'deliverytype' =>  $cart->deliverytype,
                'cardmessage' => $cart->cardmessage,
                'signature' => $cart->signature,
                'orderstate' => '0',
                'draftstate' => '0',
            ]);
        }
        Cart::clear();
        return redirect('/home');
    }
}
