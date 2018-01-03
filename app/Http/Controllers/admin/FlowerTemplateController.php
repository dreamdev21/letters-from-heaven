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


class FlowerTemplateController extends Controller
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
    public function template()
    {
        $templates = FlowerTemplate::select('*')->where('flower_templates.state','0')->get();
        $newcontact = DB::table('contact')->where('contact.state', '=', '0')->count();
        return view('admin.flower_template')->with(array('templates'=>$templates,'newcontact'=>$newcontact
        ));
    }
    public function draft()
    {
        $templates = FlowerTemplate::select('*')->where('flower_templates.state','1')->get();
        $newcontact = DB::table('contact')->where('contact.state', '=', '0')->count();
        return view('admin.flower_draft')->with(array('templates'=>$templates,'newcontact'=>$newcontact
        ));
    }

    public function deletebox()
    {
        $templates = FlowerTemplate::select('*')->where('flower_templates.state','2')->get();
        $newcontact = DB::table('contact')->where('contact.state', '=', '0')->count();
        return view('admin.flower_deletebox')->with(array('templates'=>$templates,'newcontact'=>$newcontact
        ));
    }
    public function update(Request $request, $id)
    {
        $data = $request->all();
        for($i = 1;$i<20;$i++){
            $imagecurrent = 'image'.$i;

            if($file = $request->hasFile($imagecurrent)) {

                $file = $request->file($imagecurrent) ;

                $fileName = time().'-'.$file->getClientOriginalName();
                $destinationPath = public_path().'/images' ;
                $file->move($destinationPath,$fileName);
                $data[$imagecurrent] = $fileName;
            }
        }

        if($file = $request->hasFile('image')) {

            $file = $request->file('image') ;

            $fileName = time().'-'.$file->getClientOriginalName();
            $destinationPath = public_path().'/images' ;
            $file->move($destinationPath,$fileName);
            $data['image'] = $fileName;
        }
		unset($data['_token']);
        FlowerTemplate::where('id', $id)->update($data);

        return back()->with('message', 'Flower template state changed successfull!');
    }
    public function destroy($id) {

        $flower = FlowerTemplate::findOrFail($id);

        if ($flower->state == "1"){
            $flower['state'] = "2";
            $flower->save();
            return redirect('admin/flower/draft')->with('message', 'Flower template moved to Deletebox successfull!');
        }elseif($flower->state == "0"){
            $flower['state'] = "2";
            $flower->save();
            return redirect('admin/flower/template')->with('message', 'Flower template moved to Deletebox successfull!');
        }else{
            $flower->delete();
            return redirect('admin/flower/deletebox')->with('message', 'Flower template deleted from Deletebox successfull!');
        }
    }
    public function save(Request $request)
    {
        $data = $request->all();

        for($i = 1;$i<20;$i++) {
            $imagecurrent = 'image' . $i;
            if (array_key_exists($imagecurrent, $data)) {
                if ($file = $request->hasFile($imagecurrent)) {

                    $file = $request->file($imagecurrent);

                    $fileName = time() . '-' . $file->getClientOriginalName();
                    $destinationPath = public_path() . '/images';
                    $file->move($destinationPath, $fileName);
                    $data[$imagecurrent] = $fileName;
                }
            }
        }
        if ($file = $request->hasFile('image')) {

            $file = $request->file('image');

            $fileName = time() . '-' . $file->getClientOriginalName();
            $destinationPath = public_path() . '/images';
            $file->move($destinationPath, $fileName);
            $data['image'] = $fileName;
        }
        FlowerTemplate::create($data);

        return redirect('admin/flower/template');
    }

}
