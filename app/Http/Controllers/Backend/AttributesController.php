<?php

namespace App\Http\Controllers\Backend;
use App\Attributes;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;


class AttributesController extends Controller
{
    public function index()
    {
        $attributes = Attributes::latest()->get();
        
        return view('backend.attributes.index', ['attributes' => $attributes]);
    }

    public function create()
    {
        return view('backend.attributes.create');
    }
    


    public function store(Request $request)
    {
        
        
        $attributes = new Attributes();
        $attributes->name = request('name');
        $attributes->code = request('code');
        $attributes->device = request('device');


        $attributes->status = 1;



        $attributes->save();

        $request->session()->flash('success', 'Successfully Created!');
        return redirect(route('backend.attributes.create'));
    }






}
