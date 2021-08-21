<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
use App\User;
use App\Role;
use App\Settings;
use App\MSP;
use App\Funds;
use App\Royality;
use App\AdminImages;
use App\UserTree;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Order;
use Carbon\Carbon;
use App\SalesCron;

class AdminController extends Controller
{
    public function index()
    { 
        $role_id= DB::table('roles')->select('id')->where('slug','admin')->first();
        
        $admins = User::latest()->where('role_id',$role_id->id)->orwhere('rid',$role_id->id)->get();
        return view('backend.admin.index', ['admins' => $admins]);


    }

    public function sellerDisplay(){
        $role_id= DB::table('roles')->select('id')->where('slug','seller')->first();
        
        $sellers = User::latest()->where('role_id',$role_id->id)->orwhere('rid',$role_id->id)->get();
        return view('backend.seller.index', ['sellers' => $sellers]);


    }

    public function sellerView($id){
        $seller = User::find($id);
        return view('backend.seller.view', ['seller' => $seller]);


    }

    public function sellerCreate(){
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

        return view('backend.seller.create',[
            
            'seller_id' => $seller_id,
            'zero_fill' => $zero_fill,
        ]);


    }

    public function adminPermission($id)
    {
        $seller = User::find($id);
        $roles = Role::latest()->get();

        

    


        return view('backend.seller.permission', ['seller' => $seller,'roles' => $roles]);
    }

    public function adminUpdate($id)
    {
        $sel = User::find($id);
        
        $sel->rid = request('role');

        $sel->save();

        $role_id= DB::table('roles')->select('id')->where('slug','seller')->first();
        
        $sellers = User::latest()->where('role_id',$role_id->id)->orwhere('rid',$role_id->id)->get();
        return view('backend.seller.index', ['sellers' => $sellers]);

    }

    public function adminView($id){
        $admin = User::find($id);
        return view('backend.admin.view', ['admin' => $admin]);


    }

    public function adminCreate(){
        return view('backend.admin.create');


    }
    public function adminAdd(Request $request){
        $admin = new User();


        if ($request->file('image')) {
            $imagePath = $request->file('image');
            $imageName = $imagePath->getClientOriginalName();
            $path = $request->file('image')->storeAs('uploads/profile', $imageName, 'public');
            $request->image->move(public_path('/uploads/profile'), $imageName);
            $admin->img_name =$imageName;

  
          }
  
          $admin->first_name = $request->input('first_name');
          $admin->last_name =$request->input('last_name');
          $admin->password = Hash::make($request->input('password'));

          $admin->email = $request->input('email');
          $admin->address = $request->input('address');
          $admin->phone = $request->input('phone');
  
          $admin->city = $request->input('city');
          $admin->ref_id = $request->input('ref_id');
        $admin->role_id =$request->input('role_id');
        $admin->save();


    }

    public function adminEdit($id){
        $admin = User::find($id);


        if ($request->file('image')) {
            $imagePath = $request->file('image');
            $imageName = $imagePath->getClientOriginalName();
            $path = $request->file('image')->storeAs('uploads/profile', $imageName, 'public');
            $request->image->move(public_path('/uploads/profile'), $imageName);
            $admin->img_name =$imageName;

  
          }
  
          $admin->first_name = $request->input('first_name');
          $admin->last_name =$request->input('last_name');
          $admin->password = Hash::make($request->input('password'));

          $admin->email = $request->input('email');
          $admin->address = $request->input('address');
          $admin->phone = $request->input('phone');
  
          $admin->city = $request->input('city');
          $admin->ref_id = $request->input('ref_id');
        $admin->role_id =$request->input('role_id');
        $admin->save();


    }

    public function showProfile($id){
        $admins = User::where('seller_id',$id)->first();
        return view('backend.profile.view', ['admins' => $admins]);

    }

