<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

use Auth;

use App\Sales;
use App\User;
use App\SalesCron;
use App\ProductDetail;
use App\Product;
use App\MSP;

use App\AdminSalesCron;




class TaskDaily extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $currentdate=date('Y-m-d H:i:s');

        $users=SalesCron::get()->unique('seller_id');
        
        $length=sizeof($users);
        $count=0;
        $i=0;
        $j=0;
        $k=0;
        $l=0;
        $m=0;
        $n=0;
        $o=0;
        $p=0;
        $q=0;
        $r=0;
        $items = array();
        $items1 = array();
        $items2 = array();
        $items3 = array();
        $items4 = array();
        $items5 = array();
        $items6 = array();
        $items7 = array();
        $items8 = array();
        $items9 = array();
        $items10 = array();

        foreach($users as $user){
            
          $account=User::where('seller_id',$user->seller_id)->first();
        
          if($user->level==1){
           $count++;
         $items[$count]=$user->seller_id;
           
         
        
          }
          if($user->level==2){
            $i++;
          $items1[$i]=$user->seller_id;
            
          
         
           }
           if($user->level==3){
            $j++;
          $items2[$j]=$user->seller_id;
            
          
         
           }
           if($user->level==4){
            $k++;
          $items3[$k]=$user->seller_id;
            
          
         
           }

           if($user->level==5){
            $l++;
          $items4[$l]=$user->seller_id;
            
          
         
           }
           if($user->level==6){
            $m++;
          $items5[$m]=$user->seller_id;
            
          
         
           }
           if($user->level==7){
            $n++;
          $items6[$n]=$user->seller_id;
            
          
         
           }
           if($user->level==8){
            $o++;
          $items7[$o]=$user->seller_id;
            
          
         
           }
           if($user->level==9){
            $p++;
          $items8[$p]=$user->seller_id;
            
          
         
           }


           if($user->level==10){
            $q++;
          $items9[$q]=$user->seller_id;
            
          
         
           }
           if($user->level==11){
            $r++;
          $items10[$r]=$user->seller_id;
            
          
         
           }
         
         
         
        }
        
       if($items){
        $num=sizeof($items);
        if($num==1){
            $items[2]=0;
        }
    
          if($items[1]){
            $left=User::where('seller_id',$items[1])->first();

          $sellerOne=SalesCron::latest()->where('seller_id',$items[1])->count();
            $sellerOnematch=User::latest()->where('seller_id',$items[1])->first();
          }
          else{
            $sellerOne=0;
          }
          if($items[2]){
            $right=User::where('seller_id',$items[2])->first();

            $sellerTwo=SalesCron::latest()->where('seller_id',$items[2])->count();

   $sellerTwomatch=User::latest()->where('seller_id',$items[2])->first();
          }
          else{
            $sellerTwo=0;

          }

   
        
        
   if($sellerOne==0 || $sellerTwo==0){
         
}
else{
if($sellerOne>$sellerTwo)
{


 $len=$sellerOne-$sellerTwo;

 $onecarry=$len*150;

if($len)

 {   for($i=1;$i<=$len;$i++){
        $matsels=DB::table('product_scron')->where('seller_id',$left->seller_id)->take($len)->get();
        foreach($matsels as $matsel)
       { 
    $mats=SalesCron::latest()->where('id',$matsel->id)->where('seller_id',$matsel->seller_id)->first();

        $mats->status=0;
$mats->save();
       }
    }
}

$sellerOnematch->matches+=1;
if($onecarry>1800){
    $sellerOnematch->carry=$onecarry-200;
    $admins=User::where('seller_id',2000)->first();
$admins->carry+=200;
$admins->save();
}
else{
    $sellerOnematch->carry=$onecarry;
  
}

$sellerOnematch->status=1;

$sellerOnematch->save();

$sellerTwomatch->matches+=1;
$sellerTwomatch->status=1;

$sellerTwomatch->save(); 
$sell=User::latest()->where('seller_id',$items[1])->first();

        $sellers = User::where('role_id',3)->where('id','<=',$sell->id)->where('wings',$sell->wings)->where('track',$sell->track)->limit(8)->latest()->get();
        foreach($sellers as $seller){
              $seller->points+=7.5;
              $seller->save();
          }
}


elseif($sellerOne<$sellerTwo)
{


 $lenw=$sellerTwo-$sellerOne;
 $twocarry=$lenw*150;


if($lenw)

 {   for($i=1;$i<=$lenw;$i++){
        $matsels=DB::table('product_scron')->where('seller_id',$right->seller_id)->take($lenw)->get();
        foreach($matsels as $matsel)
       { 
    $mats=SalesCron::latest()->where('id',$matsel->id)->where('seller_id',$matsel->seller_id)->first();

        $mats->status=0;
$mats->save();
       }
    }
}
$sellerOnematch->matches+=1;
$sellerOnematch->status=1;

$sellerOnematch->save();

$sellerTwomatch->matches+=1;
if($twocarry>1800){
    $sellerTwomatch->carry=1800;
    $admins=User::where('seller_id',2000)->first();
$admins->carry+=$twocarry-1800;

$admins->save();
}
else{
    $sellerTwomatch->carry=$twocarry;
  
}

$sellerTwomatch->status=1;

$sellerTwomatch->save(); 
$sell=User::latest()->where('seller_id',$items[1])->first();

        $sellers = User::where('role_id',3)->where('id','<=',$sell->id)->where('wings',$sell->wings)->where('track',$sell->track)->limit(8)->latest()->get();
        foreach($sellers as $seller){
              $seller->points+=7.5;
              $seller->save();
          }
}

$statusone=SalesCron::latest()->where('status',1)->where('seller_id',$user->seller_id)->count();




$statuszero=SalesCron::latest()->where('status',0)->get();

foreach($statuszero as $stz){
$cat=new AdminSalesCron();
$cat->product_id = $stz->product_id;

$cat->customer_name = $stz->customer_name;

$cat->phone = $stz->phone;
$cat->seller_id = $stz->seller_id;
$cat->ref_id = $stz->ref_id;


$cat->save();

$pid=explode(".",$stz->product_id);
$product_detail=new ProductDetail();
$product_detail->product_id = $stz->product_id;

$product_detail->pid= $pid[0];
$product_detail->status=1;



$product_detail->save();

$product=Product::where('product_id',$pid[0])->first();
if($product->quantity < $product->stock_quantity){
    $product->quantity+=1;

    $product->save();

}





}

//$del=SalesCron::all();
//$del->each->delete();

}
 
       }

   
       if($items1){
        $num=sizeof($items1);
        if($num==1){
            $items1[2]=0;
        }
    
      if($items1[1]){
        $left=User::where('seller_id',$items1[1])->first();

        $sellerOne=SalesCron::latest()->where('seller_id',$items1[1])->count();
          $sellerOnematch=User::latest()->where('seller_id',$items1[1])->first();
        }
        else{
          $sellerOne=0;
        }
        if($items1[2]){
            $right=User::where('seller_id',$items1[2])->first();

          $sellerTwo=SalesCron::latest()->where('seller_id',$items1[2])->count();

 $sellerTwomatch=User::latest()->where('seller_id',$items1[2])->first();
        }
        else{
          $sellerTwo=0;

        }


    
    
if($sellerOne==0 || $sellerTwo==0){
     
}
else{
if($sellerOne>$sellerTwo)
{


$len=$sellerOne-$sellerTwo;

$onecarry=$len*150;

if($len)

{   for($i=1;$i<=$len;$i++){
    $matsels=DB::table('product_scron')->where('seller_id',$left->seller_id)->take($len)->get();
    foreach($matsels as $matsel)
   { 
$mats=SalesCron::latest()->where('id',$matsel->id)->where('seller_id',$matsel->seller_id)->first();

    $mats->status=0;
$mats->save();
   }
}
}

$sellerOnematch->matches+=1;
if($onecarry>1800){
$sellerOnematch->carry=1800;
$admins=User::where('seller_id',2000)->first();
$admins->carry+=$onecarry-1800;
$admins->save();
}
else{
$sellerOnematch->carry=$onecarry;

}

$sellerOnematch->status=1;

$sellerOnematch->save();

$sellerTwomatch->matches+=1;
$sellerTwomatch->status=1;

$sellerTwomatch->save(); 
$sell=User::latest()->where('seller_id',$items1[1])->first();

        $sellers = User::where('role_id',3)->where('id','<=',$sell->id)->where('wings',$sell->wings)->where('track',$sell->track)->limit(8)->latest()->get();
        foreach($sellers as $seller){
              $seller->points+=7.5;
              $seller->save();
          }
}


elseif($sellerOne<$sellerTwo)
{


$lenw=$sellerTwo-$sellerOne;
$twocarry=$lenw*150;


if($lenw)

{   for($i=1;$i<=$lenw;$i++){
    $matsels=DB::table('product_scron')->where('seller_id',$right->seller_id)->take($lenw)->get();
    foreach($matsels as $matsel)
   { 
$mats=SalesCron::latest()->where('id',$matsel->id)->where('seller_id',$matsel->seller_id)->first();

    $mats->status=0;
$mats->save();
   }
}
}
$sellerOnematch->matches+=1;
$sellerOnematch->status=1;

$sellerOnematch->save();

$sellerTwomatch->matches+=1;
if($twocarry>1800){
$sellerTwomatch->carry=1800;
$admins=User::where('seller_id',2000)->first();
$admins->carry+=$twocarry-1800;
$admins->save();
}
else{
$sellerTwomatch->carry=$twocarry;

}

$sellerTwomatch->status=1;

$sellerTwomatch->save(); 
$sell=User::latest()->where('seller_id',$items1[1])->first();

        $sellers = User::where('role_id',3)->where('id','<=',$sell->id)->where('wings',$sell->wings)->where('track',$sell->track)->limit(8)->latest()->get();
        foreach($sellers as $seller){
              $seller->points+=7.5;
              $seller->save();
          }
}

$statusone=SalesCron::latest()->where('status',1)->where('seller_id',$user->seller_id)->count();




$statuszero=SalesCron::latest()->where('status',0)->get();

foreach($statuszero as $stz){
$cat=new AdminSalesCron();
$cat->product_id = $stz->product_id;

$cat->customer_name = $stz->customer_name;

$cat->phone = $stz->phone;
$cat->seller_id = $stz->seller_id;
$cat->ref_id = $stz->ref_id;


$cat->save();

$pid=explode(".",$stz->product_id);
$product_detail=new ProductDetail();
$product_detail->product_id = $stz->product_id;

$product_detail->pid= $pid[0];
$product_detail->status=1;



$product_detail->save();

$product=Product::where('product_id',$pid[0])->first();
if($product->quantity < $product->stock_quantity){
$product->quantity+=1;

$product->save();

}





}

//$del=SalesCron::all();
//$del->each->delete();

}

   }
        
   if($items2){
    $num=sizeof($items2);
    if($num==1){
        $items2[2]=0;
    }

  if($items2[1]){
    $left=User::where('seller_id',$items2[1])->first();

    $sellerOne=SalesCron::latest()->where('seller_id',$items2[1])->count();
      $sellerOnematch=User::latest()->where('seller_id',$items2[1])->first();
    }
    else{
      $sellerOne=0;
    }
    if($items2[2]){
        $right=User::where('seller_id',$items2[2])->first();

      $sellerTwo=SalesCron::latest()->where('seller_id',$items2[2])->count();

$sellerTwomatch=User::latest()->where('seller_id',$items2[2])->first();
    }
    else{
      $sellerTwo=0;

    }




if($sellerOne==0 || $sellerTwo==0){
 
}
else{
if($sellerOne>$sellerTwo)
{


$len=$sellerOne-$sellerTwo;

$onecarry=$len*150;

if($len)

{   for($i=1;$i<=$len;$i++){
$matsels=DB::table('product_scron')->where('seller_id',$left->seller_id)->take($len)->get();
foreach($matsels as $matsel)
{ 
$mats=SalesCron::latest()->where('id',$matsel->id)->where('seller_id',$matsel->seller_id)->first();

$mats->status=0;
$mats->save();
}
}
}

$sellerOnematch->matches+=1;
if($onecarry>1800){
$sellerOnematch->carry=1800;
$admins=User::where('seller_id',2000)->first();
$admins->carry+=$onecarry-1800;
$admins->save();
}
else{
$sellerOnematch->carry=$onecarry;

}

$sellerOnematch->status=1;

$sellerOnematch->save();

$sellerTwomatch->matches+=1;
$sellerTwomatch->status=1;

$sellerTwomatch->save(); 
$sell=User::latest()->where('seller_id',$items2[1])->first();

        $sellers = User::where('role_id',3)->where('id','<=',$sell->id)->where('wings',$sell->wings)->where('track',$sell->track)->limit(8)->latest()->get();
        foreach($sellers as $seller){
              $seller->points+=7.5;
              $seller->save();
          }
}


elseif($sellerOne<$sellerTwo)
{


$lenw=$sellerTwo-$sellerOne;
$twocarry=$lenw*150;


if($lenw)

{   for($i=1;$i<=$lenw;$i++){
$matsels=DB::table('product_scron')->where('seller_id',$right->seller_id)->take($lenw)->get();
foreach($matsels as $matsel)
{ 
$mats=SalesCron::latest()->where('id',$matsel->id)->where('seller_id',$matsel->seller_id)->first();

$mats->status=0;
$mats->save();
}
}
}
$sellerOnematch->matches+=1;
$sellerOnematch->status=1;

$sellerOnematch->save();

$sellerTwomatch->matches+=1;
if($twocarry>1800){
$sellerTwomatch->carry=1800;
$admins=User::where('seller_id',2000)->first();
$admins->carry+=$twocarry-200;
$admins->save();
}
else{
$sellerTwomatch->carry=$twocarry;

}

$sellerTwomatch->status=1;

$sellerTwomatch->save();
$sell=User::latest()->where('seller_id',$items2[1])->first();

        $sellers = User::where('role_id',3)->where('id','<=',$sell->id)->where('wings',$sell->wings)->where('track',$sell->track)->limit(8)->latest()->get();
        foreach($sellers as $seller){
              $seller->points+=7.5;
              $seller->save();
          }
}

$statusone=SalesCron::latest()->where('status',1)->where('seller_id',$user->seller_id)->count();




$statuszero=SalesCron::latest()->where('status',0)->get();

foreach($statuszero as $stz){
$cat=new AdminSalesCron();
$cat->product_id = $stz->product_id;

$cat->customer_name = $stz->customer_name;

$cat->phone = $stz->phone;
$cat->seller_id = $stz->seller_id;
$cat->ref_id = $stz->ref_id;


$cat->save();

$pid=explode(".",$stz->product_id);
$product_detail=new ProductDetail();
$product_detail->product_id = $stz->product_id;

$product_detail->pid= $pid[0];
$product_detail->status=1;



$product_detail->save();

$product=Product::where('product_id',$pid[0])->first();
if($product->quantity < $product->stock_quantity){
$product->quantity+=1;

$product->save();

}





}

//$del=SalesCron::all();
//$del->each->delete();

}

}
        

