<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductDetail;

use App\Category;
use App\Order;
use App\OrderDetails;
use App\User;
use App\Admin;
use App\Settings;
use App\MSP;
use App\Funds;
use Carbon\Carbon;
use App\SalesCron;
use App\Royality;

use Cart;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cartCount=Cart::getContent()->count();
        $products = Product::all();
        $categories = Category::latest()->get();
        return view('frontend.checkout')->with(['products' => $products,'categories' => $categories,'cartCount'=>$cartCount]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 
    }

    public function placeOrder(Request $request)
    {

        $cartCount=Cart::getContent()->count();
        $products = Product::all();
        $categories = Category::latest()->get();

        $insert = new Order();
        $insert->full_address = $request->input('address');
        $insert->order_id = 'ORD-'.strtoupper(uniqid());
        $insert->user_id = auth()->user()->id;
        $insert->status = 'pending';
        $insert->order_date = Carbon::now();

        $insert->total_amount =  Cart::getSubTotal();
        $insert->total_item  =  Cart::getTotalQuantity();
        $insert->notes = $request->input('notes');

        $insert->save();


        if ($insert) {
            $oid= Order::all()->last()->order_id;

            $items = Cart::getContent();
            foreach ($items as $item)
            {
                
                
                // A better way will be to bring the product id with the cart items
                // you can explore the package documentation to send product id with the cart
                $product = Product::where('id', $item->id)->first();
                $productcode = ProductDetail::where('pid', $product->product_id)->where('status',1)->paginate($item->quantity);

                    foreach ($productcode as $proco)
                    {
                $orderItem = new OrderDetails([
                    'order_id'    =>  $oid,
                    'product_id'    =>  $product->product_id,
                    'product_code'    =>  $proco->product_id,

                    'totalquantity'      =>  $item->quantity,
                    'total_price'         =>  $item->getPriceSum(),                
                    ]);
      
                $orderItem->save();

                $prodel = ProductDetail::where('product_id', $proco->product_id)->where('status',1)->first();
                $prodel->status=0;
                $prodel->save();
                $proquantity=($product->quantity)-$item->quantity;
            $product->quantity=$proquantity;
    
            $product->save();
            
             $cat = new SalesCron();
            $cat->product_id = $proco->product_id;
    
            
            $cat->seller_id = auth()->user()->seller_id;
              $cat->ref_id = auth()->user()->ref_id;
            $cat->level = auth()->user()->level;
            $user = User::where('role_id',3)->where('level',auth()->user()->level)->where('seller_id','<',auth()->user()->seller_id)->count();
            $cat->node =$user+1;
            $cat->status =1;
    
    
            $cat->save();
                }
                


            
            }
            $msp = MSP::find(1);
            $msp->dbA+=$msp->A;
            $msp->dbB+=$msp->B;
            $msp->dbC+=$msp->C;
            $msp->dbD+=$msp->D;
            $msp->dbE+=$msp->E;
            $msp->save();
             $funds=Funds::where('id',1)->first();
            $funds->dbroyality+=$funds->royality;
            $funds->dbreward+=$funds->reward;
            $funds->dbcharity+=$funds->charity;
            $funds->dbmatching+=$funds->matching;
            $funds->dbdealership+=$funds->dealership;
            $funds->dbprofit+=$funds->profit;
        $funds->save();
        
        $royality = Royality::find(1);
            $royality->dbM+=$royality->M;
            $royality->dbAM+=$royality->AM;
            $royality->dbSM+=$royality->SM;
            $royality->dbGM+=$royality->GM;
            $royality->dbBA+=$royality->BA;
                        $royality->total+=$royality->M+$royality->AM+$royality->SM+$royality->GM+$royality->BA;

            $royality->save();
        
             $fundprice=$funds->dbroyality+$funds->dbreward+$funds->dbcharity+$funds->dbdealership+$funds->dbprofit;
$admins=User::where('seller_id',2000)->first();
$admins->points+=$fundprice;
$admins->save();
            
          $user=User::where('seller_id',auth()->user()->seller_id)->first(); 
         
          $user->points+=150*Cart::getTotalQuantity();
          $user->save();
        
        

        
        $settings=Settings::where('id',1)->first();

       $sellers = User::where('role_id',3)->where('id','<',$user->id)->where('wings',$user->wings)->where('track',$user->track)->limit(5)->latest()->get();
       $sellercount = User::where('role_id',3)->where('id','<',$user->id)->where('wings',$user->wings)->where('track',$user->track)->count();
foreach($sellers as $seller){
    if($seller->level==1){
        $seller->points+=$settings->points;
        $seller->save();
    }
    elseif($seller->level==2){
         $seller->points+=$settings->propoints;
         $seller->save();
    }
    elseif($seller->level==3){
         $seller->points+=$settings->fourpoints;
         $seller->save();
    }
     elseif($seller->level==4){
         $seller->points+=$settings->fivepoints;
         $seller->save();
    }
    elseif($seller->level==5){
         $seller->points+=$settings->sixpoints;
         $seller->save();
    }
    else{}
    
}
       


        

     
      
       


}



        return view('frontend.success')->with(['products' => $products,'categories' => $categories,'cartCount'=>$cartCount]);


        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function Cartclear(){
        Cart::clear();
        return redirect('/');


   }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
