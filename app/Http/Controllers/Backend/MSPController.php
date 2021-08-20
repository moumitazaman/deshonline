<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\MSP;
use App\User;

class MSPController extends Controller
{
    public function create()
    {
        $settings = MSP::find(1);
        return view('backend.msp.create',['settings' => $settings]);

    }


    public function update(Request $request, $id)
    {
        
        $category = MSP::find(1);
        $category->A = request('apoint');
        $category->B = request('bpoint');
        $category->C= request('cpoint');
        $category->D = request('dpoint');
        $category->E= request('epoint');

        
        


        $category->save();

        $request->session()->flash('success', 'Successfully Updated!');
        return redirect(route('backend.msp.create'));
    }
    
    
    
    public function applyMSP(){

        

        $uid= User::where('seller_id',auth()->user()->seller_id)->first();
        if($uid->matches<3)
        {
        
$uid->grade='A';            
           
            
        }
       
        if($uid->matches>=3 && $uid->matches<10)
{

    $uid->grade='B';            
    
   
    
}
if($uid->matches>=10 && $uid->matches<30)
{
    $uid->grade='C';            

}
if($uid->matches>=30 && $uid->matches<60)
{
    $uid->grade='D';            

}

if($uid->matches>=60 && $uid->matches<150)
{
    $uid->grade='E';  
    $uid->points=$uid->points-50;

$uid->save();


}

if($uid->matches>=150 && $uid->matches<320)
{

    $uid->grade='M';            

}

if($uid->matches>=320 && $uid->matches<410)
{
    $uid->grade='ASM';            

}

if($uid->matches==129)
{
    $uid->grade='SM';            

}

if($uid->matches==103)
{
    $uid->grade='GM';            

}

$uid->points=$uid->points-50;

$uid->save();

return view('backend.dashboard');




    }
}
