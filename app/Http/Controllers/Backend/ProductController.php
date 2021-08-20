<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\SubCategory;

use App\Brand; 
use App\Attributes;
use App\AttributesValue;
use App\ProductAtributes;
use App\ProductDetail;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $products = Product::latest()->get();
        return view('backend.product.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::latest()->where('status',1)->get();
        $subcategories = SubCategory::latest()->where('status',1)->get();

        $brands = Brand::latest()->get();
        $attrs = Attributes::latest()->get();
        $attrvalues = AttributesValue::latest()->get();



        return view('backend.product.create',['subcategories' => $subcategories,'categories' => $categories,'brands' => $brands,'attrs' => $attrs,'attrvalues' => $attrvalues]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->file('image')) {
            $imagePath = $request->file('image');
            $imageName = $imagePath->getClientOriginalName();
            $path = $request->file('image')->storeAs('uploads', $imageName, 'public');
            $request->image->move(public_path('/uploads'), $imageName);
  
          }
          $insert = new Product();

          $images=array();
          if($files=$request->file('galleryimages')){
              foreach($files as $file){
                  $name=$file->getClientOriginalName();
                  $file->move(public_path('/uploads'), $name);
                  $images[]=$name;
                  $insert->galleryimages =implode(',',$images);

              }

          }
  
       
          $insert->product_id = 'PRO-'.strtoupper(uniqid());

            $insert->product_name = $request->input('name');
            $insert->stock_quantity = $request->input('quantity');

            $insert->quantity = $request->input('quantity');

            $insert->price = $request->input('price');
            $insert->discount_price = $request->input('discount_price');
                        $insert->points = $request->input('points');

            $insert->details = $request->input('details');

            $insert->category_id = $request->input('category');
            $insert->subcategory_id = $request->input('subcategory');

            $insert->brand_id = $request->input('brand');


            $insert->img_name =$imageName;


            $insert->save();

            $pid= Product::all()->last()->id;;
            $insertattr = new ProductAtributes();

            $insertattr->attr_id = $request->input('attr_check');
            
            $insertattr->product_id = $pid;

            $insertattr->details=$request->input('attr_detail');
            $insertattr->selectval=$request->input('attr_select');

            $insertattr->save();

                
                $quant = Product::all()->last()->quantity;
                $product_id = Product::all()->last()->product_id;

                for($i=1;$i<=$quant;$i++)
                {
                    // A better way will be to bring the product id with the cart items
                    // you can explore the package documentation to send product id with the cart
    
                     $orderItem = new ProductDetail;
                    $orderItem->product_id= $product_id.".".$i;
                    $orderItem->pid= $product_id;

                    $orderItem->status= 1;
          
                    $orderItem->save();
                }
            
    



  

            
        $request->session()->flash('success', 'Successfully Created!');
        return redirect(route('backend.product.create'));
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $products= ProductDetail::where('pid',$id)->where('status',1)->get();

        return view('backend.product.show', ['products' => $products]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::latest()->where('status',1)->get();
        $brands = Brand::latest()->get();
        $subcategories = SubCategory::latest()->where('status',1)->get();

        $proattrs= ProductAtributes::where('product_id',$id)->first();
       

        

    


        return view('backend.product.edit', ['product' => $product,'subcategories' => $subcategories,'categories' => $categories,'brands' => $brands,'productattributes'=>$proattrs]);
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
    $update = Product::find($id);

    if ($request->file('image')) {
        $imagePath = $request->file('image');
        $imageName = $imagePath->getClientOriginalName();
        $path = $request->file('image')->storeAs('uploads', $imageName, 'public');
        $request->image->move(public_path('/uploads'), $imageName);
        $update->img_name =$imageName;


      }
      $images=array();
          if($files=$request->file('galleryimages')){
              foreach($files as $file){
                  $name=$file->getClientOriginalName();
                  $file->move(public_path('/uploads'), $name);
                  $images[]=$name;
                  $update->galleryimages =implode(',',$images);

              }

          }

    $update->product_name = $request->input('name');
    
    $update->quantity = $request->input('quantity');

    $update->price = $request->input('price');
    $update->discount_price = $request->input('discount_price');
                $update->points = $request->input('points');

    $update->details = $request->input('details');

    $update->category_id = $request->input('category');
    $update->subcategory_id = $request->input('subcategory');

    $update->brand_id = $request->input('brand');

    $update->save();
            $insertattr = ProductAtributes::find($id);

            $insertattr->attr_id = $request->input('attr_check');
            
            $insertattr->product_id = $id;

            $insertattr->details=$request->input('attr_detail');
            $insertattr->selectval=$request->input('attr_select');

            $insertattr->save();

            $request->session()->flash('success', 'Successfully Updated!');
            return redirect(route('backend.product.edit'));

    
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::find($id)->delete();
        return redirect(route('backend.product.index'))->withError('Successfully Deleted!');
    }
}