if($items3){
    $num=sizeof($items3);
    if($num==1){
        $items3[2]=0;
    }

  if($items3[1]){
    $left=User::where('seller_id',$items3[1])->first();

    $sellerOne=SalesCron::latest()->where('seller_id',$items3[1])->count();
      $sellerOnematch=User::latest()->where('seller_id',$items3[1])->first();
    }
    else{
      $sellerOne=0;
    }
    if($items3[2]){
        $right=User::where('seller_id',$items3[2])->first();

      $sellerTwo=SalesCron::latest()->where('seller_id',$items3[2])->count();

$sellerTwomatch=User::latest()->where('seller_id',$items3[2])->first();
    }
    else{
      $sellerTwo=0;

    }



if($sellerOne==0 || $sellerTwo==0){
 
}
else{
if($sellerOne>$sellerTwo)
{


$len=$sellerOne-$sellerTwo;

$onecarry=$len*150;

if($len)

{   for($i=1;$i<=$len;$i++){
$matsels=DB::table('product_scron')->where('seller_id',$left->seller_id)->take($len)->get();
foreach($matsels as $matsel)
{ 
$mats=SalesCron::latest()->where('id',$matsel->id)->where('seller_id',$matsel->seller_id)->first();

$mats->status=0;
$mats->save();
}
}
}

$sellerOnematch->matches+=1;
if($onecarry>1800){
$sellerOnematch->carry=1800;
$admins=User::where('seller_id',2000)->first();
$admins->carry+=$onecarry-1800;
$admins->save();
}
else{
$sellerOnematch->carry=$onecarry;

}

$sellerOnematch->status=1;

$sellerOnematch->save();

$sellerTwomatch->matches+=1;
$sellerTwomatch->status=1;

$sellerTwomatch->save(); 
$sell=User::latest()->where('seller_id',$items3[1])->first();

        $sellers = User::where('role_id',3)->where('id','<=',$sell->id)->where('wings',$sell->wings)->where('track',$sell->track)->limit(8)->latest()->get();
        foreach($sellers as $seller){
              $seller->points+=7.5;
              $seller->save();
          }
}


elseif($sellerOne<$sellerTwo)
{


$lenw=$sellerTwo-$sellerOne;
$twocarry=$lenw*150;


if($lenw)

{   for($i=1;$i<=$lenw;$i++){
$matsels=DB::table('product_scron')->where('seller_id',$right->seller_id)->take($lenw)->get();
foreach($matsels as $matsel)
{ 
$mats=SalesCron::latest()->where('id',$matsel->id)->where('seller_id',$matsel->seller_id)->first();

$mats->status=0;
$mats->save();
}
}
}
$sellerOnematch->matches+=1;
$sellerOnematch->status=1;

$sellerOnematch->save();

$sellerTwomatch->matches+=1;
if($twocarry>1800){
$sellerTwomatch->carry=1800;
$admins=User::where('seller_id',2000)->first();
$admins->carry+=$onecarry-1800;
$admins->save();
}
else{
$sellerTwomatch->carry=$twocarry;

}

$sellerTwomatch->status=1;

$sellerTwomatch->save(); 
$sell=User::latest()->where('seller_id',$items3[1])->first();

        $sellers = User::where('role_id',3)->where('id','<=',$sell->id)->where('wings',$sell->wings)->where('track',$sell->track)->limit(8)->latest()->get();
        foreach($sellers as $seller){
              $seller->points+=7.5;
              $seller->save();
          }
}

$statusone=SalesCron::latest()->where('status',1)->where('seller_id',$user->seller_id)->count();




$statuszero=SalesCron::latest()->where('status',0)->get();

foreach($statuszero as $stz){
$cat=new AdminSalesCron();
$cat->product_id = $stz->product_id;

$cat->customer_name = $stz->customer_name;

$cat->phone = $stz->phone;
$cat->seller_id = $stz->seller_id;
$cat->ref_id = $stz->ref_id;


$cat->save();

$pid=explode(".",$stz->product_id);
$product_detail=new ProductDetail();
$product_detail->product_id = $stz->product_id;

$product_detail->pid= $pid[0];
$product_detail->status=1;



$product_detail->save();

$product=Product::where('product_id',$pid[0])->first();
if($product->quantity < $product->stock_quantity){
$product->quantity+=1;

$product->save();

}





}

//$del=SalesCron::all();
//$del->each->delete();

}

}     
if($items4){
    
    $num=sizeof($items4);
    if($num==1){
        $items4[2]=0;
    }



  if($items4[1]){
    $left=User::where('seller_id',$items4[1])->first();

    $sellerOne=SalesCron::latest()->where('seller_id',$items4[1])->count();
      $sellerOnematch=User::latest()->where('seller_id',$items4[1])->first();
    }
    else{
      $sellerOne=0;
    }
    if($items4[2]){
        $right=User::where('seller_id',$items4[2])->first();

      $sellerTwo=SalesCron::latest()->where('seller_id',$items4[2])->count();

$sellerTwomatch=User::latest()->where('seller_id',$items4[2])->first();
    }
    else{
      $sellerTwo=0;

    }




if($sellerOne==0 || $sellerTwo==0){
 
}
else{
if($sellerOne>$sellerTwo)
{


$len=$sellerOne-$sellerTwo;

$onecarry=$len*150;

if($len)

{   for($i=1;$i<=$len;$i++){
$matsels=DB::table('product_scron')->where('seller_id',$left->seller_id)->take($len)->get();
foreach($matsels as $matsel)
{ 
$mats=SalesCron::latest()->where('id',$matsel->id)->where('seller_id',$matsel->seller_id)->first();

$mats->status=0;
$mats->save();
}
}
}

$sellerOnematch->matches+=1;
if($onecarry>1800){
$sellerOnematch->carry=1800;
$admins=User::where('seller_id',2000)->first();
$admins->carry+=$onecarry-1800;
$admins->save();
}
else{
$sellerOnematch->carry=$onecarry;

}

$sellerOnematch->status=1;

$sellerOnematch->save();

$sellerTwomatch->matches+=1;
$sellerTwomatch->status=1;

$sellerTwomatch->save(); 
$sell=User::latest()->where('seller_id',$items4[1])->first();

        $sellers = User::where('role_id',3)->where('id','<=',$sell->id)->where('wings',$sell->wings)->where('track',$sell->track)->limit(8)->latest()->get();
        foreach($sellers as $seller){
              $seller->points+=7.5;
              $seller->save();
          }
}


elseif($sellerOne<$sellerTwo)
{


$lenw=$sellerTwo-$sellerOne;
$twocarry=$lenw*150;


if($lenw)

{   for($i=1;$i<=$lenw;$i++){
$matsels=DB::table('product_scron')->where('seller_id',$right->seller_id)->take($lenw)->get();
foreach($matsels as $matsel)
{ 
$mats=SalesCron::latest()->where('id',$matsel->id)->where('seller_id',$matsel->seller_id)->first();

$mats->status=0;
$mats->save();
}
}
}
$sellerOnematch->matches+=1;
$sellerOnematch->status=1;

$sellerOnematch->save();

$sellerTwomatch->matches+=1;
if($twocarry>1800){
$sellerTwomatch->carry=1800;
$admins=User::where('seller_id',2000)->first();
$admins->carry+=$twocarry-1800;
$admins->save();
}
else{
$sellerTwomatch->carry=$twocarry;

}

$sellerTwomatch->status=1;

$sellerTwomatch->save(); 
$sell=User::latest()->where('seller_id',$items4[1])->first();

        $sellers = User::where('role_id',3)->where('id','<=',$sell->id)->where('wings',$sell->wings)->where('track',$sell->track)->limit(8)->latest()->get();
        foreach($sellers as $seller){
              $seller->points+=7.5;
              $seller->save();
          }
}

$statusone=SalesCron::latest()->where('status',1)->where('seller_id',$user->seller_id)->count();




$statuszero=SalesCron::latest()->where('status',0)->get();

foreach($statuszero as $stz){
$cat=new AdminSalesCron();
$cat->product_id = $stz->product_id;

$cat->customer_name = $stz->customer_name;

$cat->phone = $stz->phone;
$cat->seller_id = $stz->seller_id;
$cat->ref_id = $stz->ref_id;


$cat->save();

$pid=explode(".",$stz->product_id);
$product_detail=new ProductDetail();
$product_detail->product_id = $stz->product_id;

$product_detail->pid= $pid[0];
$product_detail->status=1;



$product_detail->save();

$product=Product::where('product_id',$pid[0])->first();
if($product->quantity < $product->stock_quantity){
$product->quantity+=1;

$product->save();

}





}

//$del=SalesCron::all();
//$del->each->delete();

}

}  

