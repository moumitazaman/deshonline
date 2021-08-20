<?php

namespace App\Http\Controllers\Backend;
use App\Sales;
use App\SalesCron;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\ProductDetail;

use App\User;
use App\Order;

use App\Settings;
use App\Admin;



class SalesController extends Controller
{
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.sales.create');

    }


    public function store(Request $request)
    {
        
        $sales = Sales::where('product_id',$request->input('product_id'))->first();
        if($sales)
        {
            $request->session()->flash('success', 'Duplicate Entry.Product Already Sold');

            return redirect()->route('backend.sales.create');

        }
        else{


        $category = new Sales();
        $category->product_id = $request->input('product_id');

        $category->customer_name = $request->input('customer_name');

        $category->phone = $request->input('phone');
        $category->seller_id = $request->input('seller_id');
        $category->ref_id = $request->input('ref_id');


        $category->save();

        $cat = new SalesCron();
        $cat->product_id = $request->input('product_id');

        $cat->customer_name = $request->input('customer_name');

        $cat->phone = $request->input('phone');
        $cat->seller_id = $request->input('seller_id');
        $cat->ref_id = $request->input('ref_id');
        $cat->status =1;


        $cat->save();

$code=$request->input('product_id');
$pid = ProductDetail::where('product_id',$code)->where('status',1)->first();
if($pid){
        $products = Product::where('product_id',$pid->pid)->first();
        if($products->quantity ==0)
        {
            $request->session()->flash('success', 'Item Not Available');

            return redirect()->route('backend.sales.create');


        }
        else{
            $proquantity=($products->quantity)-1;
            $products->quantity=$proquantity;
    
            $products->save();

        }
    }
    else{
        $request->session()->flash('success', 'Item Not Available');

        return redirect()->route('backend.sales.create');

    }

        ProductDetail::latest()->where('product_id',$code)->delete();


        $settings=Settings::where('id',1)->first();

      

        $sid=$request->input('seller_id');
        $rid=$request->input('ref_id');


        
        
       $sellers = User::where('seller_id',$sid)->first();
       


        $refers = User::where('seller_id',$rid)->first();
       

        $toprefers = User::where('seller_id',$refers->ref_id)->first();
        if($toprefers->ref_id){
            $fourrefers = User::where('seller_id',$toprefers->ref_id)->first();

        }
        elseif($toprefers->ref_id && $fourrefers->ref_id){
            $fourrefers = User::where('seller_id',$toprefers->ref_id)->first();

            $fiverefers = User::where('seller_id',$fourrefers->ref_id)->first();

        }
        elseif($toprefers->ref_id && $fourrefers->ref_id && $fiverefers->ref_id){
            $fourrefers = User::where('seller_id',$toprefers->ref_id)->first();

            $fiverefers = User::where('seller_id',$fourrefers->ref_id)->first();
            $sixrefers = User::where('seller_id',$fiverefers->ref_id)->first();



        }
        
      
       


if($rid==0){
    $sellers = User::where('seller_id',$sid)->first();
        $sellers->points+=$settings->points;


        $sellers->save();

}
        
elseif($refers->ref_id==0){
    
    $sellers = User::where('seller_id',$sid)->first();
    $sellers->points+=$settings->refpoints;
    $sellers->save();

    $refers = User::where('seller_id',$rid)->first();
    $refers->points+=$settings->points;
    $refers->save();


}
elseif($toprefers->ref_id==0){
    $sellers = User::where('seller_id',$sid)->first();
    $sellers->points+=$settings->propoints;
    $sellers->save();

    $refers = User::where('seller_id',$rid)->first();
    $refers->points+=$settings->refpoints;
    $refers->save();

    $toprefers = User::where('seller_id',$refers->ref_id)->first();
    $toprefers->points+=$settings->points;
    $toprefers->save();


}
elseif($fourrefers->ref_id==0){
    $sellers = User::where('seller_id',$sid)->first();
    $sellers->points+=$settings->fourpoints;
    $sellers->save();

    $refers = User::where('seller_id',$rid)->first();
    $refers->points+=$settings->propoints;
    $refers->save();

    $toprefers = User::where('seller_id',$refers->ref_id)->first();
    $toprefers->points+=$settings->refpoints;
    $toprefers->save();

    $toptoprefers = User::where('seller_id',$toprefers->ref_id)->first();
    $toptoprefers->points+=$settings->points;
    $toptoprefers->save();

}
elseif($fiverefers->ref_id==0){
    $sellers = User::where('seller_id',$sid)->first();
    $sellers->points+=$settings->fivepoints;
    $sellers->save();

    $refers = User::where('seller_id',$rid)->first();
    $refers->points+=$settings->fourpoints;
    $refers->save();

    $toprefers = User::where('seller_id',$refers->ref_id)->first();
    $toprefers->points+=$settings->propoints;
    $toprefers->save();

    $toptoprefers = User::where('seller_id',$toprefers->ref_id)->first();
    $toptoprefers->points+=$settings->refpoints;
    $toptoprefers->save();

    $level1refers = User::where('seller_id',$toptoprefers->ref_id)->first();
    $level1refers->points+=$settings->points;
    $level1refers->save();

}
elseif($sixrefers->ref_id==0){
    $sellers = User::where('seller_id',$sid)->first();
    $sellers->points+=$settings->sixpoints;
    $sellers->save();

    $refers = User::where('seller_id',$rid)->first();
    $refers->points+=$settings->fivepoints;
    $refers->save();

    $toprefers = User::where('seller_id',$refers->ref_id)->first();
    $toprefers->points+=$settings->fourpoints;
    $toprefers->save();

    $toptoprefers = User::where('seller_id',$toprefers->ref_id)->first();
    $toptoprefers->points+=$settings->propoints;
    $toptoprefers->save();
    $level2refers = User::where('seller_id',$toptoprefers->ref_id)->first();
    $level2refers->points+=$settings->refpoints;
    $level2refers->save();

    $level1refers = User::where('seller_id',$level2refers->ref_id)->first();
    $level1refers->points+=$settings->points;
    $level1refers->save();

}
else{
   

        

        

       
}

        

        $item = Order::where('user_id',$sid)->where('status','pending')->first();
        if($item){
        $item->total_item=0;
        $item->save();
        }

    }


        $request->session()->flash('success', 'Successfully Updated!');
        return redirect(route('backend.sales.create'));
    }







} 
