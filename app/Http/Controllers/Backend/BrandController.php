<?php

namespace App\Http\Controllers\Backend;
use App\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::latest()->get();
        
        return view('backend.brand.index', ['brands' => $brands]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.brand.create');
    }
    
    public function store(Request $request)
    {
        if ($request->file('image')) {
            $imagePath = $request->file('image');
            $imageName = $imagePath->getClientOriginalName();
            $path = $request->file('image')->storeAs('uploads/brand', $imageName, 'public');
            $request->image->move(public_path('/uploads/brand'), $imageName);
  
          }
  
        
        $brand = new Brand();
        $brand->brand_name = request('name');
        $brand->brand_logo =$imageName;

        $brand->save();

        $request->session()->flash('success', 'Successfully Created!');
        return redirect(route('backend.brand.create'));
    }

    public function edit($id)
    {
        $brand = Brand::find($id);
       
        

    


        return view('backend.brand.edit', ['brand' => $brand]);
    }
    

    public function destroy($id)
    {
        Brand::find($id)->delete();
        return redirect(route('backend.brand.index'))->withError('Successfully Deleted!');
    }
}
