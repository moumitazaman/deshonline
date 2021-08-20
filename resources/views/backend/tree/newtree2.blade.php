@extends('backend.layouts.app')

@section('title', 'Tree')

@push('styles')
<!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
  <!-- Sweetalert 2 -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/sweetalert2/sweetalert2.min.css') }}">
@endpush

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <style>
    .col-md-12 .col-md-4{
      margin:auto;
    }
    @media only screen and (max-width: 600px) {
 .col-3 .img-circle{
   display:none;
 }
 .col-3 .widget-user .widget-user-username{
   font-size:14px;
 }
 .col-3 h5{
   font-size:1.2rem;
 }
 .col-3 h6{
  font-size: 0.7rem;
 }
}
    </style>
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            {{-- Messages will display here --}}
            @include('backend.layouts.flash')
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0 text-dark">Tree Diagram</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Tree</li>
                </ol>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
  
        <!-- Main content -->
        <div class="content">
          <div class="container-fluid">
            <div class="card">
              <div class="card-body">
                <div class="row">
               

<div class="col-md-12 col-sm-12 col-12" style="text-align:center;">

<div class="col-md-4 col-md-offset-2">
<?php
              $me = App\User::latest()->where('seller_id',$id)->first();
              $testtotal=0;
              $total=0;
              $totalA=0;
              $totalB=0;
              $totalA1=0;
              $totalB1=0;
              $i=0;
              $j=0;
              $totalcarryA=0;
$totalcarryB=0;
$totalcarry2A=0;
$totalcarry2B=0;
$totalcarrytwoA=0;
$totalcarrytwoB=0;
$totalcarryA3=0;
$totalcarryB3=0;
$totalcarryAd3=0;
$totalcarryBd3=0;
$totalcarryAh3=0;
$totalcarryBh3=0;
$totalcarryAk3=0;
$totalcarryBk3=0;
$totalcarryA30=0;
$totalcarryB30=0;
$totalcarryA31=0;
$totalcarryB31=0;
$totalcarryA32=0;
$totalcarryB32=0;
$totalcarryA33=0;
$totalcarryB33=0;
$totalcarryA4=0;
$totalcarryB4=0;
 $me->level;
 $level1=$me->level+1;
              $wings=$me->wings;
              $count=App\User::latest()->where('id','<=',$me->id)->whereIn('ref_id',[2000,$id,$me->ref_id])->count();
              if($me->level==2 || $me->level==3 || $me->level==4){
              
                if($me->track==1) {
			    $left=App\User::where('role_id',3)->where('id','>',$me->id)->where('wings',$wings)->where('track',$me->track)->get();
        
          foreach($left as $lts){
                            $carrlt=App\Order::where('user_id',$lts->id)->get();  
                            
                            foreach($carrlt as $clt){
                        $totalA1+=$clt->total_item;
                      } 
                     
          }
        }else{
          $totalA1=0;
        }        
        if($me->track==2) { 
              $rights=App\User::where('role_id',3)->where('id','>',$me->id)->where('wings',$wings)->where('track',2)->get();
          
          foreach($rights as $rths){
                            $carrer=App\Order::where('user_id',$rths->id)->get();  
                            foreach($carrer as $rce){
                           $totalB1+=$rce->total_item;
                      } 
                     
          }
        }else{
          $totalB1=0;
        }
      }
      elseif($me->level==3){
        if($me->track==1) {
     $left=App\User::where('role_id',3)->where('id','>',$me->id)->where('wings',$wings)->where('track',1)->get();
   
     foreach($left as $lts){
                       $carrlt=App\Order::where('user_id',$lts->id)->get();  
                       
                       foreach($carrlt as $clt){
                   $totalA1+=$clt->total_item;
                 } 
                
     }
   }else{
     $totalA1=0;
   }        
   if($me->track==2) { 
         $rights=App\User::where('role_id',3)->where('id','>',$me->id)->where('wings',$wings)->where('track',2)->get();
     
     foreach($rights as $rths){
                       $carrer=App\Order::where('user_id',$rths->id)->get();  
                       foreach($carrer as $rce){
                      $totalB1+=$rce->total_item;
                 } 
                
     }
   }else{
     $totalB1=0;
   }        
      }
      else{
        $left=App\User::where('role_id',3)->where('id','>',$me->id)->where('wings',$wings)->where('track',1)->get();
        
        foreach($left as $lts){
                          $carrlt=App\Order::where('user_id',$lts->id)->get();  
                          
                          foreach($carrlt as $clt){
                        $totalA1+=$clt->total_item;
                    } 
                   
        }
                    
          
            $rights=App\User::where('role_id',3)->where('id','>',$me->id)->where('wings',$wings)->where('track',2)->get();
        
        foreach($rights as $rths){
                          $carrer=App\Order::where('user_id',$rths->id)->get();  
                          foreach($carrer as $rce){
                         $totalB1+=$rce->total_item;
                    } 
        }
      }
if($wings=='left' && $me->track==1 && $level1==3){
           $levelone1 = app\User::orderBy('created_at','asc')->where('level',$level1)->where('wings',$wings)->where('track',1)->first();
   
}
elseif($wings=='left' && $me->track==2 && $level1==3 ){
  
  $levelone1 = app\User::orderBy('created_at','asc')->where('level',$level1)->where('wings',$wings)->where('track',1)->skip(1)->first();

}
elseif($wings=='right' && $me->track==1 && $level1==3 ){
              $levelone1 = app\User::orderBy('created_at','asc')->where('level',$level1)->where('wings',$wings)->where('track',1)->skip(1)->first();

}
elseif($wings=='right' && $me->track==2 && $level1==3 ){
  
  $levelone1 = app\User::orderBy('created_at','asc')->where('level',$level1)->where('wings',$wings)->where('track',1)->skip(2)->first();

}