if($items5){
    $num=sizeof($items5);
    if($num==1){
        $items5[2]=0;
    }

    $left=User::where('seller_id',$items5[1])->first();
  $right=User::where('seller_id',$items5[2])->first();
  if($items5[1]){
    $sellerOne=SalesCron::latest()->where('seller_id',$items5[1])->count();
      $sellerOnematch=User::latest()->where('seller_id',$items5[1])->first();
    }
    else{
      $sellerOne=0;
    }
    if($items5[2]){
      $sellerTwo=SalesCron::latest()->where('seller_id',$items5[2])->count();

$sellerTwomatch=User::latest()->where('seller_id',$items5[2])->first();
    }
    else{
      $sellerTwo=0;

    }




if($sellerOne==0 || $sellerTwo==0){
 
}
else{
if($sellerOne>$sellerTwo)
{


$len=$sellerOne-$sellerTwo;

$onecarry=$len*150;

if($len)

{   for($i=1;$i<=$len;$i++){
$matsels=DB::table('product_scron')->where('seller_id',$left->seller_id)->take($len)->get();
foreach($matsels as $matsel)
{ 
$mats=SalesCron::latest()->where('id',$matsel->id)->where('seller_id',$matsel->seller_id)->first();

$mats->status=0;
$mats->save();
}
}
}

$sellerOnematch->matches+=1;
if($onecarry>1800){
$sellerOnematch->carry=1800;
$admins=User::where('seller_id',2000)->first();
$admins->carry+=$onecarry-1800;
$admins->save();
}
else{
$sellerOnematch->carry=$onecarry;

}

$sellerOnematch->status=1;

$sellerOnematch->save();

$sellerTwomatch->matches+=1;
$sellerTwomatch->status=1;

$sellerTwomatch->save();
$sell=User::latest()->where('seller_id',$items5[1])->first();

        $sellers = User::where('role_id',3)->where('id','<=',$sell->id)->where('wings',$sell->wings)->where('track',$sell->track)->limit(8)->latest()->get();
        foreach($sellers as $seller){
              $seller->points+=7.5;
              $seller->save();
          }
}


elseif($sellerOne<$sellerTwo)
{


$lenw=$sellerTwo-$sellerOne;
$twocarry=$lenw*150;


if($lenw)

{   for($i=1;$i<=$lenw;$i++){
$matsels=DB::table('product_scron')->where('seller_id',$right->seller_id)->take($lenw)->get();
foreach($matsels as $matsel)
{ 
$mats=SalesCron::latest()->where('id',$matsel->id)->where('seller_id',$matsel->seller_id)->first();

$mats->status=0;
$mats->save();
}
}
}
$sellerOnematch->matches+=1;
$sellerOnematch->status=1;

$sellerOnematch->save();

$sellerTwomatch->matches+=1;
if($twocarry>1800){
$sellerTwomatch->carry=1800;
$admins=User::where('seller_id',2000)->first();
$admins->carry+=$twocarry-1800;
$admins->save();
}
else{
$sellerTwomatch->carry=$twocarry;

}

$sellerTwomatch->status=1;

$sellerTwomatch->save(); 
$sell=User::latest()->where('seller_id',$items5[1])->first();

        $sellers = User::where('role_id',3)->where('id','<=',$sell->id)->where('wings',$sell->wings)->where('track',$sell->track)->limit(8)->latest()->get();
        foreach($sellers as $seller){
              $seller->points+=7.5;
              $seller->save();
          }
}

$statusone=SalesCron::latest()->where('status',1)->where('seller_id',$user->seller_id)->count();




$statuszero=SalesCron::latest()->where('status',0)->get();

foreach($statuszero as $stz){
$cat=new AdminSalesCron();
$cat->product_id = $stz->product_id;

$cat->customer_name = $stz->customer_name;

$cat->phone = $stz->phone;
$cat->seller_id = $stz->seller_id;
$cat->ref_id = $stz->ref_id;


$cat->save();

$pid=explode(".",$stz->product_id);
$product_detail=new ProductDetail();
$product_detail->product_id = $stz->product_id;

$product_detail->pid= $pid[0];
$product_detail->status=1;



$product_detail->save();

$product=Product::where('product_id',$pid[0])->first();
if($product->quantity < $product->stock_quantity){
$product->quantity+=1;

$product->save();

}





}

//$del=SalesCron::all();
//$del->each->delete();

}

}
if($items6){
    $num=sizeof($items6);
    if($num==1){
        $items6[2]=0;
    }

    $left=User::where('seller_id',$items6[1])->first();
  $right=User::where('seller_id',$items6[2])->first();
  
  if($items6[1]){
    $sellerOne=SalesCron::latest()->where('seller_id',$items6[1])->count();
      $sellerOnematch=User::latest()->where('seller_id',$items6[1])->first();
    }
    else{
      $sellerOne=0;
    }
    if($items6[2]){
      $sellerTwo=SalesCron::latest()->where('seller_id',$items6[2])->count();

$sellerTwomatch=User::latest()->where('seller_id',$items6[2])->first();
    }
    else{
      $sellerTwo=0;

    }




if($sellerOne==0 || $sellerTwo==0){
 
}
else{
if($sellerOne>$sellerTwo)
{


$len=$sellerOne-$sellerTwo;

$onecarry=$len*150;

if($len)

{   for($i=1;$i<=$len;$i++){
$matsels=DB::table('product_scron')->where('seller_id',$left->seller_id)->take($len)->get();
foreach($matsels as $matsel)
{ 
$mats=SalesCron::latest()->where('id',$matsel->id)->where('seller_id',$matsel->seller_id)->first();

$mats->status=0;
$mats->save();
}
}
}

$sellerOnematch->matches+=1;
if($onecarry>1800){
$sellerOnematch->carry=1800;
$admins=User::where('seller_id',2000)->first();
$admins->carry+=$onecarry-1800;
$admins->save();
}
else{
$sellerOnematch->carry=$onecarry;

}

$sellerOnematch->status=1;

$sellerOnematch->save();

$sellerTwomatch->matches+=1;
$sellerTwomatch->status=1;

$sellerTwomatch->save(); 
$sell=User::latest()->where('seller_id',$items6[1])->first();

        $sellers = User::where('role_id',3)->where('id','<=',$sell->id)->where('wings',$sell->wings)->where('track',$sell->track)->limit(8)->latest()->get();
        foreach($sellers as $seller){
              $seller->points+=7.5;
              $seller->save();
          }
}


elseif($sellerOne<$sellerTwo)
{


$lenw=$sellerTwo-$sellerOne;
$twocarry=$lenw*150;


if($lenw)

{   for($i=1;$i<=$lenw;$i++){
$matsels=DB::table('product_scron')->where('seller_id',$right->seller_id)->take($lenw)->get();
foreach($matsels as $matsel)
{ 
$mats=SalesCron::latest()->where('id',$matsel->id)->where('seller_id',$matsel->seller_id)->first();

$mats->status=0;
$mats->save();
}
}
}
$sellerOnematch->matches+=1;
$sellerOnematch->status=1;

$sellerOnematch->save();

$sellerTwomatch->matches+=1;
if($twocarry>1800){
$sellerTwomatch->carry=1800;
$admins=User::where('seller_id',2000)->first();
$admins->carry+=$twocarry-1800;
$admins->save();
}
else{
$sellerTwomatch->carry=$twocarry;

}

$sellerTwomatch->status=1;

$sellerTwomatch->save(); 
$sell=User::latest()->where('seller_id',$items6[1])->first();

        $sellers = User::where('role_id',3)->where('id','<=',$sell->id)->where('wings',$sell->wings)->where('track',$sell->track)->limit(8)->latest()->get();
        foreach($sellers as $seller){
              $seller->points+=7.5;
              $seller->save();
          }
}

$statusone=SalesCron::latest()->where('status',1)->where('seller_id',$user->seller_id)->count();




$statuszero=SalesCron::latest()->where('status',0)->get();

foreach($statuszero as $stz){
$cat=new AdminSalesCron();
$cat->product_id = $stz->product_id;

$cat->customer_name = $stz->customer_name;

$cat->phone = $stz->phone;
$cat->seller_id = $stz->seller_id;
$cat->ref_id = $stz->ref_id;


$cat->save();

$pid=explode(".",$stz->product_id);
$product_detail=new ProductDetail();
$product_detail->product_id = $stz->product_id;

$product_detail->pid= $pid[0];
$product_detail->status=1;



$product_detail->save();

$product=Product::where('product_id',$pid[0])->first();
if($product->quantity < $product->stock_quantity){
$product->quantity+=1;

$product->save();

}





}

//$del=SalesCron::all();
//$del->each->delete();

}

}



