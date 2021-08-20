<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use Cart;

class CartController extends Controller
{
   

   
    public function shop()
    {
        $cartCount=Cart::getContent()->count();
        $products = Product::all();
        $categories = Category::latest()->get();

        return view('frontend.shop')->withTitle('E-COMMERCE STORE | SHOP')->with(['products' => $products,'categories' => $categories,'cartCount'=>$cartCount]);
    }
 
    public function cart()  {
        $cartCollection = \Cart::getContent();
        $cartCount=Cart::getContent()->count();
        $categories = Category::latest()->get();

        return view('frontend.cart')->withTitle(' CART')->with(['cartCollection' => $cartCollection,'cartCount' => $cartCount,'categories' => $categories]);
    }

    public function add(Request $request){

         $id=$request->input('pid');
   
        
        $products = Product::find($id);


        \Cart::add(array(
            uniqid(),
            'id' => $request->pid,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'attributes' => array(),
            'associatedModel' => $products

            
        ));
        $cartCount=Cart::getContent()->count();

        //$product = Product::find($id);
      /*  if($products->quantity ==0)
        {
            return redirect()->route('cart.index')->with('success_msg', 'Item Not Available');


        }
        else{
            $proquantity=($products->quantity)-request('quantity');
            $products->quantity=$proquantity;
    
            $products->save();

        }*/
       
        //return redirect()->route('cart.index')->with('success_msg', 'Item is Added to Cart!');
        return response()->json(['cartCount' => $cartCount]);

    }





  /*  public function addToCart($id)
    {
        $product = Product::find($id);

        if(!$product) {

            abort(404);

        }

        $cart = session()->get('cart');

        // if cart is empty then this the first product
        if(!$cart) {

            $cart = [
                $id => [
                    "product_name" => $product->product_name,
                    "quantity" => 1,
                    "price" => $product->price,
                    "img_name" => $product->img_name
                ]
            ];

            session()->put('cart', $cart);

            $htmlCart = view('frontend._header_cart')->render();

           // return response()->json(['msg' => 'Product added to cart successfully!', 'data' => $htmlCart]);

            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }

        // if cart not empty then check if this product exist then increment quantity
        if(isset($cart[$id])) {

            $cart[$id]['quantity']++;

            session()->put('cart', $cart);

            $htmlCart = view('frontend._header_cart')->render();

            //return response()->json(['msg' => 'Product added to cart successfully!', 'data' => $htmlCart]);

            return redirect()->back()->with('success', 'Product added to cart successfully!');

        }

        // if item not exist in cart then add to cart with quantity = 1
        $cart[$id] = [
            "product_name" => $product->product_name,
            "quantity" => 1,
            "price" => $product->price,
            "img_name" => $product->img_name
        ];

        session()->put('cart', $cart);

        $htmlCart = view('frontend._header_cart')->render();

        //return response()->json(['msg' => 'Product added to cart successfully!', 'data' => $htmlCart]);

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
*/

public function increasePromsg($id)  {
    
    
    return response()->json([]);

}

    public function update(Request $request)
    {
        if($request->proId and $request->qty)
        {
            $id=$request->proId;
            $qty=$request->qty; 
          /* \Cart::update($request->proId,[
                
                'quantity' => $request->qty,
                'price' => $request->price
            ]);*/

            Cart::update($id, ['quantity' => ['relative' => false,
                                   'value' => $qty
          ],
            ]);
            $total=\Cart::getTotal();
            $no=\Cart::getTotalQuantity();

            


            return response()->json(['total' =>$total ,'no'=>$no]);

            //session()->flash('success', 'Cart updated successfully');
        }
    }

   
    


    /**
     * getCartTotal
     *
     *
     * @return float|int
     */
    private function getCartTotal()
    {
        $total = 0;

        $cart = session()->get('cart');

        foreach($cart as $id => $details) {
            $total += $details['price'] * $details['quantity'];
        }

        return number_format($total, 2);
    }

    public function removeItem(Request $request)
{
    $id=$request->id;
    $no=$request->quant;
        
        $product = Product::find($id);
        if($product->quantity ==0)
        {
            return redirect()->route('cart.index')->with('success_msg', 'Item Not Available');


        }
        else{
            Cart::remove($id);
/*
            $proquantity=$product->quantity;
            $product->quantity+=$no;
    
            $product->save();*/

        }
 
    if (Cart::isEmpty()) {
        return redirect('/');
    }

    $qty=\Cart::getTotalQuantity();
    $total=\Cart::getTotal();

    //return redirect()->back()->with('message', 'Item removed from cart successfully.');
    return response()->json([ 'no' => $no,'qty' => $qty, 'total' => $total]);

}

public function clearCart()
{
    Cart::clear();

    return redirect('/');
}






}