elseif($wings=='left' && $me->track==1 && $level1==4){
  $levelone1 = app\User::orderBy('created_at','asc')->where('level',$level1)->where('wings',$wings)->where('track',1)->first();

}
elseif($wings=='left' && $me->track==2 && $level1==4 ){

$levelone1 = app\User::orderBy('created_at','asc')->where('level',$level1)->where('wings',$wings)->where('track',1)->skip(1)->first();

}

elseif($wings=='right' && $me->track==1 && $level1==4 ){
     $levelone1 = app\User::orderBy('created_at','asc')->where('level',$level1)->where('wings',$wings)->where('track',1)->skip(2)->first();

}
elseif($wings=='right' && $me->track==2 && $level1==4 ){

$levelone1 = app\User::orderBy('created_at','asc')->where('level',$level1)->where('wings',$wings)->where('track',1)->skip(2)->first();

}
else{
               $levelone1 = app\User::orderBy('created_at','asc')->where('level',$level1)->where('wings',$wings)->where('track',1)->first();

}

if($levelone1){
          $two=App\User::where('role_id',3)->where('id','>',$levelone1->id)->where('track',1)->where('wings',$wings)->get();
    
    foreach($two as $t){
                      $carrb=App\Order::where('user_id',$t->id)->get();  
                      
                      foreach($carrb as $cb){
                    $totalcarryA+=$cb->total_item;
                } 
               
    }
    
     $three=App\User::where('role_id',3)->where('id','>',$levelone1->id)->where('track',2)->where('wings',$wings)->get();
    
    foreach($three as $th){
                      $carr=App\Order::where('user_id',$th->id)->get();  
                      foreach($carr as $c){
                     $totalcarryB+=$c->total_item;
                } 
    } 
   
    $totalcarryB=0;
  }
    
if($wings=='left' && $me->track==1 && $level1==3){
       $levelone2 = app\User::orderBy('created_at','asc')->where('level',$level1)->where('track',2)->where('wings',$wings)->first();
 
}
elseif($wings=='left' && $me->track==2 && $level1==3){
  $levelone2 = app\User::orderBy('created_at','asc')->where('level',$level1)->where('track',2)->where('wings',$wings)->skip(1)->first();

}
elseif($wings=='right' && $me->track==1 && $level1==3 ){
  $levelone2 = app\User::orderBy('created_at','asc')->where('level',$level1)->where('track',2)->where('wings',$wings)->first();

}
elseif($wings=='right' && $me->track==2 && $level1==3 ){
  $levelone2 = app\User::orderBy('created_at','asc')->where('level',$level1)->where('track',2)->where('wings',$wings)->skip(1)->first();

}
else if($wings=='left' && $me->track==1 && $level1==4){
  $levelone2 = app\User::orderBy('created_at','asc')->where('level',$level1)->where('track',2)->where('wings',$wings)->first();

}
elseif($wings=='left' && $me->track==2 && $level1==4){
$levelone2 = app\User::orderBy('created_at','asc')->where('level',$level1)->where('track',2)->where('wings',$wings)->skip(1)->first();

}


elseif($wings=='right' && $me->track==1 && $level1==4 ){
$levelone2 = app\User::orderBy('created_at','asc')->where('level',$level1)->where('track',2)->where('wings',$wings)->first();

}
elseif($wings=='right' && $me->track==2 && $level1==4 ){
$levelone2 = app\User::orderBy('created_at','asc')->where('level',$level1)->where('track',2)->where('wings',$wings)->skip(2)->first();

}
else{
       $levelone2 = app\User::orderBy('created_at','asc')->where('level',$level1)->where('track',2)->where('wings',$wings)->first();
 
}
if($levelone2){
    $twos=App\User::where('role_id',3)->where('id','>',$levelone2->id)->where('wings',$levelone2->wings)->where('track',1)->get();

foreach($twos as $t2){
       $carr2=App\Order::where('user_id',$t2->id)->get();  
       
       foreach($carr2 as $c2){
     $totalcarry2A+=$c2->total_item;
 } 
 
}
if($level1<=4){
  $totalcarry2A=0;

}
$threes=App\User::where('role_id',3)->where('id','>',$levelone2->id)->where('wings',$levelone2->wings)->where('track',2)->get();

foreach($threes as $th3){
       $carr3=App\Order::where('user_id',$th3->id)->get();  
       foreach($carr3 as $c3){
      $totalcarry2B+=$c3->total_item;
 } 
}
}
//$totalcarry2B=0;
$level2=$level1+1;
if($me->track==1 && $level2==4){

  $level2s=app\User::orderBy('created_at','asc')->where('level',$level2)->where('wings',$wings)->where('role_id',3)->limit(4)->get();
 $lvc=app\User::orderBy('created_at','asc')->where('level',$level2)->where('wings',$wings)->where('role_id',3)->limit(4)->count();

}
elseif($me->track==2 && $level2==4){
  $level2s=app\User::orderBy('created_at','asc')->where('level',$level2)->where('wings',$wings)->where('role_id',3)->limit(4)->skip(1)->get();
  $lvc=app\User::orderBy('created_at','asc')->where('level',$level2)->where('wings',$wings)->where('role_id',3)->limit(4)->skip(1)->count();
 
}else{
  $level2s=app\User::orderBy('created_at','asc')->where('level',$level2)->where('wings',$wings)->where('role_id',3)->limit(4)->get();
 $lvc=app\User::orderBy('created_at','asc')->where('level',$level2)->where('wings',$wings)->where('role_id',3)->limit(4)->count();

}




