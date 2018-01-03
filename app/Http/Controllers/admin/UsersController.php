<?php

namespace App\Http\Controllers\admin;

use App\user;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Crypt;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'address' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
        ]);
    }
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
        $users = DB::table('users')
                 ->select('users.id','users.firstname','users.lastname','users.email','users.password','users.address','users.state','users.zip','users.phone','users.dateofbirth')
                 ->where('users.is_Admin', '=', '0')
                 ->get();
        $newcontact = DB::table('contact')->where('contact.state', '=', '0')->count();

        return view('admin.users')->with(array('users'=>$users,'newcontact'=>$newcontact));
    }
    public function update(Request $request, $id)
    {
        User::where('id', $id)->update($request->except('_token'));

        return redirect('admin/users');
    }
    public function destroy($id) {

        $user = User::findOrFail($id);

        $user->delete();

        return redirect('admin/users');
    }
    public function save(Request $request) {
        $this->validator($request->all())->validate();

        $data=$request->all();

        User::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'address' => $data['address'],
            'state' => $data['state'],
            'zip' => $data['zip'],
            'phone' => $data['phone'],
            'dateofbirth' => $data['dateofbirth'],
            'is_Admin' => $data['is_Admin'],
        ]);

        return redirect('admin/users');
    }
}
