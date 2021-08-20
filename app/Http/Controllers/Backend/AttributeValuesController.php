<?php

namespace App\Http\Controllers\Backend;
use App\Attributes;

use App\AttributesValue;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AttributeValuesController extends Controller
{
    public function index()
    {
        $attrvalues = AttributesValue::latest()->get();
        
        return view('backend.attributesvalues.index', ['attrvalues' => $attrvalues]);
    }

    public function create()
    {
        $attrvalues = Attributes::latest()->get();

        return view('backend.attributesvalues.create', ['attrvalues' => $attrvalues]);
    }
   
    


    public function store(Request $request)
    {
        
        
        $attributes = new AttributesValue();
        $attributes->values = request('values');
        $attributes->device = request('device');

        $attributes->attr_id = request('attr_id');



        $attributes->save();

        $request->session()->flash('success', 'Successfully Created!');
        return redirect(route('backend.attributesvalues.create'));
    }
}