if($items7){
  $num=sizeof($items7);
  if($num==1){
      $items7[2]=0;
  }

  $left=User::where('seller_id',$items7[1])->first();
$right=User::where('seller_id',$items7[2])->first();
if($items7[1]){
  $sellerOne=SalesCron::latest()->where('seller_id',$items7[1])->count();
    $sellerOnematch=User::latest()->where('seller_id',$items7[1])->first();
  }
  else{
    $sellerOne=0;
  }
  if($items7[2]){
    $sellerTwo=SalesCron::latest()->where('seller_id',$items7[2])->count();

$sellerTwomatch=User::latest()->where('seller_id',$items7[2])->first();
  }
  else{
    $sellerTwo=0;

  }




if($sellerOne==0 || $sellerTwo==0){

}
else{
if($sellerOne>$sellerTwo)
{


$len=$sellerOne-$sellerTwo;

$onecarry=$len*150;

if($len)

{   for($i=1;$i<=$len;$i++){
$matsels=DB::table('product_scron')->where('seller_id',$left->seller_id)->take($len)->get();
foreach($matsels as $matsel)
{ 
$mats=SalesCron::latest()->where('id',$matsel->id)->where('seller_id',$matsel->seller_id)->first();

$mats->status=0;
$mats->save();
}
}
}

$sellerOnematch->matches+=1;
if($onecarry>1800){
$sellerOnematch->carry=1800;
$admins=User::where('seller_id',2000)->first();
$admins->carry+=$onecarry-1800;
$admins->save();
}
else{
$sellerOnematch->carry=$onecarry;

}

$sellerOnematch->status=1;

$sellerOnematch->save();

$sellerTwomatch->matches+=1;
$sellerTwomatch->status=1;

$sellerTwomatch->save();
$sell=User::latest()->where('seller_id',$items7[1])->first();

      $sellers = User::where('role_id',3)->where('id','<=',$sell->id)->where('wings',$sell->wings)->where('track',$sell->track)->limit(8)->latest()->get();
      foreach($sellers as $seller){
            $seller->points+=7.5;
            $seller->save();
        }
}


elseif($sellerOne<$sellerTwo)
{


$lenw=$sellerTwo-$sellerOne;
$twocarry=$lenw*150;


if($lenw)

{   for($i=1;$i<=$lenw;$i++){
$matsels=DB::table('product_scron')->where('seller_id',$right->seller_id)->take($lenw)->get();
foreach($matsels as $matsel)
{ 
$mats=SalesCron::latest()->where('id',$matsel->id)->where('seller_id',$matsel->seller_id)->first();

$mats->status=0;
$mats->save();
}
}
}
$sellerOnematch->matches+=1;
$sellerOnematch->status=1;

$sellerOnematch->save();

$sellerTwomatch->matches+=1;
if($twocarry>1800){
$sellerTwomatch->carry=1800;
$admins=User::where('seller_id',2000)->first();
$admins->carry+=$twocarry-1800;
$admins->save();
}
else{
$sellerTwomatch->carry=$twocarry;

}

$sellerTwomatch->status=1;

$sellerTwomatch->save(); 
$sell=User::latest()->where('seller_id',$items7[1])->first();

      $sellers = User::where('role_id',3)->where('id','<=',$sell->id)->where('wings',$sell->wings)->where('track',$sell->track)->limit(8)->latest()->get();
      foreach($sellers as $seller){
            $seller->points+=7.5;
            $seller->save();
        }
}

$statusone=SalesCron::latest()->where('status',1)->where('seller_id',$user->seller_id)->count();




$statuszero=SalesCron::latest()->where('status',0)->get();

foreach($statuszero as $stz){
$cat=new AdminSalesCron();
$cat->product_id = $stz->product_id;

$cat->customer_name = $stz->customer_name;

$cat->phone = $stz->phone;
$cat->seller_id = $stz->seller_id;
$cat->ref_id = $stz->ref_id;


$cat->save();

$pid=explode(".",$stz->product_id);
$product_detail=new ProductDetail();
$product_detail->product_id = $stz->product_id;

$product_detail->pid= $pid[0];
$product_detail->status=1;



$product_detail->save();

$product=Product::where('product_id',$pid[0])->first();
if($product->quantity < $product->stock_quantity){
$product->quantity+=1;

$product->save();

}





}

//$del=SalesCron::all();
//$del->each->delete();

}

}