if(!$level2s->isEmpty()){
  if($lvc==1){
 if($level2s[0]['id']){
      $lv1=$level2s[0]['id'];


  

  $twols=App\User::where('track',1)->where('role_id',3)->where('id','>',$lv1)->where('wings',$wings)->get();
  foreach($twols as $r1){

             $carr2l=App\Order::where('user_id',$r1->id)->get();  
             if($carr2l){  

             foreach($carr2l as $c2l){
   $totalcarryA30+=$c2l->total_item;
       } 
      }
       else{
        $totalcarryA30=0;
       }
      
  }
 
 
 $twolks=App\User::where('track',2)->where('role_id',3)->where('id','>',$lv1)->where('wings',$wings)->get();
 foreach($twolks as $r2){

             $carr2jl=App\Order::where('user_id',$r2->id)->get();  
             if($carr2jl){  
             foreach($carr2jl as $c2jl){
            //$totalcarryB30+=$c2jl->total_item;
      
      }
    }else{
      $totalcarryB30=0;
    }
    }
}
}
if($lvc==2){
  $lv1=$level2s[0]['id'];


  

  $twols=App\User::where('track',1)->where('role_id',3)->where('id','>',$lv1)->where('wings',$wings)->get();
  foreach($twols as $r1){

             $carr2l=App\Order::where('user_id',$r1->id)->get();  
             if($carr2l){  

             foreach($carr2l as $c2l){
   $totalcarryA30+=$c2l->total_item;
       } 
      }
       else{
        $totalcarryA30=0;
       }
      
  }
 
 
 $twolks=App\User::where('track',2)->where('role_id',3)->where('id','>',$lv1)->where('wings',$wings)->get();
 foreach($twolks as $r2){

             $carr2jl=App\Order::where('user_id',$r2->id)->get();  
             if($carr2jl){  
             foreach($carr2jl as $c2jl){
            //$totalcarryB30+=$c2jl->total_item;
      
      }
    }else{
      $totalcarryB30=0;
    }
    }
}
    

     
      $lv2=$level2s[1]['id'];

      $twohls=App\User::where('track',1)->where('role_id',3)->where('id','>',$lv2)->where('wings',$wings)->get();
      foreach($twohls as $t3){

                  $carr2ol=App\Order::where('user_id',$t3->id)->get();  
                  
                  foreach($carr2ol as $c2l){
                //$totalcarryA31+=$c2l->total_item;
            } 
          }
      
       $threers=App\User::where('track',2)->where('wings',$wings)->where('role_id',3)->where('id','>',$lv2)->get();
       foreach($threers as $t4){

          $carr3r=App\Order::where('user_id',$t4->id)->get();  
                  foreach($carr3r as $c3r){
              // $totalcarryB31+=$c3r->total_item;
            } 
          }
      
     
}
 if($lvc==3){
  $lv1=$level2s[0]['id'];


  

  $twols=App\User::where('track',1)->where('role_id',3)->where('id','>',$lv1)->where('wings',$wings)->get();
  foreach($twols as $r1){

             $carr2l=App\Order::where('user_id',$r1->id)->get();  
             if($carr2l){  

             foreach($carr2l as $c2l){
   $totalcarryA30+=$c2l->total_item;
       } 
      }
       else{
        $totalcarryA30=0;
       }
      
  }
 
 
 $twolks=App\User::where('track',2)->where('role_id',3)->where('id','>',$lv1)->where('wings',$wings)->get();
 foreach($twolks as $r2){

             $carr2jl=App\Order::where('user_id',$r2->id)->get();  
             if($carr2jl){  
             foreach($carr2jl as $c2jl){
            //$totalcarryB30+=$c2jl->total_item;
      
      }
    }else{
      $totalcarryB30=0;
    }
    }

    

     
      $lv2=$level2s[1]['id'];

      $twohls=App\User::where('track',1)->where('role_id',3)->where('id','>',$lv2)->where('wings',$wings)->get();
      foreach($twohls as $t3){

                  $carr2ol=App\Order::where('user_id',$t3->id)->get();  
                  
                  foreach($carr2ol as $c2l){
               // $totalcarryA31+=$c2l->total_item;
            } 
          }
      
       $threers=App\User::where('track',2)->where('wings',$wings)->where('role_id',3)->where('id','>',$lv2)->get();
       foreach($threers as $t4){

          $carr3r=App\Order::where('user_id',$t4->id)->get();  
                  foreach($carr3r as $c3r){
              // $totalcarryB31+=$c3r->total_item;
            } 
          }
      
     

      $lv3=$level2s[2]['id'];
      $twolds=App\User::where('wings',$wings)->where('track',1)->where('role_id',3)->where('id','>',$lv3)->get();
      foreach($twolds as $four3){

                  $carr2l=App\Order::where('user_id',$four3->id)->get();  
                  
                  foreach($carr2l as $c2l){
                  $totalcarryA32+=$c2l->total_item;
            } 
           
          }
      $threhers=App\User::where('wings',$wings)->where('track',2)->where('role_id',3)->where('id','>',$lv3)->get();
      foreach($threhers as $four4){

                  $carr3r=App\Order::where('user_id', $four4->id)->get();  
                  foreach($carr3r as $c3r){
                  $totalcarryB32+=$c3r->total_item;
            } 
          }
          
}

