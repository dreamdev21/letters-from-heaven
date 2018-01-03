<?php
namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
class AdminController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = '/admin/dashboard';
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function showLoginForm()
    {
        return view('auth.admin-login');
    }
    public function login( Request $request )
    {
        // Validate form data
        $this->validate($request, [
            'email'     => 'required|email',
            'password'  => 'required|min:6'
        ]);
//        echo($request);exit;
        // Attempt to authenticate user
        // If successful, redirect to their intended location
        return $this->authenticated($request, $this->guard()->user())
            ?: redirect()->intended($this->redirectPath());
        // Authentication failed, redirect back to the login form
        return redirect()->back()->withInput( $request->only('email', 'remember') );
    }
    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::guard()->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect()->guest(route( 'login' ));
    }
}