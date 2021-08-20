<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Redirect;
use Auth;

use App\Providers\RouteServiceProvider;
use App\User;
use App\Admin;
use App\Settings;
use App\MSP;
use App\UserTree;

use App\Funds;
use App\Royality;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;


class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function showRegisterForm()
    {
        $role_id= DB::table('roles')->select('id')->where('slug','seller')->first();

        $seller =  User::get();
      

        if(count($seller) > 0){
            $id = User::latest()->get()->first();
            $seller_id =$id->seller_id+1;
        }
        else{
            $seller_id = 2000;
        }
        $seller_id_length = strlen((string)$seller_id);
        $zero_fill = (int)$seller_id_length + 1;

        return view('register',[
            
            'seller_id' => $seller_id,
            'zero_fill' => $zero_fill,
        ]);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
           // 'phone' => ['required','max:11', 'unique:admins'],

            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }


    protected function create(Request $request)
    {

        request()->validate([
            
            'phone' => 'required|min:11',
           
        ]);
        $msp = MSP::find(1);
        $users = User::where('phone',$request->input('phone'))->first();
        if($users)
        {
            $request->session()->flash('success', 'Duplicate Entry.Mobile Number Already Exist');

            return redirect()->back(); 

        }
        else{

            $entry=  Settings::where('id',1)->first();
            $entry_points=$entry->entry_points;
        $insert = new User();
        $insert->seller_id = $request->input('seller_id');

        $insert->first_name = $request->input('first_name');
        $insert->last_name =$request->input('last_name');
        $insert->email = $request->input('email');
        $insert->password = Hash::make($request->input('password'));
        $insert->address = $request->input('address');
        $insert->phone = $request->input('phone');

        $insert->city = $request->input('city');
        $insert->carry =1;
        //$insert->points = $msp->A;
        //$insert->grade="A";


       
        $pid= User::where('role_id',3)->where('seller_id',$request->input('ref_id'))->first();
        $usr= User::where('role_id',3)->where('ref_id',2000)->count();
        if($request->input('ref_id')==2000){
            $pi= User::where('role_id',3)->where('ref_id',$request->input('ref_id'))->count();
            $pidcount= $pi-2;

        }
else{
    $pidcount= User::where('role_id',3)->where('ref_id',$request->input('ref_id'))->count();

}
        
 //dd($pidcount);

        
                $vl=User::where('role_id',3)->where('level',2)->count();
                $vl2=User::where('role_id',3)->where('level',3)->count();
                $vl3=User::where('role_id',3)->where('level',4)->count();
    //   dd($vl2);         
       
         if(!$pid){
            $insert->wings = "left";
            

        }
        else if($pid->wings=="left"){
            $insert->wings = "left";


        }
        else{
            $insert->wings = "right";
        }

        $usrlevel= User::where('role_id',3)->where('ref_id',$request->input('ref_id'))->count();
 






        $did= User::where('role_id',3)->where('ref_id',$request->input('ref_id'))->latest()->first();
        $dicount= User::where('role_id',3)->where('ref_id',$request->input('ref_id'))->count();

        // dd($dicount); 

        if(!$did){
            if($request->input('ref_id')==2000){
                $adm= User::where('role_id',1)->where('seller_id',2000)->first();
            $insert->depth = $adm->depth*2;


            }
            else{
                $mem= User::where('role_id',3)->where('seller_id',$request->input('ref_id'))->first();
            $insert->depth = $mem->depth*2;
           

            }
            
            $insert->track = 1;


        }
        elseif($did && $dicount%2==0){

            $insert->track =1;
            
            $usrdepth= User::where('track',1)->latest()->first();
        
            $insert->depth = $usrdepth->depth*2;
        
        }
        elseif($did && $dicount%2==1){
        
        $insert->track =2;
        $usrdepth2= User::where('track',1)->latest()->first();
        
        $insert->depth =($usrdepth2->depth)+1;
        
        
        }
        
        
      



      /*  elseif($vl2==0){
            $usrdepth= User::where('track',1)->where('level',2)->latest()->first();
                        $insert->track =1;
                        $insert->depth = $usrdepth->depth*2;

        }
        elseif($vl2%2==0){
            $usrdepth1= User::where('track',1)->where('level',2)->latest()->first();
            $insert->track =1;
            $insert->depth = $usrdepth1->depth*2;
            


        }
        elseif($vl2%2==1){
            $usrdepth2= User::where('track',1)->where('level',2)->latest()->first();

            $insert->track =2;
            $insert->depth =($usrdepth2->depth*2)+1;

        }
        elseif($vl3==0){
            $usrdepth= User::where('track',1)->where('level',3)->latest()->first();
                        $insert->track =1;
                        $insert->depth = $usrdepth->depth*2;
            

        }
        elseif($vl3%2==0){
            $usrdepth3= User::where('track',1)->where('level',3)->latest()->first();

            $insert->track =1;
            $insert->depth = $usrdepth3->depth*2;


        }
        elseif($vl3%2==1){
            $usrdepth4= User::where('track',1)->where('level',3)->latest()->first();

            $insert->track =2;
            $insert->depth = ($usrdepth4->depth*2)+1;

        }*/
        else{
            $insert->track = 1;
        }
        $insert->ref_id = $request->input('ref_id');
        $insert->role_id =$request->input('role_id');
        

        if($pidcount<=1){
            
    $parent= User::where('seller_id',$request->input('ref_id'))->first();
    $pit= User::where('role_id',3)->where('ref_id',$parent->ref_id)->count();

    if($parent->ref_id==2000)
    {
       $pit=$pit-2;
    }
    else{
        $pit=$pit;
    }
    
//dd($pit);
    if($pit==-2 || $pit==-1 || $pit==0 || $pit==1){
        $insert->level =2;
    }
    elseif($pit>=2 && $pit<=5){
        $insert->level =3;
    }
    elseif($pit>=6 && $pit<=13){
        $insert->level =4;
    }
    elseif($pit>=14 &&  $pit<=29){
        $insert->level =5;
    }
    elseif($pit>=30 && $pit<61){
        $insert->level =6;
    }
        else{
            $insert->level =7;
        }

            
        }
       
        elseif($pidcount>=2 && $pidcount<=5){
            $insert->level =3;
            
                      
           

        }
        elseif($pidcount>=6 && $pidcount<=13){
            $insert->level =4;
                   //dd($pidcount);

        }
        elseif($pidcount>=14 &&  $pidcount<=29){
            $insert->level =5;
          //  dd($pidcount);

        }
        elseif($pidcount>=30 && $pidcount<=61){
            $insert->level =6;
        }
        elseif($pidcount>=62 && $pidcount<128){
            $insert->level =7;
        }
        elseif($pidcount>=128 || $pidcount<256){
            $insert->level =8;
        }
        
        else{
             $insert->level =9;
        }

        if($usr==0 && ($request->input('ref_id')==2000)){
            $insert->wings = "left";
            $insert->level = 1;
            $insert->track = 1;



        }
        if($usr==1 && ($request->input('ref_id')==2000)){
            $insert->wings = "right";
            $insert->level = 1;
            $insert->track = 2;



        }
        
         
        if($request->input('ref_id')==2000 && $vl==2){
            $insert->wings = "right";
            $insert->track = 1;

        }

        if($request->input('ref_id')==2000 && $vl==3){
            $insert->wings = "right";
            $insert->track = 2;
            $insert->level = 2;


        }
       
       
        $insert->status =1;

        $insert->save();

        $lastwing= User::latest()->first();
        
$usrtree= new UserTree();
$usrtree->seller_id=$lastwing->seller_id;
$usrtree->ref_id=$lastwing->ref_id;
$usrtree->wings=$lastwing->wings;
$usrtree->level=$lastwing->level;
//dd($dicount);
$parent= UserTree::where('seller_id',$lastwing->ref_id)->where('wings',$lastwing->wings)->latest()->first();
    $lastparent= UserTree::where('level',$lastwing->level)->where('ref_id',$lastwing->ref_id)->where('wings',$lastwing->wings)->count();
//dd($lastparent);
if($lastwing->wings=='left' && $lastwing->level==1 && $dicount==0){
    $usrtree->depth=1;
         
}


elseif($lastwing->wings=='right' && $lastwing->level==1 && $dicount==1){
    $usrtree->depth=1;
         
}
elseif($lastparent==null){
    $usrtree->depth=$parent->depth*2;

}
/*elseif($lastparent==1){
    $usrtree->depth=($parent->depth*2)+1;

}
*/

else{
    $last= UserTree::where('ref_id',$lastwing->ref_id)->where('level',$lastwing->level)->where('wings',$lastwing->wings)->latest()->first();
   // dd($last);
    $lastcount= UserTree::where('ref_id',$lastwing->ref_id)->where('level',$lastwing->level)->where('wings',$lastwing->wings)->count();

    if($last==null){
        if($lastwing->track==1){
            $lst= UserTree::where('level',$lastwing->level-1)->where('wings',$lastwing->wings)->first();

            $usrtree->depth=($lst->depth)*2;
    
        }
        elseif($lastwing->track==2){
            $lst= UserTree::where('level',$lastwing->level-1)->where('wings',$lastwing->wings)->latest()->first();

            $usrtree->depth=(($lst->depth)*2)+1;
    
        }


    }
   elseif($lastwing->level==$last->level && $lastwing->ref_id==2000){
        if($lastwing->track==1 && $lastcount==0){
            $usrtree->depth=($last->depth)*2;
    
        }
        
        else{
            $usrtree->depth=(($last->depth))+1;
    
        }

    }
     elseif($lastcount%2==0){
            $lasty= UserTree::where('ref_id',$lastwing->ref_id)->where('wings',$lastwing->wings)->first();
                    $usrtree->depth=($lasty->depth)*2;

    }
    elseif($lastcount%2==1){
            $lasty= UserTree::where('ref_id',$lastwing->ref_id)->where('wings',$lastwing->wings)->first();
                    $usrtree->depth=(($lasty->depth)*2)+1;

    }
    else{
        if($lastwing->track==1){
            $usrtree->depth=($last->depth)*2;
    
        }
        elseif($lastwing->track==2){
            $usrtree->depth=(($last->depth)*2)+1;
    
        }

    }
    
}
    
   
$usrtree->save();

        
          $msp = MSP::find(1);
            $msp->dbA+=$msp->A;
            $msp->dbB+=$msp->B;
            $msp->dbC+=$msp->C;
            $msp->dbD+=$msp->D;
            $msp->dbE+=$msp->E;
            $msp->save();
             $funds=Funds::where('id',1)->first();
            $funds->dbroyality+=$funds->royality;
            $funds->dbreward+=$funds->reward;
            $funds->dbcharity+=$funds->charity;
            $funds->dbmatching+=$funds->matching;
            $funds->dbdealership+=$funds->dealership;
            $funds->dbprofit+=$funds->profit;
        $funds->save();
        
        $royality = Royality::find(1);
            $royality->dbM+=$royality->M;
            $royality->dbAM+=$royality->AM;
            $royality->dbSM+=$royality->SM;
            $royality->dbGM+=$royality->GM;
            $royality->dbBA+=$royality->BA;
            $royality->total+=$royality->M+$royality->AM+$royality->SM+$royality->GM+$royality->BA;
            $royality->save();
        
             $fundprice=$funds->dbroyality+$funds->dbreward+$funds->dbcharity+$funds->dbdealership+$funds->dbprofit;
$admins=User::where('seller_id',2000)->first();
$admins->points+=$fundprice;
$admins->save();


        $sid=$request->input('seller_id');
        $rid=$request->input('ref_id');
$refers=User::where('seller_id',$rid)->first(); 
$refers->points+=$funds->referrence;
$refers->save();
        
                $user=User::where('seller_id',$sid)->first(); 
         
       
        $settings=Settings::where('id',1)->first();

       $sellers = User::where('role_id',3)->where('id','<',$user->id)->where('wings',$user->wings)->where('track',$user->track)->limit(5)->latest()->get();
       $sellercount = User::where('role_id',3)->where('id','<',$user->id)->where('wings',$user->wings)->where('track',$user->track)->count();
foreach($sellers as $seller){
    if($seller->level==1){
        $seller->points+=$settings->points;
        $seller->save();
    }
    elseif($seller->level==2){
         $seller->points+=$settings->propoints;
         $seller->save();
    }
    elseif($seller->level==3){
         $seller->points+=$settings->fourpoints;
         $seller->save();
    }
     elseif($seller->level==4){
         $seller->points+=$settings->fivepoints;
         $seller->save();
    }
    elseif($seller->level==5){
         $seller->points+=$settings->sixpoints;
         $seller->save();
    }
    else{}
    
}
       


       /* $refers = User::where('seller_id',$rid)->first();

        $toprefers = User::where('seller_id',$refers->ref_id)->first();

        if(!$toprefers){
            $toprefers = User::where('ref_id',0)->first();

        }
       
        elseif($toprefers->ref_id){
            $fourrefers = User::where('seller_id',$toprefers->ref_id)->first();

        }
        elseif($toprefers->ref_id && $fourrefers->ref_id){
            $fourrefers = User::where('seller_id',$toprefers->ref_id)->first();

            $fiverefers = User::where('seller_id',$fourrefers->ref_id)->first();

        }
        elseif($toprefers->ref_id && $fourrefers->ref_id && $fiverefers->ref_id){
            $fourrefers = User::where('seller_id',$toprefers->ref_id)->first();

            $fiverefers = User::where('seller_id',$fourrefers->ref_id)->first();
            $sixrefers = User::where('seller_id',$fiverefers->ref_id)->first();



        }
        else{

        }
      
       


if($rid==0){
    

}
        
elseif($refers->ref_id==0){
    
   
    $refers = User::where('seller_id',$rid)->first();
    $refers->points+=$settings->points;

    $refers->save();


}
elseif($toprefers->ref_id==0){
    

    $refers = User::where('seller_id',$rid)->first();
    $refers->points+=$settings->refpoints;
    $refers->save();

    $toprefers = User::where('seller_id',$refers->ref_id)->first();
    if(!$toprefers){
        $toprefers = User::where('ref_id',0)->first();

    }
   else{
    $toprefers->points+=$settings->points;
    $toprefers->save();
   }

}
elseif($fourrefers->ref_id==0){
    

    $refers = User::where('seller_id',$rid)->first();
    $refers->points+=$settings->propoints;
    $refers->save();

    $toprefers = User::where('seller_id',$refers->ref_id)->first();
    if(!$toprefers){
        $toprefers = User::where('ref_id',0)->first();

    }
   else{
    $toprefers->points+=$settings->refpoints;
    $toprefers->save();
   }
    $toptoprefers = User::where('seller_id',$toprefers->ref_id)->first();
    if(!$toptoprefers){
        $toptoprefers = User::where('ref_id',0)->first();

    }
   else{
    $toptoprefers->points+=$settings->points;
    $toptoprefers->save();
   }

}
elseif($fiverefers->ref_id==0){
   

    $refers = User::where('seller_id',$rid)->first();
    $refers->points+=$settings->fourpoints;
    $refers->save();

    $toprefers = User::where('seller_id',$refers->ref_id)->first();
    $toprefers->points+=$settings->propoints;
    $toprefers->save();

    $toptoprefers = User::where('seller_id',$toprefers->ref_id)->first();
    $toptoprefers->points+=$settings->refpoints;
    $toptoprefers->save();

    $level1refers = User::where('seller_id',$toptoprefers->ref_id)->first();
    $level1refers->points+=$settings->points;
    $level1refers->save();

}
elseif($sixrefers->ref_id==0){
  

    $refers = User::where('seller_id',$rid)->first();
    $refers->points+=$settings->fivepoints;
    $refers->save();

    $toprefers = User::where('seller_id',$refers->ref_id)->first();
    $toprefers->points+=$settings->fourpoints;
    $toprefers->save();

    $toptoprefers = User::where('seller_id',$toprefers->ref_id)->first();
    $toptoprefers->points+=$settings->propoints;
    $toptoprefers->save();
    $level2refers = User::where('seller_id',$toptoprefers->ref_id)->first();
    $level2refers->points+=$settings->refpoints;
    $level2refers->save();

    $level1refers = User::where('seller_id',$level2refers->ref_id)->first();
    $level1refers->points+=$settings->points;
    $level1refers->save();

}
else{
   

        

        

       
}*/

        if (Auth::check()){
            return redirect()->back();

        }
        else{
            return redirect(route('login'));

        }
       
       


        


        }
          


        
    }

}