if($lvc>=4){

 
    $lv1=$level2s[0]['id'];
  
  
    
  
    $twols=App\User::where('track',1)->where('role_id',3)->where('id','>',$lv1)->where('wings',$wings)->get();
    foreach($twols as $r1){
  
               $carr2l=App\Order::where('user_id',$r1->id)->get();  
               if($carr2l){  
  
               foreach($carr2l as $c2l){
     $totalcarryA30+=$c2l->total_item;
         } 
        }
         else{
          $totalcarryA30=0;
         }
        
    }
   
   
   $twolks=App\User::where('track',2)->where('role_id',3)->where('id','>',$lv1)->where('wings',$wings)->get();
   foreach($twolks as $r2){
  
               $carr2jl=App\Order::where('user_id',$r2->id)->get();  
               if($carr2jl){  
               foreach($carr2jl as $c2jl){
              //$totalcarryB30+=$c2jl->total_item;
        
        }
      }else{
        $totalcarryB30=0;
      }
      }
  
      
  
      
        $lv2=$level2s[1]['id'];
  
        $twohls=App\User::where('track',1)->where('role_id',3)->where('id','>',$lv2)->where('wings',$wings)->get();
        foreach($twohls as $t3){
  
                    $carr2ol=App\Order::where('user_id',$t3->id)->get();  
                    
                    foreach($carr2ol as $c2l){
                  //$totalcarryA31+=$c2l->total_item;
              } 
            }
        
         $threers=App\User::where('track',2)->where('wings',$wings)->where('role_id',3)->where('id','>',$lv2)->get();
         foreach($threers as $t4){
  
            $carr3r=App\Order::where('user_id',$t4->id)->get();  
                    foreach($carr3r as $c3r){
                // $totalcarryB31+=$c3r->total_item;
              } 
            }
        
       
  
        $lv3=$level2s[2]['id'];
        $twolds=App\User::where('wings',$wings)->where('track',1)->where('role_id',3)->where('id','>',$lv3)->get();
        foreach($twolds as $four3){
  
                    $carr2l=App\Order::where('user_id',$four3->id)->get();  
                    
                    foreach($carr2l as $c2l){
                    //$totalcarryA32+=$c2l->total_item;
              } 
             
            }
        $threhers=App\User::where('wings',$wings)->where('track',2)->where('role_id',3)->where('id','>',$lv3)->get();
        foreach($threhers as $four4){
  
                    $carr3r=App\Order::where('user_id', $four4->id)->get();  
                    foreach($carr3r as $c3r){
                   // $totalcarryB32+=$c3r->total_item;
              } 
            }
      $lv4=$level2s[3]['id'];
      $twoldks=App\User::where('role_id',3)->where('id','>',$lv4)->where('wings',$wings)->where('track',1)->get();
foreach($twoldks as $four){
                  $carr2l=App\Order::where('user_id', $four->id)->get();  
                  
                  foreach($carr2l as $c2l){
                 $totalcarryA33+=$c2l->total_item;
            } 
          }      
      
      
      
      $threerds=App\User::where('role_id',3)->where('id','>',$lv4)->where('wings',$wings)->where('track',2)->get();
      foreach($threerds as $four2){

                  $carr3r=App\Order::where('user_id',$four2->id)->get();  
                  foreach($carr3r as $c3r){
                  $totalcarryB33+=$c3r->total_item;
            } 
          }

}

        




 $totalA= $totalcarryA+$totalcarryB;

 $totalB=$totalcarry2A+$totalcarry2B;
 $totalcarryA33=0;


//echo $me->level;

 if($me->track==2 && $level1==3){
  $totalcarryB=0;
  //$totalcarry2A=0;

  $totalcarryA=0;
  $totalcarryA30=0;

}
if($me->track==1 && $level1==3){
  $totalcarryB=0;
  $totalcarry2B=0;
  $totalcarryA33=0;
  $totalcarryB33=0;

  //$totalcarryA=0;
 }

if($me->track==2 && $level1==4){
 $totalcarryB=0;
  $totalcarryA=0;

}
if($me->track==1 && $level1==4){
   $totalcarry2B=0;
   $totalcarryA=0;
 }
if($me->level==3 && $id=='2015'){
  $totalB1=0;
  $totalcarry2A=0;
  $totalcarry2B=0;

}
if($me->level==3 && $id=='2016'){
  $totalA1=0;

  $totalB1=0;
  $totalcarry2A=0;
  $totalcarry2B=0;
    $levelone1 = app\User::orderBy('created_at','asc')->where('level',$level1)->where('wings',$wings)->where('track',1)->skip(2)->first();
      $levelone2 = app\User::orderBy('created_at','asc')->where('level',$level1)->where('track',2)->where('wings',$wings)->skip(2)->first();
    
    
   
  
  

}
if($me->level==3 && $id=='2011'){
  $totalcarryA=1;
  
}
if($me->level==3 && $id=='2017'){
  //$totalA1=1;
  $totalcarry2B=0;
  
    $levelone1 = app\User::orderBy('created_at','asc')->where('level',$level1)->where('wings',$wings)->where('track',1)->skip(4)->first();
      $levelone2 = app\User::orderBy('created_at','asc')->where('level',$level1)->where('track',2)->where('wings',$wings)->skip(4)->first();
      
      
      
    
 
}
if($me->level==4 &&  $id=='2025'){
  $totalB1=0;
  
}
if($me->level==4 &&  $id=='2024'){
  $totalA1=0;
  
}
if($me->level==4 && $id=='2020'){
  $totalB1=0;
  
}

  

			    ?>
            <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-info">
                <h3 class="widget-user-username">{{$me->first_name}} {{$me->last_name}}</h3>
                <h5 class="widget-user-desc">Seller ID:<strong>{{$id}}</strong></h5>

              </div>
              <div class="widget-user-image">
                <img class="img-circle elevation-2" src="{{ asset('backend/img/tree.png')}}" alt="User Avatar">
              </div>

              <div class="card-footer">
                <div class="row">
                <div class="col-sm-12">
                    <div class="description-block">
                    <h6 >PCN:<strong>{{$me->pcn}}</strong></h6>
