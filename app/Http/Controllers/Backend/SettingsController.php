<?php

namespace App\Http\Controllers\Backend;
use App\Settings;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $settings = Settings::find(1);
        return view('backend.settings.create',['settings' => $settings]);

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
    public function show($id)
    {
        //
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
        
        $category = Settings::find(1);
        $category->email = request('email');
        $category->phone = request('phone');
        $category->address = request('address');
        $category->currency = request('currency');
                $category->entry_points = request('entry_points');

        $category->points = request('points');
        $category->refpoints = request('refpoints');
        $category->propoints = request('propoints');
        $category->fourpoints = request('fourpoints');
        $category->fivepoints = request('fivepoints');
        $category->sixpoints = request('sixpoints');

        $category->status =1;

        $category->save();

        $request->session()->flash('success', 'Successfully Updated!');
        return redirect(route('backend.settings.create'));
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
