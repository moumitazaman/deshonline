<?php

namespace App\Http\Controllers\Backend;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\AttributesValue;
use App\Product;
use App\User;
use App\Admin;
use App\Category;
use App\Order;
use App\OrderDetails;
use App\UserTree;

use Auth;
class TreeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         
    }

    public function treeView(){

        $id=2000;
        $i=0;
        $totalA=0;

        $totalB=0;
        $totalA1=0;

        $totalB1=0;
        $totalA2=0;

        $totalB2=0;
        $totalA3=0;
        $totalB3=0;
        $totalA32=0;
        $totalB32=0;
        $totalA323=0;
        $totalB323=0;
        $totalA3r=0;
        $totalB3r=0;
        $totalA32r=0;
        $totalB32r=0;
        $totalA323r=0;
        $totalB323r=0;
        $me = User::latest()->where('seller_id',$id)->first();
        $l1=UserTree::where('wings','left')->whereIn('depth',[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50])->get();
          
foreach($l1 as $rt){
                  $car=User::where('seller_id',$rt->seller_id)->get();  
                  foreach($car as $r){
                 $totalA+=$r->carry;
            } 
}
$l2=UserTree::where('wings','right')->whereIn('depth',[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50])->get();
          
foreach($l2 as $rt1){
                  $car1=User::where('seller_id',$rt1->seller_id)->get();  
                  foreach($car1 as $r1){
                 $totalB+=$r1->carry;
            } 
}
        $levelone1 = User::orderBy('created_at','asc')->where('level',1)->where('wings','left')->first();
$pos=UserTree::where('seller_id',$levelone1->seller_id)->first();
$poscount=DB::table('user_trees')->distinct()->count('level');
$n=$pos->depth;
$posc=$poscount-$n-1;
$lefts1=UserTree::where('wings','left')->whereIn('depth',[2,4,5,8,9,10,11])->get();
          
foreach($lefts1 as $rths){
                  $carrer=User::where('seller_id',$rths->seller_id)->get();  
                  foreach($carrer as $rce){
                 $totalA1+=$rce->carry;
            } 
}
$lefts2=UserTree::where('wings','left')->whereIn('depth',[3,6,7,12,13,14,15])->get();
          
foreach($lefts2 as $rths1){
                  $carrer1=User::where('seller_id',$rths1->seller_id)->get();  
                  foreach($carrer1 as $rce1){
                 $totalB1+=$rce1->carry;
            } 
}
        $levelone2 = User::orderBy('created_at','asc')->where('level',1)->where('wings','right')->first();
        $rights1=UserTree::where('wings','right')->whereIn('depth',[2,4,5,8,9,10,11])->get();
          
        foreach($rights1 as $rths){
                          $carrer=User::where('seller_id',$rths->seller_id)->get();  
                          foreach($carrer as $rce){
                         $totalA2+=$rce->carry;
                    } 
        }
        $rights2=UserTree::where('wings','right')->whereIn('depth',[3,6,7,12,13,14,15])->get();
                  
        foreach($rights2 as $rths1){
                          $carrer1=User::where('seller_id',$rths1->seller_id)->get();  
                          foreach($carrer1 as $rce1){
                         $totalB2+=$rce1->carry;
                    } 
        }
                    $lvl2s1=UserTree::where('depth',2)->where('wings','left')->first();
                $lvl2s2=UserTree::where('depth',3)->where('wings','left')->first();
                $lvl2s3=UserTree::where('depth',2)->where('wings','right')->first();
                $lvl2s4=UserTree::where('depth',3)->where('wings','right')->first();
                
                if($lvl2s1){
                                                                    $level2s1=User::orderBy('created_at','asc')->where('seller_id',$lvl2s1->seller_id)->where('role_id',3)->first();

                   
                   
                }
                else{
 $level2s1=0;
                }
                if($lvl2s2){
                  $level2s1=User::orderBy('created_at','asc')->where('seller_id',$lvl2s1->seller_id)->where('role_id',3)->first();

                                              $level2s2=User::orderBy('created_at','asc')->where('seller_id',$lvl2s2->seller_id)->where('role_id',3)->first();
  
                }
                else{
                     $level2s2=0;                                               
                }
               if($lvl2s3){
                   $level2s1=User::orderBy('created_at','asc')->where('seller_id',$lvl2s1->seller_id)->where('role_id',3)->first();

                                              $level2s2=User::orderBy('created_at','asc')->where('seller_id',$lvl2s2->seller_id)->where('role_id',3)->first();
  
                                              $level2s3=User::orderBy('created_at','asc')->where('seller_id',$lvl2s3->seller_id)->where('role_id',3)->first();
  
               }
               else{
                  $level2s3=0;
               }
                if($lvl2s4){
                     $level2s1=User::orderBy('created_at','asc')->where('seller_id',$lvl2s1->seller_id)->where('role_id',3)->first();

                                              $level2s2=User::orderBy('created_at','asc')->where('seller_id',$lvl2s2->seller_id)->where('role_id',3)->first();
  
                                              $level2s3=User::orderBy('created_at','asc')->where('seller_id',$lvl2s3->seller_id)->where('role_id',3)->first();
                   
                            $level2s4=User::orderBy('created_at','asc')->where('seller_id',$lvl2s4->seller_id)->where('role_id',3)->first();
                   
  
                }
                else{
                                      
$level2s4=0;
                }







        return view('backend.tree.newtree',['totalB' =>$totalB,'totalA' =>$totalA,'totalB323' =>$totalB323r,'totalA323' =>$totalA323r,'totalB32r' =>$totalB32r,'totalA32r' =>$totalA32r,'totalB3r' =>$totalB3r,'totalA3r' =>$totalA3r,'totalB323' =>$totalB323,'totalA323' =>$totalA323,'totalB32' =>$totalB32,'totalA32' =>$totalA32,'totalB3' =>$totalB3,'totalA3' =>$totalA3,'totalA2' =>$totalA2,'totalB2' =>$totalB2,'totalA1' =>$totalA1,'totalB1' =>$totalB1,'id' => $id,'me' => $me,'levelone1'=>$levelone1,'levelone2'=>$levelone2,'level2s4'=>$level2s4,'level2s3'=>$level2s3,'level2s2'=>$level2s2,'level2s1'=>$level2s1]);


    }

    

   



    public function treeDisplay($id){
        $totalA=0;

        $totalB=0;
        $totalA1=0;

        $totalB1=0;
        $totalA2=0;

        $totalB2=0;
        $totalA3=0;
        $totalB3=0;
        $totalA32=0;
        $totalB32=0;
        $totalA33=0;
        $totalB33=0;
        $totalA34=0;
        $totalB34=0;
        
        $totalA3r=0;
        $totalB3r=0;
        $totalA32r=0;
        $totalB32r=0;
        $totalA323r=0;
        $totalB323r=0;
        $pos=UserTree::where('seller_id',$id)->first();
        $n=$pos->depth;
        $n1=$n*2;
        $n2=2*$n+1;
        $n11=$n1*2;
        $n12=2*$n1+1;
        $n13=$n2*2;
        $n14=2*$n2+1;

        $me = User::latest()->where('seller_id',$id)->first();
        $level1=$me->level+1;
        $wing=$me->wings;
       
           // if($wing=='left'){
            if($n==1){
$l0set1=[2,4,5,8,9,10,11];
$l0set2=[3,6,7,12,13,14,15];

$l1set1=[4,8,9,16,17,18,19];
$l1set2=[5,10,11,20,21,22,23];
$l1set3=[6,12,13,24,25,26,27];
$l1set4=[7,14,15,28,29,30,31];

$l2set1=[8,16,17,32,33,34,35];
$l2set2=[9,18,19,36,37,38,39];
$l2set3=[10,20,21,40,41,42,43];
$l2set4=[11,22,23,44,45,46,47];
$l2set5=[12,24,25];
$l2set6=[13,26,27];
$l2set7=[14,28,29];
$l2set8=[15,30,31];
            }
            elseif($n==2){
                $l0set1=[4,8,9,16,17,18,19];
                $l0set2=[5,10,11,20,21,22,23];
                
                $l1set1=[8,16,17,32,33,34,35];
                $l1set2=[9,18,19,36,37,38,39];
                $l1set3=[10,20,21];
                $l1set4=[11,22,23];
                
                $l2set1=[16];
                $l2set2=[17];
                $l2set3=[18];
                $l2set4=[19];
                $l2set5=[20];
                $l2set6=[21];
                $l2set7=[22];
                $l2set8=[23];
                            }
                            elseif($n==3){
                                $l0set1=[6,12,13,24,25,26,27];
                                $l0set2=[7,14,15,28,29,30,31];
                                
                                $l1set1=[12,24,25,48,49];
                                $l1set2=[13,26,27];
                                $l1set3=[14,28,29];
                                $l1set4=[15,30,31];
                                
                                $l2set1=[24,48,49];
                                $l2set2=[25,50,51];
                                $l2set3=[26,52,53];
                                $l2set4=[27,54,55];
                                $l2set5=[28,56,57];
                                $l2set6=[29,58,59];
                                $l2set7=[30,60,61];
                                $l2set8=[31,62,63];
                                            }
                            elseif($n==4){
                                $l0set1=[8,16,17];
                                $l0set2=[9,18,19];
                                
                                $l1set1=[16,32,33];
                                $l1set2=[17,34,35];
                                $l1set3=[18,36,37];
                                $l1set4=[19,38,39];
                                
                                $l2set1=[32,64,65];
                                $l2set2=[33,66,67];
                                $l2set3=[34,68,69];
                                $l2set4=[35,70,71];
                                $l2set5=[36,72,73];
                                $l2set6=[37,74,75];
                                $l2set7=[38,76,77];
                                $l2set8=[39,78,79];
                                            }

                                            elseif($n==5){
                                                $l0set1=[10,20,21];
                                                $l0set2=[11,22,23];
                                                
                                                $l1set1=[20,40,41];
                                                $l1set2=[21,42,43];
                                                $l1set3=[22,44,45];
                                                $l1set4=[23,46,47];
                                                
                                                $l2set1=[40,80,81];
                                                $l2set2=[41,82,83];
                                                $l2set3=[42,84,85];
                                                $l2set4=[43,86,87];
                                                $l2set5=[44,88,89];
                                                $l2set6=[45,90,91];
                                                $l2set7=[46,92,93];
                                                $l2set8=[47,94,95];
                                                            }
                                                            elseif($n==6){
                                                                $l0set1=[12,24,25,48,49,50,51];
                                                                $l0set2=[13,26,27,52,53,54,55];
                                                                
                                                                $l1set1=[24,48,49];
                                                                $l1set2=[25,50,51];
                                                                $l1set3=[26,52,53];
                                                                $l1set4=[27,54,55];
                                                                
                                                                $l2set1=[48,96,97];
                                                                $l2set2=[49,98,99];
                                                                $l2set3=[50,100,101];
                                                                $l2set4=[51,102,103];
                                                                $l2set5=[52,104,105];
                                                                $l2set6=[53,106,107];
                                                                $l2set7=[54,108,109];
                                                                $l2set8=[45,110,111];
                                                                            }
                                                                            else{
                                                                                $l0set1=[($n*2),($n*2)*2,($n*2*2)+1];
                                                                $l0set2=[((2*$n)+1),(2*(2*$n)+1),(2*(2*$n)+1+1)];

                                                                $l1set1=[(($n*2)*2),(($n*2)*2*2),(($n*2)*2*2)+1];
                                                                $l1set2=[(($n*2*2)+1),(($n*2*2)+1)*2,((($n*2*2)+1)*2)+1];
                                                                $l1set3=[(2*(2*$n)+1),(2*(2*$n)+1)*2,((2*(2*$n)+1)*2)+1];
                                                                $l1set4=[(2*(2*$n)+1+1),(2*(2*$n)+1+1)*2,((2*(2*$n)+1+1)*2)+1];
                                                                
                                                                $l2set1=[(($n*2)*2*2),(($n*2)*2*2*2),(($n*2)*2*2*2)+1];
                                                                $l2set2=[(($n*2)*2*2)+1,(2*(($n*2)*2*2)+1)];
                                                                $l2set3=[(($n*2*2)+1)*2];
                                                                $l2set4=[((($n*2*2)+1)*2)+1];
                                                                $l2set5=[(2*(2*$n)+1)*2];
                                                                $l2set6=[((2*(2*$n)+1)*2)+1];
                                                                $l2set7=[(2*(2*$n)+1+1)*2];
                                                                $l2set8=[((2*(2*$n)+1+1)*2)+1];
                                                                

                                                                            }
                $lefts1=UserTree::where('wings',$me->wings)->whereIn('depth',$l0set1)->get();
          
foreach($lefts1 as $rths){
                  $carrer=User::where('seller_id',$rths->seller_id)->get();  
                  foreach($carrer as $rce){
                 $totalA+=$rce->carry;
            } 
}
$lefts2=UserTree::where('wings',$me->wings)->whereIn('depth',$l0set2)->get();
          
foreach($lefts2 as $rths1){
                  $carrer1=User::where('seller_id',$rths1->seller_id)->get();  
                  foreach($carrer1 as $rce1){
                 $totalB+=$rce1->carry;
            } 
}
$user1 = UserTree::where('depth',$n1)->where('wings',$me->wings)->first();
if($user1){

                $levelone1 = User::orderBy('created_at','asc')->where('seller_id',$user1->seller_id)->first();
                $lv2left=UserTree::where('wings',$me->wings)->whereIn('depth',$l1set1)->get();

                foreach($lv2left as $rthsl1){
                    $carrerl1=User::where('seller_id',$rthsl1->seller_id)->get();  
                    foreach($carrerl1 as $rcel1){
                   $totalA1+=$rcel1->carry;
              } 
        }
        $lv2right=UserTree::where('wings',$me->wings)->whereIn('depth',$l1set2)->get();
        
                foreach($lv2right as $rthsl2){
                    $carrerl2=User::where('seller_id',$rthsl2->seller_id)->get();  
                    foreach($carrerl2 as $rcel2){
                   $totalB1+=$rcel2->carry;
              } 
        }
    }else{
        $levelone1=0;
    }

        $user2 = UserTree::where('depth',$n2)->where('wings',$me->wings)->first();
        if($user2){

                $levelone2 = User::where('seller_id',$user2->seller_id)->where('wings',$me->wings)->first();
                $lv2left22=UserTree::where('wings',$me->wings)->whereIn('depth',$l1set3)->get();


                foreach($lv2left22 as $rthsl13){
        
                    $carrerl13=User::where('seller_id',$rthsl13->seller_id)->get();  
        
                    foreach($carrerl13 as $rcel13){
                   $totalA2+=$rcel13->carry;
              } 
        
        }
        
        $lv2right22=UserTree::where('wings',$me->wings)->whereIn('depth',$l1set4)->get();
        
                foreach($lv2right22 as $rthsl23){
                    $carrerl23=User::where('seller_id',$rthsl23->seller_id)->get();  
                    foreach($carrerl23 as $rcel23){
                   $totalB2+=$rcel23->carry;
              } 
        }}
        else{
            $levelone2=0;

        }
        //$level2s=User::orderBy('created_at','asc')->where('level',$level1+1)->where('wings',$me->wings)->where('role_id',3)->take(4)->get();
        $user3 = UserTree::where('depth',$n11)->where('wings',$me->wings)->first();

        if($user3){


        $leveltwo1 = User::where('seller_id',$user3->seller_id)->first();
        $lv1=UserTree::where('wings',$me->wings)->whereIn('depth',$l2set1)->get();

        foreach($lv1 as $r1){

            $carry1=User::where('seller_id',$r1->seller_id)->get();  

            foreach($carry1 as $rc1){
           $totalA3+=$rc1->carry;
      } 

}

$lv2=UserTree::where('wings',$me->wings)->whereIn('depth',$l2set2)->get();

        foreach($lv2 as $r2){
            $carry2=User::where('seller_id',$r2->seller_id)->get();  
            foreach($carry2 as $rc2){
           $totalB3+=$rc2->carry;
      } 
}
    }
    else{
        $leveltwo1=0;
    }

$user4 = UserTree::where('depth',$n12)->where('wings',$me->wings)->first();
if($user4){

$leveltwo2 = User::where('seller_id',$user4->seller_id)->first();
$lv3=UserTree::where('wings',$me->wings)->whereIn('depth',$l2set3)->get();


foreach($lv3 as $r3){

    $carry3=User::where('seller_id',$r3->seller_id)->get();  

    foreach($carry3 as $rc3){
   $totalA32+=$rc3->carry;
} 

}

$lv4=UserTree::where('wings',$me->wings)->whereIn('depth',$l2set4)->get();

foreach($lv4 as $r4){
    $carry4=User::where('seller_id',$r4->seller_id)->get();  
    foreach($carry4 as $rc4){
   $totalB32+=$rc4->carry;
} 
}
    }else{
        $leveltwo2=0;

    }
$user5 = UserTree::where('depth',$n13)->where('wings',$me->wings)->first();
if($user5){

$leveltwo3 = User::where('seller_id',$user5->seller_id)->first();
$lv5=UserTree::where('wings',$me->wings)->whereIn('depth',$l2set5)->get();


foreach($lv5 as $r5){

    $carry5=User::where('seller_id',$r5->seller_id)->get();  

    foreach($carry5 as $rc5){
   $totalA33+=$rc5->carry;
} 

}

$lv6=UserTree::where('wings',$me->wings)->whereIn('depth',$l2set6)->get();

foreach($lv6 as $r6){
    $carry6=User::where('seller_id',$r6->seller_id)->get();  
    foreach($carry6 as $rc6){
   $totalB33+=$rc6->carry;
} 
}
    }else{
        $leveltwo3=0;


    }
$user6 = UserTree::where('depth',$n14)->where('wings',$me->wings)->first();
if($user6){
$leveltwo4 = User::where('seller_id',$user6->seller_id)->first();
$lv7=UserTree::where('wings',$me->wings)->whereIn('depth',$l2set7)->get();


foreach($lv7 as $r7){

    $carry7=User::where('seller_id',$r7->seller_id)->get();  

    foreach($carry7 as $rc7){
   $totalA34+=$rc7->carry;
} 

}

$lv8=UserTree::where('wings',$me->wings)->whereIn('depth',$l2set8)->get();

foreach($lv8 as $r8){
    $carry8=User::where('seller_id',$r8->seller_id)->get();  
    foreach($carry8 as $rc8){
   $totalB34+=$rc8->carry;
} 
}
  
}else{
    $leveltwo4=0;
}
         /*       elseif($me->level==2){
                    $lefts1=UserTree::where('wings',$me->wings)->whereIn('depth',)->get();
              
    foreach($lefts1 as $rths){
                      $carrer=User::where('seller_id',$rths->seller_id)->get();  
                      foreach($carrer as $rce){
                     $totalA+=$rce->carry;
                } 
    }
    $lefts2=UserTree::where('wings',$me->wings)->whereIn('depth',[5,10,11,20,21,22,23])->get();
              
    foreach($lefts2 as $rths1){
                      $carrer1=User::where('seller_id',$rths1->seller_id)->get();  
                      foreach($carrer1 as $rce1){
                     $totalB+=$rce1->carry;
                } 
    }
                
    $user1 = UserTree::where('depth',$n1)->first();
    
                    $levelone1 = User::orderBy('created_at','asc')->where('seller_id',$user1->seller_id)->where('wings',$me->wings)->where('track',1)->first();
                    $lv2left=UserTree::where('wings',$me->wings)->whereIn('depth',[4,8,9,16,17,18,19])->get();
    
                    foreach($lv2left as $rthsl1){
                        $carrerl1=User::where('seller_id',$rthsl1->seller_id)->get();  
                        foreach($carrerl1 as $rcel1){
                       $totalA1+=$rcel1->carry;
                  } 
            }
            $lv2right=UserTree::where('wings',$me->wings)->whereIn('depth',[5,10,11,20,21,22,23])->get();
            
                    foreach($lv2right as $rthsl2){
                        $carrerl2=User::where('seller_id',$rthsl2->seller_id)->get();  
                        foreach($carrerl2 as $rcel2){
                       $totalB1+=$rcel2->carry;
                  } 
            }
    
            $user2 = UserTree::where('depth',$n2)->first();
    
                    $levelone2 = User::where('seller_id',$user2->seller_id)->where('level',$level1)->where('wings',$me->wings)->where('track',2)->first();
                    $lv2left22=UserTree::where('wings',$me->wings)->whereIn('depth',[6,12,13,24,25,26,27])->get();
    
    
                    foreach($lv2left22 as $rthsl13){
            
                        $carrerl13=User::where('seller_id',$rthsl13->seller_id)->get();  
            
                        foreach($carrerl13 as $rcel13){
                       $totalA2+=$rcel13->carry;
                  } 
            
            }
            
            $lv2right22=UserTree::where('wings',$me->wings)->whereIn('depth',[7,14,15,28,29,30,31])->get();
            
                    foreach($lv2right22 as $rthsl23){
                        $carrerl23=User::where('seller_id',$rthsl23->seller_id)->get();  
                        foreach($carrerl23 as $rcel23){
                       $totalB2+=$rcel23->carry;
                  } 
            }
            $level2s=User::orderBy('created_at','asc')->where('level',$level1+1)->where('wings',$me->wings)->where('role_id',3)->take(4)->get();

        }

         
        elseif($me->level==3){
            $lefts1=UserTree::where('wings',$me->wings)->whereIn('depth',[8,9,16,17,18,19])->get();
      
foreach($lefts1 as $rths){
              $carrer=User::where('seller_id',$rths->seller_id)->get();  
              foreach($carrer as $rce){
             $totalA+=$rce->carry;
        } 
}
$lefts2=UserTree::where('wings',$me->wings)->whereIn('depth',[10,11,20,21,22,23])->get();
      
foreach($lefts2 as $rths1){
              $carrer1=User::where('seller_id',$rths1->seller_id)->get();  
              foreach($carrer1 as $rce1){
             $totalB+=$rce1->carry;
        } 
}
        
$user1 = UserTree::where('depth',$n1)->first();

            $levelone1 = User::orderBy('created_at','asc')->where('seller_id',$user1->seller_id)->where('wings',$me->wings)->where('track',1)->first();
            $lv2left=UserTree::where('wings',$me->wings)->whereIn('depth',[16,17])->get();

            foreach($lv2left as $rthsl1){
                $carrerl1=User::where('seller_id',$rthsl1->seller_id)->get();  
                foreach($carrerl1 as $rcel1){
               $totalA1+=$rcel1->carry;
          } 
    }
    $lv2right=UserTree::where('wings',$me->wings)->whereIn('depth',[18,19])->get();
    
            foreach($lv2right as $rthsl2){
                $carrerl2=User::where('seller_id',$rthsl2->seller_id)->get();  
                foreach($carrerl2 as $rcel2){
               $totalB1+=$rcel2->carry;
          } 
    }

    $user2 = UserTree::where('depth',$n2)->first();

            $levelone2 = User::where('seller_id',$user2->seller_id)->where('level',$level1)->where('wings',$me->wings)->where('track',2)->first();
            $lv2left22=UserTree::where('wings',$me->wings)->whereIn('depth',[20,21])->get();


            foreach($lv2left22 as $rthsl13){
    
                $carrerl13=User::where('seller_id',$rthsl13->seller_id)->get();  
    
                foreach($carrerl13 as $rcel13){
               $totalA2+=$rcel13->carry;
          } 
    
    }
    
    $lv2right22=UserTree::where('wings',$me->wings)->whereIn('depth',[22,23])->get();
    
            foreach($lv2right22 as $rthsl23){
                $carrerl23=User::where('seller_id',$rthsl23->seller_id)->get();  
                foreach($carrerl23 as $rcel23){
               $totalB2+=$rcel23->carry;
          } 
    }
    $level2s=User::orderBy('created_at','asc')->where('level',$level1+1)->where('wings',$me->wings)->where('role_id',3)->take(4)->get();

}
                
            }
            elseif($wing=='right'){
            
                $levelone1 = User::orderBy('created_at','asc')->where('level',$level1)->where('wings',$me->wings)->where('track',1)->first();
            
                $levelone2 = User::orderBy('created_at','asc')->where('level',$level1)->where('wings',$me->wings)->where('track',2)->first();
            
                $level2s=User::orderBy('created_at','asc')->where('level',$level1+1)->where('wings',$me->wings)->where('role_id',3)->take(4)->get();
            
            }

        }
        elseif($me->level>=2){
if($wing=='left' && $me->track==1){
    $levelone1 = User::orderBy('created_at','asc')->where('level',$level1)->where('wings',$me->wings)->where('track',1)->first();

    $levelone2 = User::orderBy('created_at','asc')->where('level',$level1)->where('wings',$me->wings)->where('track',2)->first();

    $level2s=User::orderBy('created_at','asc')->where('level',$level1+1)->where('wings',$me->wings)->where('role_id',3)->take(4)->get();

}
elseif($wing=='left' && $me->track==2){

    $levelone1 = User::orderBy('created_at','asc')->where('level',$level1)->where('wings',$me->wings)->where('track',1)->skip(1)->take(1)->first();

    $levelone2 = User::orderBy('created_at','asc')->where('level',$level1)->where('wings',$me->wings)->where('track',2)->skip(1)->take(1)->first();

    $level2s=User::orderBy('created_at','asc')->where('level',$level1+1)->where('wings',$me->wings)->where('role_id',3)->skip(4)->take(4)->get();

}

elseif($wing=='right' && $me->track==1){
    $levelone1 = User::orderBy('created_at','asc')->where('level',$level1)->where('wings',$me->wings)->where('track',1)->first();

    $levelone2 = User::orderBy('created_at','asc')->where('level',$level1)->where('wings',$me->wings)->where('track',2)->first();

    $level2s=User::orderBy('created_at','asc')->where('level',$level1+1)->where('wings',$me->wings)->where('role_id',3)->take(4)->get();

}
elseif($wing=='right' && $me->track==2){

    $levelone1 = User::orderBy('created_at','asc')->where('level',$level1)->where('wings',$me->wings)->where('track',1)->skip(1)->take(1)->first();

    $levelone2 = User::orderBy('created_at','asc')->where('level',$level1)->where('wings',$me->wings)->where('track',2)->skip(1)->take(1)->first();

    $level2s=User::orderBy('created_at','asc')->where('level',$level1+1)->where('wings',$me->wings)->where('role_id',3)->take(4)->get();

}
else{
    $levelone1 = User::orderBy('created_at','asc')->where('level',$level1)->where('wings',$me->wings)->where('track',1)->first();

    $levelone2 = User::orderBy('created_at','asc')->where('level',$level1)->where('wings',$me->wings)->where('track',2)->first();

    $level2s=User::orderBy('created_at','asc')->where('level',$level1+1)->where('wings',$me->wings)->where('role_id',3)->take(4)->get();


}}*/
        
        return view('backend.tree.mlm',['leveltwo4'=>$leveltwo4,'leveltwo3'=>$leveltwo3,'leveltwo2'=>$leveltwo2,'leveltwo1'=>$leveltwo1,'totalB34' =>$totalB34,'totalA34' =>$totalA34,'totalB33' =>$totalB33,'totalA33' =>$totalA33,'totalB32' =>$totalB32,'totalA32' =>$totalA32,'totalB3' =>$totalB3,'totalA3' =>$totalA3,'totalB2' =>$totalB2,'totalA2' =>$totalA2,'totalB1' =>$totalB1,'totalA1' =>$totalA1,'totalB' =>$totalB,'totalA' =>$totalA,'id' => $id,'me' => $me,'levelone1'=>$levelone1,'levelone2'=>$levelone2]);


    }
   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