<h6>Designation: <?php if($me->grade){ echo "MSP";}?> {{$me->grade}}</h6>
<h6>Total Matching:{{$me->matches}}</h6>
                    </div>
</div>
                 
                  <!-- /.col -->
                  <div class="col-sm-6 border-right">
                    <div class="description-block">
                      <h5 class="description-header">{{$totalA1*150}}</h5>
                      <span class="description-text">Team A Carry</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-6">
                    <div class="description-block">
                      <h5 class="description-header">{{$totalB1*150}}</h5>
                      <span class="description-text">Team B Carry</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
            <!-- /.widget-user -->
          </div>

         
              </div>
              <?php
              if($levelone1){
?>

          <div class="col-md-6 col-sm-6 col-6" style="text-align:center;">
             
            <!-- Widget: user widget style 1 -->
            <a href="{{ route('backend.tree.index',$levelone1->seller_id) }}">    <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-info">
                <h3 class="widget-user-username">{{$levelone1->first_name}} {{$levelone1->last_name}}</h3>
                <h5 class="widget-user-desc">Seller ID:<strong>{{$levelone1->seller_id}}</strong></h5>

              </div>
              <div class="widget-user-image">
                <img class="img-circle elevation-2" src="{{ asset('backend/img/tree.png')}}" alt="User Avatar">
              </div>

              <div class="card-footer">
                <div class="row">
                <div class="col-sm-12">
                    <div class="description-block">
                    <h6 >PCN:<strong>{{$levelone1->pcn}}</strong></h6>
<h6>Designation: <?php if($levelone1->grade){ echo "MSP";}?> {{$levelone1->grade}}</h6>
<h6>Total Matching:{{$levelone1->matches}}</h6>
<h6>Refference ID:{{$levelone1->ref_id}}</h6>

                    </div>
</div>
                 
                  <!-- /.col -->
                  <div class="col-sm-6 border-right">
                    <div class="description-block">
                      <h5 class="description-header">{{ $totalcarryA*150}}</h5>
                      <span class="description-text">Team A Carry</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-6">
                    <div class="description-block">
                      <h5 class="description-header">{{$totalcarryB*150}}</h5>
                      <span class="description-text">Team B Carry</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div></a>
            <!-- /.widget-user -->

              </div>
              <?php } ?>


