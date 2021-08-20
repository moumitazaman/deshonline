<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Brand;
use App\SubCategory;


use Cart;




class FrontController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->get();
        $categories = Category::latest()->where('status',1)->get();
        $brands = Brand::latest()->get();

        $cartCount=Cart::getContent()->count();

        

        return view('frontend.index',['products' => $products,'brands'=>$brands,'categories' => $categories,'cartCount' => $cartCount]);
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function compare(Request $request)
    {

        $ids=$request->input('cpid');
        

   return  redirect()->route('front.display')->with( ['ids' => $ids] );

 
    }
    public function display()
    {
        

        $categories = Category::latest()->where('status',1)->get();

        
        

       
        return view('frontend.compare',['categories' => $categories]);


        
    }
    public function details(Request $request)
    {

        $id=$request->input('id');
        $product = Product::find($id);
        $product_name=$product->product_name;

        

        return response()->json(['product_name'=>$product_name ]);

 
    }
    public function show($id)
    {
        $category = Category::find($id);
       $category_name=$category->category_name;
        $products = Product::where('category_id',$id)->get();

        $procount = Product::where('category_id',$id)->count();

        $allcategory= Category::latest()->where('status',1)->get();

        $brands = Brand::latest()->get();
        $cartCount=Cart::getContent()->count();
        $categories = Category::latest()->where('status',1)->get();


    


        return view('frontend.category', ['categories'=>$categories,'cartCount'=>$cartCount,'brands'=>$brands,'allcategory'=>$allcategory,'categories' => $categories,'products' => $products,'procount'=>$procount,'category_name'=>$category_name]);
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

    public function showBrand($id)
    {
        $brandings = Brand::find($id);
       $brand_name=$brandings->brand_name;
        $products = Product::where('brand_id',$id)->get();

        $procount = Product::where('brand_id',$id)->count();

        $allcategory= Category::latest()->where('status',1)->get();

        $brands = Brand::latest()->get();
        $cartCount=Cart::getContent()->count();


    


        return view('frontend.brand', ['cartCount'=>$cartCount,'brands'=>$brands,'allcategory'=>$allcategory,'brandings' => $brandings,'products' => $products,'procount'=>$procount,'brand_name'=>$brand_name]);
    }

    public function showSub($id)
    {
        $subcats = SubCategory::find($id);
       $sub_name=$subcats->sub_category_name;
        $products = Product::where('subcategory_id',$id)->get();

        $procount = Product::where('subcategory_id',$id)->count();

        $allcategory= Category::latest()->where('status',1)->get();

        $brands = Brand::latest()->get();
        $cartCount=Cart::getContent()->count();

        $categories = Category::latest()->where('status',1)->get();

    


        return view('frontend.subcategory', ['categories'=>$categories,'cartCount'=>$cartCount,'brands'=>$brands,'allcategory'=>$allcategory,'subcats' => $subcats,'products' => $products,'procount'=>$procount,'sub_name'=>$sub_name]);
    }

    public function searchPro(Request $request)
    {
        $allcategory= Category::latest()->where('status',1)->get();
        $categories = Category::latest()->where('status',1)->get();

        $brands = Brand::latest()->get();
        $cartCount=Cart::getContent()->count();
        $search = $request->input('keyword');

        if($request->input('category')){
            $cat=$request->input('category');
            $products = Product::where('product_name','LIKE','%'.$search.'%')->where('category_id',$cat)->get();

    $procount =Product::where('product_name','LIKE','%'.$search.'%')->where('category_id',$cat)->count();
    

        }
        else{
            $products = Product::where('product_name','LIKE','%'.$search.'%')->get();

    $procount =Product::where('product_name','LIKE','%'.$search.'%')->count();

        }

        

    
    


        return view('frontend.search', ['categories'=>$categories,'cartCount'=>$cartCount,'brands'=>$brands,'allcategory'=>$allcategory,'products' => $products,'procount'=>$procount]);
    }
}
