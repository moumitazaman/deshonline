<?php

namespace App\Http\Controllers\Backend;
use App\Category;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        
        return view('backend.category.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.category.create');
    }
    
    public function store(Request $request)
    {
        if ($request->file('image')) {
            $imagePath = $request->file('image');
            $imageName = $imagePath->getClientOriginalName();
            $path = $request->file('image')->storeAs('uploads/icon', $imageName, 'public');
            $request->image->move(public_path('/uploads/icon'), $imageName);
  
          }
  
        
        $category = new Category();
        $category->category_name = request('name');
        $category->icon =$imageName;
        $category->status = request('status');

        $category->save();

        $request->session()->flash('success', 'Successfully Created!');
        return redirect(route('backend.category.create'));
    }

    public function edit($id)
    {
        $category = Category::find($id);
       
        

    


        return view('backend.category.edit', ['category' => $category]);
    }

    public function update(Request $request, $id)
    {
        
        $category = Category::find($id);


        if ($request->file('image')) {
            $imagePath = $request->file('image');
            $imageName = $imagePath->getClientOriginalName();
            $path = $request->file('image')->storeAs('uploads/icon', $imageName, 'public');
            $request->image->move(public_path('/uploads/icon'), $imageName);
            $category->icon =$imageName;

  
          }
  
        
        $category->category_name = request('name');
        $category->status = request('status');

        $category->save();

        $request->session()->flash('success', 'Successfully Updated!');
        return redirect(route('backend.category.index'));

    }
    













    public function destroy($id)
    {
        Category::find($id)->delete();
        return redirect(route('backend.category.index'))->withError('Successfully Deleted!');
    }

}
