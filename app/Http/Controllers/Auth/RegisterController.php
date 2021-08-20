<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Request; 
use Redirect;
use App\Settings;

use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;



class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function showRegistrationForm()
    {
        
        $role_id= DB::table('roles')->select('id')->where('slug','seller')->first();

        $customer =  User::get();
      

        if(count($customer) > 0){
            $id = User::latest()->get()->first();
            $customer_id =$id->seller_id+1;
        }
        else{
            $customer_id = 2000;
        }
        $customer_id_length = strlen((string)$customer_id);
        $zero_fill = (int)$customer_id_length + 1;

        return view('auth.register',[
            
            'customer_id' => $customer_id,
            'zero_fill' => $zero_fill,
        ]);
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['string', 'email', 'max:255', 'unique:users'],
            //'phone' => ['required','max:11', 'unique:users'],

            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        
    return User::create([
                'seller_id' => $data['customer_id'],

        'first_name' => $data['first_name'],
        'last_name' => $data['last_name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'address' => $data['address'],
        'phone' => $data['phone'],

        'city' => $data['city'],
        

          

    ]);

        
    }
}
