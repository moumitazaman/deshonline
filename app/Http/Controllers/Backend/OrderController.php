<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\SubCategory;
use App\Order;
use App\OrderDetails;
use App\User;

use App\Brand;
use App\Attributes;
use App\AttributesValue;
use App\ProductAtributes;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use PDF;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::latest()->get();
        return view('backend.orders.index', ['orders' => $orders]);
    }
  

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.product.sellercreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = new OrderDetails();
        $category->order_id = 'ORD-'.strtoupper(uniqid());


        $category->product_id = $request->input('product_id');
        $category->seller_id = $request->input('seller_id');

        $category->totalquantity = $request->input('quantity');
        $category->total_price = $request->input('amount');


        $category->save();
        $prodel =User::where('seller_id', $request->input('seller_id'))->where('status',1)->first();
                $prodel->carry+=$request->input('quantity');
                $prodel->save();
        $request->session()->flash('success', 'Successfully Updated!');
        return redirect(route('backend.sellerproduct.store'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $agent = Order::find($id);
        return view('backend.orders.view', ['agent' => $agent]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $agents= Order::find($id);
        
         
        $pdf = PDF::loadView('backend.order.invoice',['agent' => $agents]);  
        return $pdf->setPaper('a4','landscape')->setWarnings(false)->download('invoice.pdf');
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
    
        public function approve($id){
   
        $order = Order::findOrFail($id);
        $order->status = 'approved';
        $order->save();

       /* $userid=$order->user_id;
        $user = User::where('id',$userid)->first();

        $agent= ['order_id' => $order->order_id, 'userid' => $userid,'order_date' => $order->order_date,'total_amount' => $order->total_amount];

        $pdf = PDF::loadView('emails.emailpdf', $agent);


        $data = ['name' => $user->first_name, 'email' => $user->email ];

        Mail::send('emails.emailapprove', $data, function ($message) use ($data,$pdf)
        {
            $message->from('mail@pcforall.iciclecorp.space','Admin');
            $message->to($data['email'], $data['name'])
                ->subject('Approval of Order')
                ->attachData($pdf->output(), "invoice.pdf");
        });
        */
 
       
        return redirect()->route('backend.order.index')->with('success','Approved');
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