if($items8){
  $num=sizeof($items8);
  if($num==1){
      $items8[2]=0;
  }

  $left=User::where('seller_id',$items8[1])->first();
$right=User::where('seller_id',$items8[2])->first();
if($items8[1]){
  $sellerOne=SalesCron::latest()->where('seller_id',$items8[1])->count();
    $sellerOnematch=User::latest()->where('seller_id',$items8[1])->first();
  }
  else{
    $sellerOne=0;
  }
  if($items8[2]){
    $sellerTwo=SalesCron::latest()->where('seller_id',$items8[2])->count();

$sellerTwomatch=User::latest()->where('seller_id',$items8[2])->first();
  }
  else{
    $sellerTwo=0;

  }




if($sellerOne==0 || $sellerTwo==0){

}
else{
if($sellerOne>$sellerTwo)
{


$len=$sellerOne-$sellerTwo;

$onecarry=$len*150;

if($len)

{   for($i=1;$i<=$len;$i++){
$matsels=DB::table('product_scron')->where('seller_id',$left->seller_id)->take($len)->get();
foreach($matsels as $matsel)
{ 
$mats=SalesCron::latest()->where('id',$matsel->id)->where('seller_id',$matsel->seller_id)->first();

$mats->status=0;
$mats->save();
}
}
}

$sellerOnematch->matches+=1;
if($onecarry>1800){
$sellerOnematch->carry=1800;
$admins=User::where('seller_id',2000)->first();
$admins->carry+=$onecarry-1800;
$admins->save();
}
else{
$sellerOnematch->carry=$onecarry;

}

$sellerOnematch->status=1;

$sellerOnematch->save();

$sellerTwomatch->matches+=1;
$sellerTwomatch->status=1;

$sellerTwomatch->save();
$sell=User::latest()->where('seller_id',$items8[1])->first();

      $sellers = User::where('role_id',3)->where('id','<=',$sell->id)->where('wings',$sell->wings)->where('track',$sell->track)->limit(8)->latest()->get();
      foreach($sellers as $seller){
            $seller->points+=7.5;
            $seller->save();
        }
}


elseif($sellerOne<$sellerTwo)
{


$lenw=$sellerTwo-$sellerOne;
$twocarry=$lenw*150;


if($lenw)

{   for($i=1;$i<=$lenw;$i++){
$matsels=DB::table('product_scron')->where('seller_id',$right->seller_id)->take($lenw)->get();
foreach($matsels as $matsel)
{ 
$mats=SalesCron::latest()->where('id',$matsel->id)->where('seller_id',$matsel->seller_id)->first();

$mats->status=0;
$mats->save();
}
}
}
$sellerOnematch->matches+=1;
$sellerOnematch->status=1;

$sellerOnematch->save();

$sellerTwomatch->matches+=1;
if($twocarry>1800){
$sellerTwomatch->carry=1800;
$admins=User::where('seller_id',2000)->first();
$admins->carry+=$twocarry-1800;
$admins->save();
}
else{
$sellerTwomatch->carry=$twocarry;

}

$sellerTwomatch->status=1;

$sellerTwomatch->save(); 
$sell=User::latest()->where('seller_id',$items8[1])->first();

      $sellers = User::where('role_id',3)->where('id','<=',$sell->id)->where('wings',$sell->wings)->where('track',$sell->track)->limit(8)->latest()->get();
      foreach($sellers as $seller){
            $seller->points+=7.5;
            $seller->save();
        }
}

$statusone=SalesCron::latest()->where('status',1)->where('seller_id',$user->seller_id)->count();




$statuszero=SalesCron::latest()->where('status',0)->get();

foreach($statuszero as $stz){
$cat=new AdminSalesCron();
$cat->product_id = $stz->product_id;

$cat->customer_name = $stz->customer_name;

$cat->phone = $stz->phone;
$cat->seller_id = $stz->seller_id;
$cat->ref_id = $stz->ref_id;


$cat->save();

$pid=explode(".",$stz->product_id);
$product_detail=new ProductDetail();
$product_detail->product_id = $stz->product_id;

$product_detail->pid= $pid[0];
$product_detail->status=1;



$product_detail->save();

$product=Product::where('product_id',$pid[0])->first();
if($product->quantity < $product->stock_quantity){
$product->quantity+=1;

$product->save();

}





}

//$del=SalesCron::all();
//$del->each->delete();

}

}


