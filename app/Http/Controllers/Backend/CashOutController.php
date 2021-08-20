<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CashOut;
use App\User;

class CashOutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('backend.cashout.create');
    

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.cashout.update');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $total= request('total');
        $amount=request('amount');
        $seller=request('seller_id');
if($total>$amount){



        $percent=request('amount')*0.1;
        $percentage=$total-$amount-$percent;
       $net=$total-$amount-$percent;
 
        $points=$net/10;

$user= User::where('seller_id',$seller)->first();
$user->points=$points;
$user->save();

        $admin= User::where('seller_id',2000)->first();
$admin->points+=$percent;
$admin->save();

        $cashout = new CashOut();
        $cashout->amount = $amount;
        $cashout->total = $percentage;
        $cashout->net=$total;
        $cashout->seller_id=request('seller_id');

        $cashout->save();

        $request->session()->flash('success', 'Successfull!');
        return view('backend.cashout.update',['net' => $percentage,'percentage'=>$amount]);
}
else{
        return redirect()->back()->with('success', 'Sorry Cashout Amount is Bigger than Total Amount!');
}
    
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
    
    public function cashView()
    {
                return view('backend.cashout.index');

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
}
