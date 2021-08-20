<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Category;
use App\SubCategory;



class SubcategoryController extends Controller
{
    public function index()
    {
        $subcategories = SubCategory::latest()->get();
        
        return view('backend.subcategory.index', ['subcategories' => $subcategories]);
    }

    public function create()
    {
        $categories = Category::latest()->where('status',1)->get();

        return view('backend.subcategory.create', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        if ($request->file('image')) {
            $imagePath = $request->file('image');
            $imageName = $imagePath->getClientOriginalName();
            $path = $request->file('image')->storeAs('uploads/icon', $imageName, 'public');
            $request->image->move(public_path('/uploads/icon'), $imageName);
  
          }
  
        
        $subcategory = new SubCategory();
        $subcategory->sub_category_name = request('name');
        $subcategory->icon =$imageName;
        $subcategory->category_id = request('category');

        $subcategory->status = request('status');

        $subcategory->save();

        $request->session()->flash('success', 'Successfully Created!');
        return redirect(route('backend.subcategory.create'));
    }

    public function edit($id)
    {
        $category = SubCategory::find($id);
        $categories = Category::latest()->where('status',1)->get();

        

    


        return view('backend.subcategory.edit', ['category' => $category,'categories' => $categories]);
    }

    public function update(Request $request, $id)
    {
        
        $category = SubCategory::find($id);


        if ($request->file('image')) {
            $imagePath = $request->file('image');
            $imageName = $imagePath->getClientOriginalName();
            $path = $request->file('image')->storeAs('uploads/icon', $imageName, 'public');
            $request->image->move(public_path('/uploads/icon'), $imageName);
            $category->icon =$imageName;

  
          }
  
        
        $category->sub_category_name = request('name');
        $category->status = request('status');
        $category->category_id = request('category');

        $category->save();

        $request->session()->flash('success', 'Successfully Updated!');
        return redirect(route('backend.subcategory.index'));

    }
    




    public function show($id)
    {
        $subcat = SubCategory::where('category_id',$id)->get();
    
        return response()->json(['subcat'=>$subcat ]);

    }








    public function destroy($id)
    {
        SubCategory::find($id)->delete();
        return redirect(route('backend.subcategory.index'))->withError('Successfully Deleted!');
    }

}