if($items9){
  $num=sizeof($items9);
  if($num==1){
      $items9[2]=0;
  }

  $left=User::where('seller_id',$items9[1])->first();
$right=User::where('seller_id',$items9[2])->first();
if($items9[1]){
  $sellerOne=SalesCron::latest()->where('seller_id',$items9[1])->count();
    $sellerOnematch=User::latest()->where('seller_id',$items9[1])->first();
  }
  else{
    $sellerOne=0;
  }
  if($items9[2]){
    $sellerTwo=SalesCron::latest()->where('seller_id',$items9[2])->count();

$sellerTwomatch=User::latest()->where('seller_id',$items9[2])->first();
  }
  else{
    $sellerTwo=0;

  }




if($sellerOne==0 || $sellerTwo==0){

}
else{
if($sellerOne>$sellerTwo)
{


$len=$sellerOne-$sellerTwo;

$onecarry=$len*150;

if($len)

{   for($i=1;$i<=$len;$i++){
$matsels=DB::table('product_scron')->where('seller_id',$left->seller_id)->take($len)->get();
foreach($matsels as $matsel)
{ 
$mats=SalesCron::latest()->where('id',$matsel->id)->where('seller_id',$matsel->seller_id)->first();

$mats->status=0;
$mats->save();
}
}
}

$sellerOnematch->matches+=1;
if($onecarry>1800){
$sellerOnematch->carry=1800;
$admins=User::where('seller_id',2000)->first();
$admins->carry+=$onecarry-1800;
$admins->save();
}
else{
$sellerOnematch->carry=$onecarry;

}

$sellerOnematch->status=1;

$sellerOnematch->save();

$sellerTwomatch->matches+=1;
$sellerTwomatch->status=1;

$sellerTwomatch->save();
$sell=User::latest()->where('seller_id',$items9[1])->first();

      $sellers = User::where('role_id',3)->where('id','<=',$sell->id)->where('wings',$sell->wings)->where('track',$sell->track)->limit(8)->latest()->get();
      foreach($sellers as $seller){
            $seller->points+=7.5;
            $seller->save();
        }
}


elseif($sellerOne<$sellerTwo)
{


$lenw=$sellerTwo-$sellerOne;
$twocarry=$lenw*150;


if($lenw)

{   for($i=1;$i<=$lenw;$i++){
$matsels=DB::table('product_scron')->where('seller_id',$right->seller_id)->take($lenw)->get();
foreach($matsels as $matsel)
{ 
$mats=SalesCron::latest()->where('id',$matsel->id)->where('seller_id',$matsel->seller_id)->first();

$mats->status=0;
$mats->save();
}
}
}
$sellerOnematch->matches+=1;
$sellerOnematch->status=1;

$sellerOnematch->save();

$sellerTwomatch->matches+=1;
if($twocarry>1800){
$sellerTwomatch->carry=1800;
$admins=User::where('seller_id',2000)->first();
$admins->carry+=$twocarry-1800;
$admins->save();
}
else{
$sellerTwomatch->carry=$twocarry;

}

$sellerTwomatch->status=1;

$sellerTwomatch->save(); 
$sell=User::latest()->where('seller_id',$items9[1])->first();

      $sellers = User::where('role_id',3)->where('id','<=',$sell->id)->where('wings',$sell->wings)->where('track',$sell->track)->limit(8)->latest()->get();
      foreach($sellers as $seller){
            $seller->points+=7.5;
            $seller->save();
        }
}

$statusone=SalesCron::latest()->where('status',1)->where('seller_id',$user->seller_id)->count();




$statuszero=SalesCron::latest()->where('status',0)->get();

foreach($statuszero as $stz){
$cat=new AdminSalesCron();
$cat->product_id = $stz->product_id;

$cat->customer_name = $stz->customer_name;

$cat->phone = $stz->phone;
$cat->seller_id = $stz->seller_id;
$cat->ref_id = $stz->ref_id;


$cat->save();

$pid=explode(".",$stz->product_id);
$product_detail=new ProductDetail();
$product_detail->product_id = $stz->product_id;

$product_detail->pid= $pid[0];
$product_detail->status=1;



$product_detail->save();

$product=Product::where('product_id',$pid[0])->first();
if($product->quantity < $product->stock_quantity){
$product->quantity+=1;

$product->save();

}





}

//$del=SalesCron::all();
//$del->each->delete();

}

}



