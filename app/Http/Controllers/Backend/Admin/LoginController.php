<?php

namespace App\Http\Controllers\Backend\Admin;
 
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use App\Admin;
use App\User;
use App\Role;


class LoginController extends Controller
{
    use AuthenticatesUsers;
 
    /**
     * Where to redirect admins after login.
     *
     * @var string
     */
    protected $redirectTo = 'admin/dashboard';
 
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
        $this->user = new User;
    }
 
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('login');
    }

    /**
 * @param Request $request
 * @return \Illuminate\Http\RedirectResponse
 * @throws \Illuminate\Validation\ValidationException
 */
public function login(Request $request)
{
    $this->validate($request, [
        'mobile_no' => 'required|regex:/[0-9]{11}/|digits:11',            
    ]); 

    // Get user record
    $user = Admin::where('phone', $request->get('mobile_no'))->first();

    Auth::guard('admin')->login($user);
    return redirect()->route('backend.dashboard');

    if($request->get('mobile_no') != $user->phone) {
        return redirect()->back()->with('error', 'Your mobile number not match in our system.');
    }        
    
    // Check Condition Mobile No. Found or Not
   
    
    // Set Auth Details
    
     
}

public function logout(Request $request)
{
    Auth::guard('admin')->logout();
    $request->session()->invalidate();
    return redirect()->route('login');
}

}