    public function updateProfile(Request $request,$id){
        $admin = User::where('seller_id',$id)->first();



        if ($request->file('image')) {
            $imagePath = $request->file('image');
            $imageName = $imagePath->getClientOriginalName();
            $path = $request->file('image')->storeAs('uploads/profile', $imageName, 'public');
            $request->image->move(public_path('/uploads/profile'), $imageName);
            $admin->img_name =$imageName;

  
          }
  
          $admin->first_name = $request->input('first_name');
          $admin->last_name =$request->input('last_name');
          $admin->email = $request->input('email');
          $admin->address = $request->input('address');
          $admin->phone = $request->input('phone');
  
          $admin->city = $request->input('city');
        $admin->save();

       // $request->session()->flash('success', 'Successfully Updated!');

       return redirect()->back()->with('success', 'Successfully Updated!');
    }


    public function teamView($id){
        $seller = User::find($id);
        return view('backend.team.view', ['seller' => $seller]);


    }
    
     public function customerPermissionView($id)
    { 
        $roles= DB::table('roles')->get();
        
        //$admins = User::latest()->where('role_id',$role_id->id)->orwhere('rid',$role_id->id)->get();
        return view('backend.customer.permission', ['id' => $id,'roles'=>$roles]);


    }
    
     public function pcnList(){

        return view('backend.pcn.index');



    }
    
     public function pcnView($id){

        return view('backend.pcn.view',['id'=>$id]);



    }

    public function customerPermission(Request $request,$id)
    { 
        $category = User::find($id);
        $category->ref_id = request('ref_id');
        $category->role_id = request('role');

        $category->save();

        $request->session()->flash('success', 'Successfully Updated!');
        return redirect(route('backend.customer'));

    }

        public function destroyTeam($id)
        {
            User::find($id)->delete();
            return redirect(route('backend.team.index'))->withError('Successfully Deleted!');
        }
        