<!--2-->
<?php
if($levelone2){
?>
              <div class="col-md-6 col-sm-6 col-6" style="text-align:center;float:right">
             
             <!-- Widget: user widget style 1 -->
             <a href="{{ route('backend.tree.index',$levelone2->seller_id) }}">      <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-info">
                <h3 class="widget-user-username">{{$levelone2->first_name}} {{$levelone2->last_name}}</h3>
                <h5 class="widget-user-desc">Seller ID:<strong>{{$levelone2->seller_id}}</strong></h5>

              </div>
              <div class="widget-user-image">
                <img class="img-circle elevation-2" src="{{ asset('backend/img/tree.png')}}" alt="User Avatar">
              </div>

              <div class="card-footer">
                <div class="row">
                <div class="col-sm-12">
                    <div class="description-block">
                    <h6 >PCN:<strong>{{$levelone2->pcn}}</strong></h6>
<h6>Designation: <?php if($levelone2->grade){ echo "MSP";}?> {{$levelone2->grade}}</h6>
<h6>Total Matching:{{$levelone2->matches}}</h6>
<h6>Refference ID:{{$levelone2->ref_id}}</h6>
                   </div>
</div>
                 
                  <!-- /.col -->
                  <div class="col-sm-6 border-right">
                    <div class="description-block">
                      <h5 class="description-header">{{$totalcarry2A*150}}</h5>
                      <span class="description-text">Team A Carry</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-6">
                    <div class="description-block">
                      <h5 class="description-header">{{$totalcarry2B*150}}</h5>
                      <span class="description-text">Team B Carry</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div><a>
            <!-- /.widget-user -->
              </div>

<?php
}
if(!$level2s->isEmpty()){

  if($lvc==1)
{
?>
              


              <div class="col-md-3 col-sm-3 col-3" style="text-align:center;">
            
           <a href="{{ route('backend.tree.index',$level2s[0]['seller_id']) }}">   <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-info">
                <h3 class="widget-user-username">{{$level2s[0]['first_name']}} {{$level2s[0]['last_name']}}</h3>
                <h5 class="widget-user-desc">Seller ID:<strong>{{$level2s[0]['seller_id']}}</strong></h5>

              </div>
              <div class="widget-user-image">
                <img class="img-circle elevation-2" src="{{ asset('backend/img/tree.png')}}" alt="User Avatar">
              </div>

              <div class="card-footer">
                <div class="row">
                <div class="col-sm-12">
                    <div class="description-block">
                    <h6 >PCN:<strong>{{$level2s[0]['pcn']}}</strong></h6>
<h6>Designation: <?php if($level2s[0]['grade']){ echo "MSP";}?> {{$level2s[0]['grade']}}</h6>
<h6>Total Matching:{{$level2s[0]['matches']}}</h6>
<h6>Refference ID:{{$level2s[0]['ref_id']}}</h6>

                    </div>
</div>
                 
                  <!-- /.col -->
                  <div class="col-sm-6 border-right">
                    <div class="description-block">
                      <h5 class="description-header">
                      {{$totalcarryA30*150}}
                 </h5>
                      <span class="description-text">Team A Carry</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-6">
                    <div class="description-block">
                      <h5 class="description-header">
                      
                      {{$totalcarryB30*150}}
                   </h5>
                      <span class="description-text">Team B Carry</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div></a>
            <!-- /.widget-user -->
              </div>
              
            

<!--2-->
<?php
}
     if($lvc==2){

?>

<div class="col-md-3 col-sm-3 col-3" style="text-align:center;">
            
            <a href="{{ route('backend.tree.index',$level2s[0]['seller_id']) }}">   <div class="card card-widget widget-user">
               <!-- Add the bg color to the header using any of the bg-* classes -->
               <div class="widget-user-header bg-info">
                 <h3 class="widget-user-username">{{$level2s[0]['first_name']}} {{$level2s[0]['last_name']}}</h3>
                 <h5 class="widget-user-desc">Seller ID:<strong>{{$level2s[0]['seller_id']}}</strong></h5>
 
               </div>
               <div class="widget-user-image">
                 <img class="img-circle elevation-2" src="{{ asset('backend/img/tree.png')}}" alt="User Avatar">
               </div>
 
               <div class="card-footer">
                 <div class="row">
                 <div class="col-sm-12">
                     <div class="description-block">
                     <h6 >PCN:<strong>{{$level2s[0]['pcn']}}</strong></h6>
 <h6>Designation: <?php if($level2s[0]['grade']){ echo "MSP";}?> {{$level2s[0]['grade']}}</h6>
 <h6>Total Matching:{{$level2s[0]['matches']}}</h6>
 <h6>Refference ID:{{$level2s[0]['ref_id']}}</h6>
 
                     </div>
 </div>
                  
                   <!-- /.col -->
                   <div class="col-sm-6 border-right">
                     <div class="description-block">
                       <h5 class="description-header">
                       {{$totalcarryA30*150}}
                  </h5>
                       <span class="description-text">Team A Carry</span>
                     </div>
                     <!-- /.description-block -->
                   </div>
                   <!-- /.col -->
                   <div class="col-sm-6">
                     <div class="description-block">
                       <h5 class="description-header">
                       
                       {{$totalcarryB30*150}}
                    </h5>
                       <span class="description-text">Team B Carry</span>
                     </div>
                     <!-- /.description-block -->
                   </div>
                   <!-- /.col -->
                 </div>
                 <!-- /.row -->
               </div>
             </div></a>
             <!-- /.widget-user -->
               </div>
<div class="col-md-3 col-sm-3 col-3" style="text-align:center;">
            
           <a href="{{ route('backend.tree.index',$level2s[1]['seller_id']) }}">   <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-info">
                <h3 class="widget-user-username">{{$level2s[1]['first_name']}} {{$level2s[1]['last_name']}}</h3>
                <h5 class="widget-user-desc">Seller ID:<strong>{{$level2s[1]['seller_id']}}</strong></h5>

              </div>
              <div class="widget-user-image">
                <img class="img-circle elevation-2" src="{{ asset('backend/img/tree.png')}}" alt="User Avatar">
              </div>

              <div class="card-footer">
                <div class="row">
                <div class="col-sm-12">
                    <div class="description-block">
                    <h6 >PCN:<strong>{{$level2s[1]['pcn']}}</strong></h6>
<h6>Designation: <?php if($level2s[1]['grade']){ echo "MSP";}?> {{$level2s[1]['grade']}}</h6>
<h6>Total Matching:{{$level2s[1]['matches']}}</h6>
<h6>Refference ID:{{$level2s[1]['ref_id']}}</h6>

                    </div>
</div>
                 
                  <!-- /.col -->
                  <div class="col-sm-6 border-right">
                    <div class="description-block">
                      <h5 class="description-header">
                      {{$totalcarryA31*150}}
                 </h5>
                      <span class="description-text">Team A Carry</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-6">
                    <div class="description-block">
                      <h5 class="description-header">
                      
                      {{$totalcarryB31*150}}
                   </h5>
                      <span class="description-text">Team B Carry</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div></a>
            <!-- /.widget-user -->
              </div>
              <!--3-->
              <?php } 

if($lvc==3){
?>
<div class="col-md-3 col-sm-3 col-3" style="text-align:center;">
            
            <a href="{{ route('backend.tree.index',$level2s[0]['seller_id']) }}">   <div class="card card-widget widget-user">
               <!-- Add the bg color to the header using any of the bg-* classes -->
               <div class="widget-user-header bg-info">
                 <h3 class="widget-user-username">{{$level2s[0]['first_name']}} {{$level2s[0]['last_name']}}</h3>
                 <h5 class="widget-user-desc">Seller ID:<strong>{{$level2s[0]['seller_id']}}</strong></h5>
 
               </div>
               <div class="widget-user-image">
                 <img class="img-circle elevation-2" src="{{ asset('backend/img/tree.png')}}" alt="User Avatar">
               </div>
 
               <div class="card-footer">
                 <div class="row">
                 <div class="col-sm-12">
                     <div class="description-block">
                     <h6 >PCN:<strong>{{$level2s[0]['pcn']}}</strong></h6>
 <h6>Designation: <?php if($level2s[0]['grade']){ echo "MSP";}?> {{$level2s[0]['grade']}}</h6>
 <h6>Total Matching:{{$level2s[0]['matches']}}</h6>
 <h6>Refference ID:{{$level2s[0]['ref_id']}}</h6>
 
                     </div>
 </div>
                  
                   <!-- /.col -->
                   <div class="col-sm-6 border-right">
                     <div class="description-block">
                       <h5 class="description-header">
                       {{$totalcarryA30*150}}
                  </h5>
                       <span class="description-text">Team A Carry</span>
                     </div>
                     <!-- /.description-block -->
                   </div>
                   <!-- /.col -->
                   <div class="col-sm-6">
                     <div class="description-block">
                       <h5 class="description-header">
                       
                       {{$totalcarryB30*150}}
                    </h5>
                       <span class="description-text">Team B Carry</span>
                     </div>
                     <!-- /.description-block -->
                   </div>
                   <!-- /.col -->
                 </div>
                 <!-- /.row -->
               </div>
             </div></a>
             <!-- /.widget-user -->
               </div>

<div class="col-md-3 col-sm-3 col-3" style="text-align:center;">
            
           <a href="{{ route('backend.tree.index',$level2s[1]['seller_id']) }}">   <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-info">
                <h3 class="widget-user-username">{{$level2s[1]['first_name']}} {{$level2s[1]['last_name']}}</h3>
                <h5 class="widget-user-desc">Seller ID:<strong>{{$level2s[1]['seller_id']}}</strong></h5>

              </div>
              <div class="widget-user-image">
                <img class="img-circle elevation-2" src="{{ asset('backend/img/tree.png')}}" alt="User Avatar">
              </div>

              <div class="card-footer">
                <div class="row">
                <div class="col-sm-12">
                    <div class="description-block">
                    <h6 >PCN:<strong>{{$level2s[1]['pcn']}}</strong></h6>
<h6>Designation: <?php if($level2s[1]['grade']){ echo "MSP";}?> {{$level2s[1]['grade']}}</h6>
<h6>Total Matching:{{$level2s[1]['matches']}}</h6>
<h6>Refference ID:{{$level2s[1]['ref_id']}}</h6>

                    </div>
</div>
                 
                  <!-- /.col -->
                  <div class="col-sm-6 border-right">
                    <div class="description-block">
                      <h5 class="description-header">
                      {{$totalcarryA31*150}}
                 </h5>
                      <span class="description-text">Team A Carry</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-6">
                    <div class="description-block">
                      <h5 class="description-header">
                      
                      {{$totalcarryB31*150}}
                   </h5>
                      <span class="description-text">Team B Carry</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div></a>
            <!-- /.widget-user -->
              </div>
<div class="col-md-3 col-sm-3 col-3" style="text-align:center;">
            
           <a href="{{ route('backend.tree.index',$level2s[2]['seller_id']) }}">   <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-info">
                <h3 class="widget-user-username">{{$level2s[2]['first_name']}} {{$level2s[2]['last_name']}}</h3>
                <h5 class="widget-user-desc">Seller ID:<strong>{{$level2s[2]['seller_id']}}</strong></h5>

              </div>
              <div class="widget-user-image">
                <img class="img-circle elevation-2" src="{{ asset('backend/img/tree.png')}}" alt="User Avatar">
              </div>

              <div class="card-footer">
                <div class="row">
                <div class="col-sm-12">
                    <div class="description-block">
                    <h6 >PCN:<strong>{{$level2s[2]['pcn']}}</strong></h6>
<h6>Designation: <?php if($level2s[2]['grade']){ echo "MSP";}?> {{$level2s[2]['grade']}}</h6>
<h6>Total Matching:{{$level2s[2]['matches']}}</h6>
<h6>Refference ID:{{$level2s[2]['ref_id']}}</h6>

                    </div>
</div>
                 
                  <!-- /.col -->
                  <div class="col-sm-6 border-right">
                    <div class="description-block">
                      <h5 class="description-header">
                      {{$totalcarryA32*150}}
                 </h5>
                      <span class="description-text">Team A Carry</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-6">
                    <div class="description-block">
                      <h5 class="description-header">
                      
                      {{$totalcarryB32*150}}
                   </h5>
                      <span class="description-text">Team B Carry</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div></a>
            <!-- /.widget-user -->
              </div>
<!--4-->
<?php }
if($lvc>=4){



?>
<div class="col-md-3 col-sm-3 col-3" style="text-align:center;">
            
            <a href="{{ route('backend.tree.index',$level2s[0]['seller_id']) }}">   <div class="card card-widget widget-user">
               <!-- Add the bg color to the header using any of the bg-* classes -->
               <div class="widget-user-header bg-info">
                 <h3 class="widget-user-username">{{$level2s[0]['first_name']}} {{$level2s[0]['last_name']}}</h3>
                 <h5 class="widget-user-desc">Seller ID:<strong>{{$level2s[0]['seller_id']}}</strong></h5>
 
               </div>
               <div class="widget-user-image">
                 <img class="img-circle elevation-2" src="{{ asset('backend/img/tree.png')}}" alt="User Avatar">
               </div>
 
               <div class="card-footer">
                 <div class="row">
                 <div class="col-sm-12">
                     <div class="description-block">
                     <h6 >PCN:<strong>{{$level2s[0]['pcn']}}</strong></h6>
 <h6>Designation: <?php if($level2s[0]['grade']){ echo "MSP";}?> {{$level2s[0]['grade']}}</h6>
 <h6>Total Matching:{{$level2s[0]['matches']}}</h6>
 <h6>Refference ID:{{$level2s[0]['ref_id']}}</h6>
 
                     </div>
 </div>
                  
                   <!-- /.col -->
                   <div class="col-sm-6 border-right">
                     <div class="description-block">
                       <h5 class="description-header">
                       {{$totalcarryA30*150}}
                  </h5>
                       <span class="description-text">Team A Carry</span>
                     </div>
                     <!-- /.description-block -->
                   </div>
                   <!-- /.col -->
                   <div class="col-sm-6">
                     <div class="description-block">
                       <h5 class="description-header">
                       
                       {{$totalcarryB30*150}}
                    </h5>
                       <span class="description-text">Team B Carry</span>
                     </div>
                     <!-- /.description-block -->
                   </div>
                   <!-- /.col -->
                 </div>
                 <!-- /.row -->
               </div>
             </div></a>
             <!-- /.widget-user -->
               </div>

<div class="col-md-3 col-sm-3 col-3" style="text-align:center;">
            
           <a href="{{ route('backend.tree.index',$level2s[1]['seller_id']) }}">   <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-info">
                <h3 class="widget-user-username">{{$level2s[1]['first_name']}} {{$level2s[1]['last_name']}}</h3>
                <h5 class="widget-user-desc">Seller ID:<strong>{{$level2s[1]['seller_id']}}</strong></h5>

              </div>
              <div class="widget-user-image">
                <img class="img-circle elevation-2" src="{{ asset('backend/img/tree.png')}}" alt="User Avatar">
              </div>

              <div class="card-footer">
                <div class="row">
                <div class="col-sm-12">
                    <div class="description-block">
                    <h6 >PCN:<strong>{{$level2s[1]['pcn']}}</strong></h6>
<h6>Designation: <?php if($level2s[1]['grade']){ echo "MSP";}?> {{$level2s[1]['grade']}}</h6>
<h6>Total Matching:{{$level2s[1]['matches']}}</h6>
<h6>Refference ID:{{$level2s[1]['ref_id']}}</h6>

                    </div>
</div>
                 
                  <!-- /.col -->
                  <div class="col-sm-6 border-right">
                    <div class="description-block">
                      <h5 class="description-header">
                      {{$totalcarryA31*150}}
                 </h5>
                      <span class="description-text">Team A Carry</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-6">
                    <div class="description-block">
                      <h5 class="description-header">
                      
                      {{$totalcarryB31*150}}
                   </h5>
                      <span class="description-text">Team B Carry</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div></a>
            <!-- /.widget-user -->
              </div>

<div class="col-md-3 col-sm-3 col-3" style="text-align:center;">
            
           <a href="{{ route('backend.tree.index',$level2s[2]['seller_id']) }}">   <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-info">
                <h3 class="widget-user-username">{{$level2s[2]['first_name']}} {{$level2s[2]['last_name']}}</h3>
                <h5 class="widget-user-desc">Seller ID:<strong>{{$level2s[2]['seller_id']}}</strong></h5>

              </div>
              <div class="widget-user-image">
                <img class="img-circle elevation-2" src="{{ asset('backend/img/tree.png')}}" alt="User Avatar">
              </div>

              <div class="card-footer">
                <div class="row">
                <div class="col-sm-12">
                    <div class="description-block">
                    <h6 >PCN:<strong>{{$level2s[2]['pcn']}}</strong></h6>
<h6>Designation: <?php if($level2s[2]['grade']){ echo "MSP";}?> {{$level2s[2]['grade']}}</h6>
<h6>Total Matching:{{$level2s[2]['matches']}}</h6>
<h6>Refference ID:{{$level2s[2]['ref_id']}}</h6>

                    </div>
</div>
                 
                  <!-- /.col -->
                  <div class="col-sm-6 border-right">
                    <div class="description-block">
                      <h5 class="description-header">
                      {{$totalcarryA32*150}}
                 </h5>
                      <span class="description-text">Team A Carry</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-6">
                    <div class="description-block">
                      <h5 class="description-header">
                      
                      {{$totalcarryB32*150}}
                   </h5>
                      <span class="description-text">Team B Carry</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div></a>
            <!-- /.widget-user -->
              </div>

<div class="col-md-3 col-sm-3 col-3" style="text-align:center;">
            
           <a href="{{ route('backend.tree.index',$level2s[3]['seller_id']) }}">   <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-info">
                <h3 class="widget-user-username">{{$level2s[3]['first_name']}} {{$level2s[3]['last_name']}}</h3>
                <h5 class="widget-user-desc">Seller ID:<strong>{{$level2s[3]['seller_id']}}</strong></h5>

              </div>
              <div class="widget-user-image">
                <img class="img-circle elevation-2" src="{{ asset('backend/img/tree.png')}}" alt="User Avatar">
              </div>

              <div class="card-footer">
                <div class="row">
                <div class="col-sm-12">
                    <div class="description-block">
                    <h6 >PCN:<strong>{{$level2s[3]['pcn']}}</strong></h6>
<h6>Designation: <?php if($level2s[3]['grade']){ echo "MSP";}?> {{$level2s[3]['grade']}}</h6>
<h6>Total Matching:{{$level2s[3]['matches']}}</h6>
<h6>Refference ID:{{$level2s[3]['ref_id']}}</h6>

                    </div>
</div>
                 
                  <!-- /.col -->
                  <div class="col-sm-6 border-right">
                    <div class="description-block">
                      <h5 class="description-header">
                      {{$totalcarryA33*150}}
                 </h5>
                      <span class="description-text">Team A Carry</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-6">
                    <div class="description-block">
                      <h5 class="description-header">
                      
                      {{$totalcarryB33*150}}
                   </h5>
                      <span class="description-text">Team B Carry</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div></a>
            <!-- /.widget-user -->
              </div>

<?php } }?>
                  
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
     
		



@endsection

@push('scripts')
<!-- DataTables -->
  <script src="{{ asset('backend/plugins/datatables/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
<!-- Sweetalert2 -->
  <script src="{{ asset('backend/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
  <!-- page script -->
  <script>
    $(function () {
      $("#datatable").DataTable();
    });

    function deleteRole(id){
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.value) {
          event.preventDefault();
          $('#delete-form-'+id).submit();
          Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
          )
        }
      })
    }
  </script>
@endpush