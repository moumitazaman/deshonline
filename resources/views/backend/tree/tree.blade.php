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
               

<div class="col-md-12 col-sm-6 col-12" style="text-align:center;">

<div class="col-md-4 col-md-offset-2">
<?php
            $id=2000;
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
              $count=App\User::latest()->where('id','<=',$me->id)->whereIn('ref_id',[2000,$id,$me->ref_id])->count();
              
			    $left=App\User::where('role_id',3)->where('id','>',$me->id)->where('wings','left')->get();
        
          foreach($left as $lts){
                            $carrlt=App\Order::where('user_id',$lts->id)->get();  
                            
                            foreach($carrlt as $clt){
                          $totalA1+=$clt->total_item;
                      } 
                     
          }
                      
            
              $rights=App\User::where('role_id',3)->where('id','>',$me->id)->where('wings','right')->get();
          
          foreach($rights as $rths){
                            $carrer=App\Order::where('user_id',$rths->id)->get();  
                            foreach($carrer as $rce){
                           $totalB1+=$rce->total_item;
                      } 
          }
          $levelone1 = app\User::orderBy('created_at','asc')->where('level',1)->where('wings','left')->first();
          $two=App\User::where('role_id',3)->where('id','>',$levelone1->id)->where('track',1)->where('wings','left')->get();
    
    foreach($two as $t){
                      $carrb=App\Order::where('user_id',$t->id)->get();  
                      
                      foreach($carrb as $cb){
                    $totalcarryA+=$cb->total_item;
                } 
               
    }
    
     $three=App\User::where('role_id',3)->where('id','>',$levelone1->id)->where('track',2)->where('wings','left')->get();
    
    foreach($three as $th){
                      $carr=App\Order::where('user_id',$th->id)->get();  
                      foreach($carr as $c){
                     $totalcarryB+=$c->total_item;
                } 
    }    

    $totalA= $totalcarryA+$totalcarryB;

    $levelone2 = app\User::orderBy('created_at','asc')->where('level',1)->where('wings','right')->first();
    $twos=App\User::where('role_id',3)->where('id','>',$levelone2->id)->where('wings',$levelone2->wings)->where('track',1)->get();

foreach($twos as $t2){
       $carr2=App\Order::where('user_id',$t2->id)->get();  
       
       foreach($carr2 as $c2){
     $totalcarry2A+=$c2->total_item;
 } 

}

$threes=App\User::where('role_id',3)->where('id','>',$levelone2->id)->where('wings',$levelone2->wings)->where('track',1)->get();

foreach($threes as $th3){
       $carr3=App\Order::where('user_id',$th3->id)->get();  
       foreach($carr3 as $c3){
      $totalcarry2B+=$c3->total_item;
 } 
}
$totalB=$totalcarry2A+$totalcarry2B;

                      
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
                      <h5 class="description-header">{{$totalA}}</h5>
                      <span class="description-text">Team A Carry</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-6">
                    <div class="description-block">
                      <h5 class="description-header">{{$totalB}}</h5>
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

              <div class="col-md-6 col-sm-6 col-12" style="text-align:center;">
             
            <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user">
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
                    </div>
</div>
                 
                  <!-- /.col -->
                  <div class="col-sm-6 border-right">
                    <div class="description-block">
                      <h5 class="description-header">{{ $totalcarryA}}</h5>
                      <span class="description-text">Team A Carry</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-6">
                    <div class="description-block">
                      <h5 class="description-header">{{$totalcarryB}}</h5>
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
<!--2-->

              <div class="col-md-6 col-sm-6 col-12" style="text-align:center;float:right">
             
             <!-- Widget: user widget style 1 -->
             <div class="card card-widget widget-user">
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
                    </div>
</div>
                 
                  <!-- /.col -->
                  <div class="col-sm-6 border-right">
                    <div class="description-block">
                      <h5 class="description-header">{{$totalcarry2A}}</h5>
                      <span class="description-text">Team A Carry</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-6">
                    <div class="description-block">
                      <h5 class="description-header">{{$totalcarry2B}}</h5>
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


              <?php
$level2s=app\User::orderBy('created_at','asc')->where('level',2)->where('role_id',3)->get();

              ?>
              @foreach($level2s as $lv2)

              <?php 

              if($lv2->wings=='left' && $lv2->track==1){
              
           $twols=App\User::where('track',1)->where('role_id',3)->where('id','>',$lv2->id)->where('wings','left')->get();
        
        foreach($twols as $t2l){
                          $carr2l=App\Order::where('user_id',$t2l->id)->get();  
                          
                          foreach($carr2l as $c2l){
                       $totalcarryA3+=$c2l->total_item;
                    } 
                   
        }
      }
      
      elseif($lv2->wings=='left' && $lv2->track==2){
         $threers=App\User::where('track',2)->where('role_id',3)->where('id','>',$lv2->id)->where('wings','left')->get();
        
        foreach($threers as $th3r){
                          $carr3r=App\Order::where('user_id',$th3r->id)->get();  
                          foreach($carr3r as $c3r){
                          $totalcarryB3+=$c3r->total_item;
                    } 
        }
      }
      elseif($lv2->wings=='right' && $lv2->track==1){

        $twolds=App\User::where('role_id',3)->where('id','>',$lv2->id)->where('wings','right')->where('track',1)->get();
        
        foreach($twolds as $t2l){
                          $carr2l=App\Order::where('user_id',$t2l->id)->get();  
                          
                          foreach($carr2l as $c2l){
                         $totalcarryAd3+=$c2l->total_item;
                    } 
                   
        }
      }
      elseif($lv2->wings=='right' && $lv2->track==2){
         $threerds=App\User::where('role_id',3)->where('id','>',$lv2->id)->where('wings','right')->where('track',2)->get();
        
        foreach($threerds as $th3r){
                          $carr3r=App\Order::where('user_id',$th3r->id)->get();  
                          foreach($carr3r as $c3r){
                          $totalcarryBd3+=$c3r->total_item;
                    } 
        }

      }
           ?>

              <div class="col-md-3 col-sm-6 col-12" style="text-align:center;">
            
              <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-info">
                <h3 class="widget-user-username">{{$lv2->first_name}} {{$lv2->last_name}}</h3>
                <h5 class="widget-user-desc">Seller ID:<strong>{{$lv2->seller_id}}</strong></h5>

              </div>
              <div class="widget-user-image">
                <img class="img-circle elevation-2" src="{{ asset('backend/img/tree.png')}}" alt="User Avatar">
              </div>

              <div class="card-footer">
                <div class="row">
                <div class="col-sm-12">
                    <div class="description-block">
                    <h6 >PCN:<strong>{{$lv2->pcn}}</strong></h6>
<h6>Designation: <?php if($lv2->grade){ echo "MSP";}?> {{$lv2->grade}}</h6>
<h6>Total Matching:{{$lv2->matches}}</h6>
                    </div>
</div>
                 
                  <!-- /.col -->
                  <div class="col-sm-6 border-right">
                    <div class="description-block">
                      <h5 class="description-header"><?php if($lv2->wings=='left'){ echo $totalcarryA3;}elseif($lv2->wings=='right'){echo $totalcarryAd3;}?></h5>
                      <span class="description-text">Team A Carry</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-6">
                    <div class="description-block">
                      <h5 class="description-header"><?php if($lv2->wings=='left'){ echo $totalcarryB3;}elseif($lv2->wings=='right'){echo $totalcarryBd3;}?></h5>
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
              
              @endforeach
            






                  
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