        public function sellerUpdate(Request $request){
                    $msp = MSP::find(1);
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
         $insert->carry =1;
         $users = User::where('phone',$request->input('phone'))->first();
            $count = User::where('phone',$request->input('phone'))->count();

        if($users)
        { 
            $insert->pcn=$users->seller_id.".".$count;
$insert->pcid=$users->seller_id;

$puid= User::all()->last()->id+1;
$insertorder = new Order();
        $insertorder->order_id = 'ORD-'.strtoupper(uniqid());
        $insertorder->user_id = $puid;
        $insertorder->status = 'pending';
        $insertorder->order_date = Carbon::now();

        $insertorder->total_amount =  150;
        $insertorder->total_item  =1;

        $insertorder->save();



$cat = new SalesCron();


$cat->seller_id = $request->input('seller_id');
  $cat->ref_id = $request->input('ref_id');

$cat->status =1;


$cat->save();
        }
    

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
 






        $did= User::where('role_id',3)->where('wings',$pid->wings)->latest()->first();
        
         $dicount= User::where('role_id',3)->where('wings',$pid->wings)->latest()->count();

         //dd($dicount); 

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

            $insert->track =2;
            
            $usrdepth= User::where('track',1)->latest()->first();
        
            $insert->depth = $usrdepth->depth*2;
        
        }
        elseif($did && $dicount%2==1){
        
        $insert->track =1;
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
            $puser= User::where('role_id',3)->where('seller_id',$request->input('ref_id'))->first();
                $pcount= User::where('role_id',3)->where('wings',$puser->wings)->count();

        if($pcount==0){
          $insert->level =1;
              
        }
        elseif($pcount>=1 && $pcount<=2){
            $insert->level =2;
            
                      
           

        }
        elseif($pcount>=3 && $pcount<=6){
            $insert->level =3;
                   //dd($pidcount);

        }
        elseif($pcount>=7 &&  $pcount<=15){
            $insert->level =4;
          //  dd($pidcount);

        }
        elseif($pcount>=16 && $pcount<=32){
            $insert->level =5;
        }
        elseif($pcount>=62 && $pcount<128){
            $insert->level =7;
        }
        elseif($pcount>=128 || $pcount<256){
            $insert->level =8;
        }
        
        else{
             $insert->level =9;
        }
            
  /*  $parent= User::where('seller_id',$request->input('ref_id'))->first();
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
       
        elseif($pidcount>=2 && $pidcount<=3){
            $insert->level =3;
            
                      
           

        }
        elseif($pidcount>=4 && $pidcount<=12){
            $insert->level =4;
                   //dd($pidcount);

        }
        elseif($pidcount>=13 &&  $pidcount<=29){
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
        }*/

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
                        $lastuser= UserTree::where('wings',$lastwing->wings)->latest()->first();

                $levelcount= UserTree::where('wings',$lastwing->wings)->count();

$userparent= User::where('seller_id',$lastwing->ref_id)->first();
$parent= UserTree::where('seller_id',$lastwing->ref_id)->where('wings',$lastwing->wings)->latest()->first();
    $lastparent= UserTree::where('level',$lastwing->level)->where('ref_id',$lastwing->ref_id)->where('wings',$lastwing->wings)->count();
        if($levelcount==0){
          $usrtree->level =1;
              
        }
        elseif($levelcount>=1 && $levelcount<=2){
            $usrtree->level =2;
            
                      
           

        }
        elseif($lastuser->depth==2){
            $usrtree->level =2;
                   //dd($pidcount);

        }
        elseif($lastuser->depth==3 ){
            $usrtree->level =3;
                   //dd($pidcount);

        }
        elseif($lastuser->depth==4){
        $usrtree->level =3;
          //  dd($pidcount);

        }
         elseif($lastuser->depth==5 && $parent->depth==2 ){
        $usrtree->level =4;
          //  dd($pidcount);

        }
        elseif($lastuser->depth==5 && $parent->depth==3 ){
        $usrtree->level =3;
          //  dd($pidcount);

        }
        elseif($lastuser->depth==8){
        $usrtree->level =4;
          //  dd($pidcount);

        }
        elseif($lastuser->depth==9 && $request->input('ref_id')==$lastuser->ref_id ){
        $usrtree->level =4;
          //  dd($pidcount);

        }
         elseif($lastuser->depth==10){
        $usrtree->level =4;
          //  dd($pidcount);

        }
        elseif($lastuser->depth==11){
        $usrtree->level =4;
          //  dd($pidcount);

        }
        elseif($lastuser->depth==11 && $request->input('ref_id')==$lastuser->ref_id ){
        $usrtree->level =5;
          //  dd($pidcount);

        }
         elseif($lastuser->depth==12){
        $usrtree->level =4;
          //  dd($pidcount);

        }
        elseif($lastuser->depth==13){
        $usrtree->level =4;
          //  dd($pidcount);

        }
        elseif($lastuser->depth==14){
        $usrtree->level =4;
          //  dd($pidcount);

        }
        elseif($lastuser->depth==15){
        $usrtree->level =4;
          //  dd($pidcount);

        }
        else{
            
        }
        
//dd($dicount);
//dd($lastparent);
if($lastwing->wings=='left' && $lastwing->level==1 && $dicount==0){
    $usrtree->depth=1;
         
}


elseif($lastwing->wings=='right' && $lastwing->level==1 && $dicount==1){
    $usrtree->depth=1;
         
}
/*elseif($lastparent==null){
    $usrtree->depth=$parent->depth*2;
    
   

}*/

/*elseif($lastparent==1){
    $usrtree->depth=($parent->depth*2)+1;

}
*/
elseif($request->input('ref_id')!=2000){
    $n=$parent->depth;
    $child1=UserTree::where('depth',2*$n)->latest()->first();
        $child2=UserTree::where('depth',(2*$n)+1)->latest()->first();
        $lastu= User::where('wings',$userparent->wings)->skip(1)->take(1)->latest()->first();
                                                $lastuid= UserTree::where('seller_id',$lastu->seller_id)->latest()->first();
                                       
  if(!$child1){
       $usrtree->depth=$n*2;  
  }
    elseif($child1 && !$child2){
        $usrtree->depth=$child1->depth+1;
        
    }
    elseif($child1 && $child2 && $lastuid->ref_id==$request->input('ref_id')){
        if($lastwing->track==1 && $lastuser->depth==((2*$n)+1)){
            $usrtree->depth=$child1->depth*2; 
         
        }
        elseif($lastwing->track==1 && $lastuser->depth==11){
            $usrtree->depth=16; 
         
        }
        elseif($lastwing->track==1 && $lastuser->depth==23){
            $usrtree->depth=32; 
         
        }
        else{
            $usrtree->depth=($lastuid->depth)+1;
            
        }
     
    }
       elseif($child1 && $child2 && $lastuid->ref_id!=$request->input('ref_id')){
        if($lastwing->track==1 && $lastuser->depth==((2*$n)+1)){
            $usrtree->depth=$child2->depth*2; 
         
        }
        elseif($lastwing->track==1 && $lastuser->depth==15){
            $usrtree->depth=16; 
         
        }
        elseif($lastwing->track==1 && $lastuser->depth==32){
            $usrtree->depth=32; 
         
        }
        else{
            $usrtree->depth=($lastuid->depth)+1;
            
        }
     
    }
      
   
    else{
       
               $usrtree->depth=($lastuid->depth)+1;
  
     /*  if($lastu->track==2){
     $usrtree->depth=$child1->depth*2; 
        }
     elseif($lastu->track==1){
         $usrtree->depth=($lastuid->depth)+1;
         
     }
                                                else{
                                            $luser= User::where('track',1)->where('wings',$userparent->wings)->where('level',$userparent->level)->first();
$luid= UserTree::where('seller_id',$luser->seller_id)->latest()->first();
                                   
                                                 $usrtree->depth=($luid->depth*2);   
  
                                                }*/
    
        }
       
                                              /*  if($lastu->track==2)
                                                {
                                                    if($lastwing->track==1){
                                            $luser= User::where('track',1)->where('wings',$userparent->wings)->latest()->skip(1)->take(1)->first();
 $luid= UserTree::where('seller_id',$luser->seller_id)->latest()->first();
                                   
                                                 $usrtree->depth=($luid->depth*2);
                                                    }
                                                    else{
                                                                                                        $luser= User::where('track',1)->where('wings',$userparent->wings)->latest()->first();
$luid= UserTree::where('seller_id',$luser->seller_id)->latest()->first();
                                   
                                                 $usrtree->depth=($luid->depth)+1;
                                                    }
                                                   
                                                }
                                                else*/
                                                
                                              /*  elseif($lastu->track==2 &&  $lastu->level==$userparent->level+2){
                                                    
                                                    $usrtree->depth=($lastuid->depth)+1;
                                                }
                                                elseif($lastu->track==1 && $lastu->level==$userparent->level+2){
                                                    
                                                    $usrtree->depth=($lastuid->depth)+1;
                                                }*/
                                                

    

}

else{
 /*   $last= UserTree::where('ref_id',$lastwing->ref_id)->where('wings',$lastwing->wings)->latest()->first();
   // dd($last);
    $lastcount= UserTree::where('ref_id',$lastwing->ref_id)->where('level',$lastwing->level)->where('wings',$lastwing->wings)->count();

    if($last==null){
        if($lastwing->track==1){
$lastu= User::where('track',1)->where('wings',$lastwing->wings)->latest()->skip(2)->take(1)->first();
                                                $lastuid= UserTree::where('seller_id',$lastu->seller_id)->first();

            $usrtree->depth=($lastuid->depth)*2;

        }
        elseif($lastwing->track==2){
$lastu= User::where('track',2)->where('wings',$lastwing->wings)->latest()->skip(2)->take(1)->first();
                                                $lastuid= UserTree::where('seller_id',$lastu->seller_id)->latest()->first();

            $usrtree->depth=(($lastuid->depth)*2)+1;
    
        }


    }
   elseif($lastwing->level==$last->level  && $lastwing->ref_id==2000){
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
                    $usrtree->depth=(($lasty->depth))+1;
                     //dd($lasty);

    }
    else{
        if($lastwing->track==1){
                        $lastu= User::where('track',1)->where('wings',$lastwing->wings)->latest()->first();
                                                $lastuid= UserTree::where('seller_id',$lastu->seller_id)->latest()->first();

            $usrtree->depth=($lastuid->depth)*2;
    
        }
        elseif($lastwing->track==2){
            $lastu= User::where('track',2)->where('wings',$lastwing->wings)->latest()->first();
           
                                                $lastuid= UserTree::where('seller_id',$lastu->seller_id)->latest()->first();

            $usrtree->depth=(($lastuid->depth)*2)+1;
    
        }

    }*/
    
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
         
        
             $fundprice=$funds->royality+$funds->reward+$funds->charity+$funds->dealership+$funds->profit;
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
            return redirect(route('backend.seller.create'))->withSuccess('Successfully Created!');

        }
    

}
