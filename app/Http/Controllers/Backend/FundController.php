<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Funds;
use App\MSP;
use App\User;
use App\Royality;

class FundController extends Controller
{

    public function create()
    {
        $settings = Funds::find(1);
        $msps = MSP::find(1);
        $royal = Royality::find(1);
         $sum=$msps->A+$msps->B+$msps->C+$msps->D+$msps->E;
         $total=$royal->total;
           $tot=$royal->M+$royal->AM+$royal->SM+$royal->GM+$royal->BA;
           
            $msptotal=$msps->dbA+$msps->dbB+$msps->dbC+$msps->dbD+$msps->dbE;
        return view('backend.funds.create',['settings' => $settings,'msp'=>$sum,'totalroyal'=>$total,'tot'=>$tot,'msptotal'=>$msptotal]);


    }


    public function update(Request $request, $id)
    {
        
        $category = Funds::find(1);
        $category->referrence = request('referrence');
        $category->affiliate = request('affiliate');
        $category->msp = request('msp');
        $category->royality = request('royality');
        $category->reward = request('reward');

        $category->charity = request('charity');
        $category->dealership = request('dealership');
        $category->matching = request('matching');
        $category->profit = request('profit');
        


        $category->save();

        $request->session()->flash('success', 'Successfully Updated!');
        return redirect(route('backend.funds.create'));
    }
    
    public function royalDistribute()
    { 
        $funds = Funds::find(1);
        
        $royal= Royality::find(1);
        
        $countA=User::where('grade','M')->count();
        $countB=User::where('grade','AM')->count();
        $countC=User::where('grade','SM')->count();
        $countD=User::where('grade','GM')->count();
        $countE=User::where('grade','BA')->count();
        if($countA){
         $pointA= $royal->dbM/$countA;   
          $userAs=User::where('grade','M')->get();
           foreach($userAs as $usrA){
                           $userA=User::where('seller_id',$usrA->seller_id)->where('grade','M')->first();

               $userA->points+=$pointA;
        $userA->save(); 
            }
        
        }
        else{}
        if($countB){
            $pointB= $royal->dbAM/$countB;
            $userBs=User::where('grade','AM')->get();
             foreach($userBs as $usrB){
                             $userB=User::where('seller_id',$usrB->seller_id)->where('grade','AM')->first();

                $userB->points+=$pointB;
        $userB->save();
            }
        
        }
        else{}
        if($countC){
            $pointC= $royal->dbSM/$countC;
            $userCs=User::where('grade','SM')->get();
             foreach($userCs as $usrC){
                             $userC=User::where('seller_id',$usrC->seller_id)->where('grade','SM')->first();

               $userC->points+=$pointC;
        $userC->save(); 
            }
        
        }
        else{}
        if($countD){
            $pointD= $royal->dbGM/$countD;
            
             $userDs=User::where('grade','GM')->get();
              foreach($userDs as $usrD){
                              $userD=User::where('seller_id',$usrD->seller_id)->where('grade','GM')->first();

                 $userD->points+=$pointD;
        $userD->save();
            }
       
        }
        else{}
        if($countE){
            $pointE= $royal->dbBA/$countE;
            
            $userEs=User::where('grade','BA')->get();
            foreach($userEs as $usrE){
            $userE=User::where('seller_id',$usrE->seller_id)->where('grade','BA')->first();

                $userE->points+=$pointE;
        $userE->save();
            }
        
        }
        else{}
        
        $royal->dbM=0;
        $royal->dbAM=0;
$royal->dbSM=0;
$royal->dbGM=0;
$royal->dbBA=0;
        $royal->total=0;
        $royal->save();

       
        
        
       
        
        return redirect()->back()->with('success', 'Points Distributed Successfully');
        
        
        
        
        
    }
    
    public function mspDistribute()
    { 
        $funds = Funds::find(1);
        
        $royal= MSP::find(1);
        
        $countA=User::where('grade','A')->count();
        $countB=User::where('grade','B')->count();
        $countC=User::where('grade','C')->count();
        $countD=User::where('grade','D')->count();
        $countE=User::where('grade','E')->count();
        if($countA){
         $pointA= $royal->dbA/$countA;   
          $userAs=User::where('grade','A')->get();
           foreach($userAs as $usrA){
                           $userA=User::where('seller_id',$usrA->seller_id)->where('grade','A')->first();

               $userA->points+=$pointA;
        $userA->save(); 
            }
        
        }
        else{}
        if($countB){
            $pointB= $royal->dbB/$countB;
            $userBs=User::where('grade','B')->get();
             foreach($userBs as $usrB){
                             $userB=User::where('seller_id',$usrB->seller_id)->where('grade','B')->first();

                $userB->points+=$pointB;
        $userB->save();
            }
        
        }
        else{}
        if($countC){
            $pointC= $royal->dbC/$countC;
            $userCs=User::where('grade','C')->get();
             foreach($userCs as $usrC){
                             $userC=User::where('seller_id',$usrC->seller_id)->where('grade','C')->first();

               $userC->points+=$pointC;
        $userC->save(); 
            }
        
        }
        else{}
        if($countD){
            $pointD= $royal->dbD/$countD;
            
             $userDs=User::where('grade','D')->get();
              foreach($userDs as $usrD){
                              $userD=User::where('seller_id',$usrD->seller_id)->where('grade','D')->first();

                 $userD->points+=$pointD;
        $userD->save();
            }
       
        }
        else{}
        if($countE){
            $pointE= $royal->dbE/$countE;
            
            $userEs=User::where('grade','E')->get();
            foreach($userEs as $usrE){
            $userE=User::where('seller_id',$usrE->seller_id)->where('grade','E')->first();

                $userE->points+=$pointE;
        $userE->save();
            }
        
        }
        else{}
        
        $royal->dbA=0;
        $royal->dbB=0;
$royal->dbC=0;
$royal->dbD=0;
$royal->dbE=0;
        $royal->save();

       
        
        
       
        
        return redirect()->back()->with('success', 'Points Distributed Successfully');
        
        
        
        
        
    } 
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}