if($items10){
  $num=sizeof($items10);
  if($num==1){
      $items10[2]=0;
  }

  $left=User::where('seller_id',$items10[1])->first();
$right=User::where('seller_id',$items10[2])->first();
if($items10[1]){
  $sellerOne=SalesCron::latest()->where('seller_id',$items10[1])->count();
    $sellerOnematch=User::latest()->where('seller_id',$items10[1])->first();
  }
  else{
    $sellerOne=0;
  }
  if($items10[2]){
    $sellerTwo=SalesCron::latest()->where('seller_id',$items10[2])->count();

$sellerTwomatch=User::latest()->where('seller_id',$items10[2])->first();
  }
  else{
    $sellerTwo=0;

  }




if($sellerOne==0 || $sellerTwo==0){

}
else{
if($sellerOne>$sellerTwo)
{


$len=$sellerOne-$sellerTwo;

$onecarry=$len*150;

if($len)

{   for($i=1;$i<=$len;$i++){
$matsels=DB::table('product_scron')->where('seller_id',$left->seller_id)->take($len)->get();
foreach($matsels as $matsel)
{ 
$mats=SalesCron::latest()->where('id',$matsel->id)->where('seller_id',$matsel->seller_id)->first();

$mats->status=0;
$mats->save();
}
}
}

$sellerOnematch->matches+=1;
if($onecarry>1800){
$sellerOnematch->carry=1800;
$admins=User::where('seller_id',2000)->first();
$admins->carry+=$onecarry-1800;
$admins->save();
}
else{
$sellerOnematch->carry=$onecarry;

}

$sellerOnematch->status=1;

$sellerOnematch->save();

$sellerTwomatch->matches+=1;
$sellerTwomatch->status=1;

$sellerTwomatch->save();
$sell=User::latest()->where('seller_id',$items10[1])->first();

      $sellers = User::where('role_id',3)->where('id','<=',$sell->id)->where('wings',$sell->wings)->where('track',$sell->track)->limit(8)->latest()->get();
      foreach($sellers as $seller){
            $seller->points+=7.5;
            $seller->save();
        }
}


elseif($sellerOne<$sellerTwo)
{


$lenw=$sellerTwo-$sellerOne;
$twocarry=$lenw*150;


if($lenw)

{   for($i=1;$i<=$lenw;$i++){
$matsels=DB::table('product_scron')->where('seller_id',$right->seller_id)->take($lenw)->get();
foreach($matsels as $matsel)
{ 
$mats=SalesCron::latest()->where('id',$matsel->id)->where('seller_id',$matsel->seller_id)->first();

$mats->status=0;
$mats->save();
}
}
}
$sellerOnematch->matches+=1;
$sellerOnematch->status=1;

$sellerOnematch->save();

$sellerTwomatch->matches+=1;
if($twocarry>1800){
$sellerTwomatch->carry=1800;
$admins=User::where('seller_id',2000)->first();
$admins->carry+=$twocarry-1800;
$admins->save();
}
else{
$sellerTwomatch->carry=$twocarry;

}

$sellerTwomatch->status=1;

$sellerTwomatch->save(); 
$sell=User::latest()->where('seller_id',$items10[1])->first();

      $sellers = User::where('role_id',3)->where('id','<=',$sell->id)->where('wings',$sell->wings)->where('track',$sell->track)->limit(8)->latest()->get();
      foreach($sellers as $seller){
            $seller->points+=7.5;
            $seller->save();
        }
}

$statusone=SalesCron::latest()->where('status',1)->where('seller_id',$user->seller_id)->count();




$statuszero=SalesCron::latest()->where('status',0)->get();

foreach($statuszero as $stz){
$cat=new AdminSalesCron();
$cat->product_id = $stz->product_id;

$cat->customer_name = $stz->customer_name;

$cat->phone = $stz->phone;
$cat->seller_id = $stz->seller_id;
$cat->ref_id = $stz->ref_id;


$cat->save();

$pid=explode(".",$stz->product_id);
$product_detail=new ProductDetail();
$product_detail->product_id = $stz->product_id;

$product_detail->pid= $pid[0];
$product_detail->status=1;



$product_detail->save();

$product=Product::where('product_id',$pid[0])->first();
if($product->quantity < $product->stock_quantity){
$product->quantity+=1;

$product->save();

}





}

//$del=SalesCron::all();
//$del->each->delete();

}

}

