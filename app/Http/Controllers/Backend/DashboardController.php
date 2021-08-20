<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\AttributesValue;
use App\Product;
use App\User;
use App\Admin;
use App\Category;
use App\Order;
use App\OrderDetails;
use Illuminate\Support\Facades\Hash;

use Auth;





class DashboardController extends Controller
{
    public function index()
    {
        
        return view('backend.dashboard');
    }

    public function deviceview(Request $request)
    {
        
         $device = $request->device;
        return response()->json(['device' => $device]);


    }
    public function display()
    {
        

        $categories = Category::latest()->where('status',1)->get();

        
        

       
        return view('frontend.compare',['categories' => $categories]);


        
    }
    public function stockDisplay(){
        $products = Product::latest()->get();
        return view('backend.stock.index', ['products' => $products]);


    }

    public function customerDisplay(){
        $customers = User::latest()->where('role_id',NULL)->get();
        return view('backend.customer.index', ['customers' => $customers]);


    }
    public function customerView($id){
        $customer = User::find($id);
        return view('backend.customer.view', ['customer' => $customer]);


    }

    public function teamDisplay(){

        $sellerid=Auth::user()->seller_id;

        $teams = User::latest()->where('ref_id',$sellerid)->get();
        return view('backend.team.index', ['teams' => $teams]);


    }
    public function destroyTeam($id)
    {
        User::find($id)->delete();
        return redirect(route('backend.team.index'))->withError('Successfully Deleted!');
    }

    public function treeDisplay($id){

        return view('backend.tree.newtree2',['id' => $id]);


    }
   

    public function profileDisplay($id){

        return view('backend.profile.view',['id' => $id]);


    }

    public function profileUpdate(Request $request, $id){

        $profile = User::find($id);


        return view('backend.profile.view', ['profile' => $profile]);


    }
    public function passwordShow(){



        return view('backend.password.create');


    }

    public function passwordUpdate(Request $request, $id){

        $profile = User::find($id);

        $profile->password = Hash::make($request->input('password'));

        $profile->save();

        return redirect(route('backend.password.show'))->withError('Successfully Updated!');





    }
    
        /** Leveling system

              *1
        *2          *3
     *4   *5       *6   *7

     */
     public function treeViewTest(){
         $user_collection = array();
         $root_user = User::find(9);

         array_push($user_collection, [
           'level' => 1,
           'name' => $root_user->first_name . $root_user->last_name,
           'seller_id' => $root_user->seller_id,
           'pcn' => $root_user->pcn,
           'grade' => $root_user->grade,
           'matches' => $root_user->matches,
           'ref_id' => $root_user->ref_id,
         ]);

        if($root_user->references->count() > 0)
         foreach($root_user->references->take(6) as $level_2_user) {
             if (count($user_collection) > 0 && count($user_collection) < 3){
                 $level = 2;
             }else if (count($user_collection) >= 3 && count($user_collection) <= 6){
                 $level = 3;
             }else {
                 $level = null;
             }
             if($level){
                 array_push($user_collection, [
                     'level' => $level,
                     'name' => $level_2_user->first_name . $root_user->last_name,
                     'seller_id' => $level_2_user->seller_id,
                     'pcn' => $level_2_user->pcn,
                     'grade' => $level_2_user->grade,
                     'matches' => $level_2_user->matches,
                     'ref_id' => $level_2_user->ref_id,
                 ]);
             }
         }

        if($root_user->references->count() > 0)
         foreach($root_user->references->take(6) as $level_2_user) {
             if($level_2_user->references->count() > 0)
             foreach($level_2_user->references->take(5) as $level_3_user) {
                 if (count($user_collection) > 0 && count($user_collection) < 3){
                     $level = 2;
                 }else if (count($user_collection) >= 3 && count($user_collection) <= 6){
                     $level = 3;
                 }else {
                     $level = null;
                 }
                 if($level){
                     array_push($user_collection, [
                         'level' => $level,
                         'name' => $level_3_user->first_name . $root_user->last_name,
                         'seller_id' => $level_3_user->seller_id,
                         'pcn' => $level_3_user->pcn,
                         'grade' => $level_3_user->grade,
                         'matches' => $level_3_user->matches,
                         'ref_id' => $level_3_user->ref_id,
                     ]);
                 }
             }
         }

         //dd(collect($level_collection)->sortBy('level')->reverse()->toArray());
         //dd(collect($level_collection)->sortBy('level')->toArray());

         $data_set = collect($user_collection)->sortBy('level')->take(7);

         //dd($data_set);

        return view('backend.tree.newtree-test', compact('data_set'));
    }
    
     public function treeView(){

        return view('backend.tree.newtree');


    }
    
    public function treeList(){
        

        return view('backend.tree.sample');


    }
    
    public function treeListzero(){
        

        return view('backend.tree.sam');


    }
    
     public function treeLevel($count,$no){
        

        return view('backend.tree.sample2',['count'=>$count,'no'=>$no]);


    }
    
    public function orderDisplay($id)
    {
        $orders = Order::latest()->where('user_id',$id)->get();
        if(!$orders){
            return redirect()->back()->with('success', 'No Order Found');



        }else{
        return view('backend.orders.myorder', ['orders' => $orders]);
        }
    }



}
