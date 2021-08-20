<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';
    //protected $redirectTo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
        $this->middleware('guest')->except('logout');
    }

    /*protected function authenticated(Request $request, $user)
    {
        if ($user) {
            $this->redirectTo = route('/home');
        } elseif ($user->is_author()) {
            // $this->redirectTo = route('author.dashboard');
        } else {
            $this->guard()->logout();
            $request->session()->flush();
            $request->session()->regenerate();

            return redirect('login');
        }
    }*/

    public function showLoginForm()
    {
        return view('auth.login');
    }

    

    public function login(Request $request)
    {
        // Check validation
        $this->validate($request, [
           // 'mobile_no' => 'required|regex:/[0-9]{11}/|digits:11',            
        ]);
        // Get user record
        $user = User::where('seller_id', $request->get('mobile_no'))->first();

        if(!$user) {
            return redirect()->back()->with('error', 'Sorry You Are Not Registered in Our System');
        }   
       
        $check=Hash::check($request->input('password'), $user->password);
        // Check Condition Mobile No. Found or Not
        if($request->get('mobile_no') != $user->seller_id) {
            return redirect()->back()->with('error', 'Your user id number does not match.');
        }        
        if($check){
        // Set Auth Details
        \Auth::login($user);
        
        
        // Redirect home page
        return redirect()->route('index');
        }
        else{
            return redirect()->back()->with('error', 'Incorrect Password.Please try again');


        }
    }


    
}