$del=SalesCron::all();
$del->each->delete();

    
/*if(){

}

elseif(2){

   $onesellers=DB::table('users')->where('level',$user->level)->where('wings',$user->wings)->where('track',1)->first();
    $twosellers=DB::table('users')->where('level',$user->level)->where('wings',$user->wings)->where('track',2)->first();
    
    $sellerOnematch=User::latest()->where('seller_id',$onesellers->seller_id)->first();
    $sellerTwomatch=User::latest()->where('seller_id',$twosellers->seller_id)->first();
        $sellerOne=SalesCron::latest()->where('seller_id',$onesellers->seller_id)->count();
        $sellerTwo=SalesCron::latest()->where('seller_id',$twosellers->seller_id)->count();

    $sellerOne=SalesCron::latest()->where('seller_id',$sellerid1)->count();
    $sellerTwo=SalesCron::latest()->where('seller_id',$sellerid2)->count();
if($sellerOne==0 || $sellerTwo==0){

}
else{
if($sellerOne>$sellerTwo)
{


$len=$sellerOne-$sellerTwo;

if($len)

 {   for($i=1;$i<=$len;$i++){
        $matsels=DB::table('product_scron')->where('seller_id',$sellerid1)->take($len)->get();
        foreach($matsels as $matsel)
       { 
    $mats=SalesCron::latest()->where('id',$matsel->id)->where('seller_id',$matsel->seller_id)->first();

        $mats->status=0;
$mats->save();
       }
    }
}
$sellerOnematch->matches+=1;
$sellerOnematch->status=1;

$sellerOnematch->save();

$sellerTwomatch->matches+=1;
$sellerTwomatch->status=1;

$sellerTwomatch->save(); 
}


elseif($sellerOne<$sellerTwo)
{


$lenw=$sellerTwo-$sellerOne;

if($lenw)

 {   for($i=1;$i<=$lenw;$i++){
        $matsels=DB::table('product_scron')->where('seller_id',$sellerid2)->take($lenw)->get();
        foreach($matsels as $matsel)
       { 
    $mats=SalesCron::latest()->where('id',$matsel->id)->where('seller_id',$matsel->seller_id)->first();

        $mats->status=0;
$mats->save();
       }
    }
}
$sellerOnematch->matches+=1;
$sellerOnematch->status=1;

$sellerOnematch->save();

$sellerTwomatch->matches+=1;
$sellerTwomatch->status=1;

$sellerTwomatch->save(); 
}

$statusone=SalesCron::latest()->where('status',1)->where('seller_id',$user->seller_id)->count();




$statuszero=SalesCron::latest()->where('status',0)->get();

foreach($statuszero as $stz){
$cat=new AdminSalesCron();
$cat->product_id = $stz->product_id;

$cat->customer_name = $stz->customer_name;

$cat->phone = $stz->phone;
$cat->seller_id = $stz->seller_id;
$cat->ref_id = $stz->ref_id;


$cat->save();

$pid=explode(".",$stz->product_id);
$product_detail=new ProductDetail();
$product_detail->product_id = $stz->product_id;

$product_detail->pid= $pid[0];
$product_detail->status=1;



$product_detail->save();

$product=Product::where('product_id',$pid[0])->first();
if($product->quantity < $product->stock_quantity){
    $product->quantity+=1;

    $product->save();

}





}

$del=SalesCron::all();
$del->each->delete();

}
}


else{

}*/

        


/*foreach($twosellers as $key=>$twosell){
    $sellerid1=$twosellers[0]->seller_id;
$sellerid2=$twosellers[1]->seller_id;
}
$sellerid1=$twosellers[0]->seller_id;
$sellerid2=$twosellers[1]->seller_id;

*/

    
$msp = MSP::find(1);

    $sum=0;
    $matusers=User::all();
foreach($matusers as $mtu){
    
if($mtu->matches==3)
{

    $sum=$mtu->points+$msp->B;
    DB::table('users')->whereIn('id', [$mtu->id])->where('matches',3)->where('status',1)->update(array('grade' => 'B','status'=>0));
    
    
   /* foreach($userpoints as $usp){
        $myids=User::where('id',$usp->id)->first();
        
    }*/
   
    
}
if($mtu->matches==10)
{
    $sum=($mtu->points)+$msp->C;
    DB::table('users')->whereIn('id', [$mtu->id])->where('matches',10)->where('status',1)->update(array('grade' => 'C' ,'status'=>0));

}
if($mtu->matches==30)
{
    $sum=($mtu->points)+$msp->D;
    DB::table('users')->whereIn('id', [$mtu->id])->where('matches',30)->where('status',1)->update(array('grade' => 'D','status'=>0));

}

if($mtu->matches==60)
{
    $sum=($mtu->points)+$msp->E;
    DB::table('users')->whereIn('id', [$mtu->id])->where('matches',60)->where('status',1)->update(array('grade' => 'E','status'=>0));

}

if($mtu->matches==150)
{

    DB::table('users')->whereIn('id', [$mtu->id])->where('matches',150)->update(array('grade' => 'M'));

}

if($mtu->matches==320)
{
    DB::table('users')->whereIn('id', [$mtu->id])->where('matches',320)->update(array('grade' => 'ASM'));

}

if($mtu->matches==129)
{
    DB::table('users')->whereIn('id', [$mtu->id])->where('matches',129)->update(array('grade' => 'SM'));

}

if($mtu->matches==103)
{
    DB::table('users')->whereIn('id', [$mtu->id])->where('matches',103)->update(array('grade' => 'GM'));

}


}

        $this->info('Successfully sent daily quote to everyone.');

    }
}
