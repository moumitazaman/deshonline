<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Brand;
use Illuminate\Support\Facades\DB;

use Cart;

class FrontProductController extends Controller
{
    /*protected $productRepository;
 
    public function __construct(ProductContract $productRepository)
    {
        $this->productRepository = $productRepository;
    }*/
 
    public function show($id)
    {
        //$product = $this->productRepository->findProductBySlug($slug);
        $product = Product::find($id);

 
        dd($product);
    }

    public function singleProduct($id)
    {
        $product = Product::find($id);
        $categories = Category::latest()->where('status',1)->get();

        $cartCount=Cart::getContent()->count();


    


        return view('frontend.single', ['cartCount'=>$cartCount,'product'=>$product,'categories' => $categories]);


    }

    public function priceFilter(Request $request)
    {
        $allcategory= Category::latest()->where('status',1)->get();
        $min=(int)$request->input('min_price');
        $max=(int)$request->input('max_price');

        $categories = Category::latest()->where('status',1)->get();
        $cartCount=Cart::getContent()->count();
        $products = Product::whereBetween('price', array($min,$max))->orderBy('price','asc')->get();
        $procount = Product::whereBetween('price', array($min,$max))->count();
       


        $brands = Brand::latest()->get();


        return view('frontend.filter', ['cartCount'=>$cartCount,'brands'=>$brands,'allcategory'=>$allcategory,'products' => $products,'procount'=>$procount]);


    }

    
    
}
