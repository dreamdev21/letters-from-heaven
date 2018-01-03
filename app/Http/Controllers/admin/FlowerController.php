<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\FlowerTemplate;
use App\Orders;
use DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;


class FlowerController extends Controller
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

    public function draft()
    {
        $orders = DB::table('orders')->select('orders.id','users.email as useremail','users.firstname as userfirstname','users.lastname as userlastname','users.phone as userphone','orders.pro_id','orders.pro_name','orders.pro_price','orders.pro_qty','orders.pro_image','orders.title','orders.extendedinfo','orders.firstname','orders.lastname','orders.deliveryadd1','orders.deliveryadd2','orders.city','orders.state','orders.postalcode','orders.country','orders.rephone','orders.reemail','orders.deliverydate','orders.cardmessage','orders.signature','orders.created_at','orders.updated_at')->where('orders.orderstate', '=', '0')->where('orders.pro_type', '=', '1')->join('users', 'users.id', '=', 'orders.userid')->get();
        print_r($orders);exit;
        $newcontact = DB::table('contact')->where('contact.state', '=', '0')->count();
        return view('admin.flower_draft')->with(array('orders'=>$orders,'newcontact'=>$newcontact));
    }
    public function update(Request $request, $id)
    {

        FlowerTemplate::where('id', $id)->update($request->except('_token'));

        return redirect('admin/flower/template');
    }
    public function destroy($id) {

        $flower = FlowerTemplate::findOrFail($id);

        $flower->delete();

        return redirect('admin/flower/template');
    }
    public function save(Request $request)
    {
        $flower = new FlowerTemplate($request->all()) ;

        if($file = $request->hasFile('image')) {

            $file = $request->file('image') ;

            $fileName = time().'-'.$file->getClientOriginalName();
            $destinationPath = public_path().'/images' ;
            $file->move($destinationPath,$fileName);
            $flower->image = $fileName;
        }
        $flower->save() ;
        return redirect('admin/flower/template');
    }

}
