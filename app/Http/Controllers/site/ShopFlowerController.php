<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\FlowerTemplate;
use DB;
use App\Http\Requests;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Support\Facades\URL;
use Session;


class ShopFlowerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $templates = FlowerTemplate::select('*')->where('flower_templates.state','0')->get();
        return view('site.shop_flower')->with('templates',$templates);
    }
    public function flower($id) {

        if (strpos(URL::previous(), 'email') !== false) {
            $product = EmailTemplate::findOrFail($id);
            $pro_type = 0;
        }
        else{
            $product = FlowerTemplate::findOrFail($id);
            $alltemplates = FlowerTemplate::all();
            $pro_type = 1;
        }

        Session::forget('form-data');
        return view('site.shop_flower_detail')->with(array('template'=>$product,'alltemplates'=>$alltemplates));
    }

}
