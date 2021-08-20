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
                <div class="table-responsive">
                <div class="tree">
            <?php
            $id=2000;
              $me = App\User::latest()->where('seller_id',$id)->first();
              $level=$me->level;
              $wings=$me->wings;
              $total=0;
              $totalA=0;
              $totalB=0;
              $i=0;
              $j=0;
              $prome=App\User::latest()->where('id','>',$me->id)->get();
                    
                    
           
			    
			    $left=App\User::where('role_id',3)->where('id','>',$me->id)->where('wings',$me->wings)->where('track',1)->get();
        
        foreach($left as $lts){
                          $carrlt=App\Order::where('user_id',$lts->id)->get();  
                          
                          foreach($carrlt as $clt){
                        $totalA+=$clt->total_item;
                    } 
                   
        }
                    
                    
			    
			      $rights=App\User::where('role_id',3)->where('id','>',$me->id)->where('wings',$me->wings)->where('track',2)->get();
        
        foreach($rights as $rths){
                          $carrer=App\Order::where('user_id',$rths->id)->get();  
                          foreach($carrer as $rce){
                         $totalB+=$rce->total_item;
                    } 
        }
            
                  ?>  
                    <ul>
		<li>
						<a href="{{ route('backend.tree.index',$me->seller_id) }}"><strong>Name:</strong> {{$me->first_name}} {{$me->last_name}} <br><strong>ID:</strong> {{$id}}<br><strong>Designation:</strong>{{$me->grade}}<br><strong>Total Matching:</strong>{{$me->matches}}<br><strong>Team A Carry:</strong>{{$totalA}}<br><strong>Team B Carry:</strong>{{$totalB}}</a>
<?php 
$totalcarryA=0;
                      $totalcarryB=0;
                      $totalcarrytwoA=0;
                      $totalcarrytwoB=0;
$level1=$level+1;
$sk=0;
$tk=2;
if($level1==3){
    $sk=2;
$tk=4;
}
if($level1==4){
    $sk=4;
$tk=8;
}
if($level1==5 && $me->track==1){
    $sk=8;
$tk=2;
}

if($me->track==1){
    
                   $levelone1s = app\User::where('wings',$wings)->orderBy('created_at','asc')->where('level',$level1)->where('id','>',$me->id)->skip(0)->take(2)->get();
if(!$levelone1s){
    $levelone1s=0;
}
}
elseif($me->track==2){
    
               $levelone1s = app\User::orderBy('created_at','asc')->where('level',$level1)->where('id','>',$me->id)->skip($sk)->take(2)->where('wings',$wings)->get();
 if(!$levelone1s){
    $levelone1s=0;
} 
}
else{
    
    $levelone1s=0;

}
if($levelone1s){
   
?>
			<ul>
			    @foreach($levelone1s as $levelone1)
			    
			    <?php
			    if($levelone1->track==1){
			    $two=App\User::where('role_id',3)->where('id','>',$levelone1->id)->where('wings',$levelone1->wings)->where('track',1)->get();
        
        foreach($two as $t){
                          $carrb=App\Order::where('user_id',$t->id)->get();  
                          
                          foreach($carrb as $cb){
                        $totalcarryA+=$cb->total_item;
                    } 
                   
        }
                    
                    
			    }
			    else{
			        $three=App\User::where('role_id',3)->where('id','>',$levelone1->id)->where('wings',$levelone1->wings)->where('track',2)->get();
        
        foreach($three as $th){
                          $carr=App\Order::where('user_id',$th->id)->get();  
                          foreach($carr as $c){
                         $totalcarryB+=$c->total_item;
                    } 
        }
			    }
			    ?>
				<li>
				    <a href="{{ route('backend.tree.index',$levelone1->seller_id) }}"><strong>Name:</strong> {{$levelone1->first_name}} {{$levelone1->last_name}} <br><strong>ID:</strong> {{$levelone1->seller_id}}<br><strong>Designation:</strong>{{$levelone1->grade}}<br><strong>Total Matching:</strong>{{$levelone1->matches}}<br><strong>Team A Carry:{{$totalcarryA}}</strong><br><strong>Team B Carry:</strong>{{$totalcarryB}}</a>
					<ul>
					    <?php 
					    
					     $level2=$level+2;
					     $sk2=0;
$tk2=2;
$sk22=2;
$tk22=2;
if($level2==3){
     $sk2=0;
$tk2=2;
    $sk22=2;
$tk22=4;
}
if($level2==4 && $me->track==2){
     $sk2=4;
$tk2=2;
    $sk22=8;
$tk22=2;
}
if($level2==5 && $me->track==2){
     $sk2=4;
$tk2=2;
    $sk22=8;
$tk22=2;
}
					    if($levelone1->track==1){
					                      $leveltwo1s = app\User::orderBy('id','asc')->where('id','>',$levelone1->id)->where('level',$level2)->where('wings',$wings)->skip($sk2)->take($tk2)->get();


if(!$leveltwo1s){
    $leveltwo1s=0;
}
					    }
					    elseif($levelone1->track==2){
					        
					                     $leveltwo1s = app\User::orderBy('id','asc')->where('id','>',$levelone1->id)->where('level',$level2)->where('wings',$wings)->skip($sk22)->take($sk22)->get();
 if(!$leveltwo1s){
    $leveltwo1s=0;
}
					    }
					    else{
					        $leveltwo1s=0;
					    }
 if($leveltwo1s){
     
?>
@foreach($leveltwo1s as $leveltwo1)
	    <?php
			    if($leveltwo1->track==1){
			    $twos=App\User::where('role_id',3)->where('id','>',$leveltwo1->id)->where('wings',$leveltwo1->wings)->where('track',1)->get();
        
        foreach($twos as $ts){
                          $carrt=App\Order::where('user_id',$ts->id)->get();  
                          
                          foreach($carrt as $ct){
                        $totalcarrytwoA+=$ct->total_item;
                    } 
                   
        }
                    
                    
			    }
			    else{
			        $threes=App\User::where('role_id',3)->where('id','>',$leveltwo1->id)->where('wings',$leveltwo1->wings)->where('track',2)->get();
        
        foreach($threes as $ths){
                          $carre=App\Order::where('user_id',$ths->id)->get();  
                          foreach($carre as $ce){
                         $totalcarrytwoB+=$ce->total_item;
                    } 
        }
			    }
			    ?>
            <li class="level{{$level2}}hide{{$i++}}">
<a href="{{ route('backend.tree.index',$leveltwo1->seller_id) }}"><strong>Name:</strong> {{$leveltwo1->first_name}} {{$leveltwo1->last_name}} <br><strong>ID:</strong> {{$leveltwo1->seller_id}}<br><strong>Designation:</strong>{{$leveltwo1->grade}}<br><strong>Total Matching:</strong>{{$leveltwo1->matches}}<br><strong>Team A Carry:</strong>{{$totalcarrytwoA}}<br><strong>Team B Carry:</strong>{{$totalcarrytwoB}}</a>
              
						</li>
						
						@endforeach
				<?php }?>
					</ul>
					
				</li>
			
				
				@endforeach
				<?php }?>
			</ul>
		</li>
	</ul>
     
  
	
</div>


                  
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
      <style>
      * {margin: 0; padding: 0;}

.tree ul {
	padding-top: 20px; position: relative;
	
	transition: all 0.5s;
	-webkit-transition: all 0.5s;
	-moz-transition: all 0.5s;
}

.tree li {
	float: left; text-align: center;
	list-style-type: none;
	position: relative;
		padding: 20px 5px 0 5px;
	
	transition: all 0.5s;
	-webkit-transition: all 0.5s;
	-moz-transition: all 0.5s;
}

/*We will use ::before and ::after to draw the connectors*/

.tree li::before, .tree li::after{
	content: '';
	position: absolute; top: 0; right: 50%;
	border-top: 2px solid #000000;
	width: 50%; height: 20px;
}
.tree li::after{
	right: auto; left: 50%;
	border-left: 2px solid #000000;
}

/*We need to remove left-right connectors from elements without 
any siblings*/
.tree li:only-child::after, .tree li:only-child::before {
	display: none;
}

/*Remove space from the top of single children*/
.tree li:only-child{ padding-top: 0;}

/*Remove left connector from first child and 
right connector from last child*/
.tree li:first-child::before, .tree li:last-child::after{
	border: 0 none;
}
/*Adding back the vertical connector to the last nodes*/
.tree li:last-child::before{
	border-right: 2px solid #000000;
	border-radius: 0 5px 0 0;
	-webkit-border-radius: 0 5px 0 0;
	-moz-border-radius: 0 5px 0 0;
}
.tree li:first-child::after{
	border-radius: 5px 0 0 0;
	-webkit-border-radius: 5px 0 0 0;
	-moz-border-radius: 5px 0 0 0;
}

/*Time to add downward connectors from parents*/
.tree ul ul::before{
	content: '';
	position: absolute; top: 0; left: 50%;
	border-left: 2px solid #000000;
	width: 0; height: 15px;
}

.tree li a{
	border: 2px solid #000000;
	padding: 8px 8px;
	text-decoration: none;
	color: #666;
	font-family: arial, verdana, tahoma;
	font-size: 14px;
	display: inline-block;
	
	border-radius: 5px;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	
	transition: all 0.5s;
	-webkit-transition: all 0.5s;
	-moz-transition: all 0.5s;
}

/*Time for some hover effects*/
/*We will apply the hover effect the the lineage of the element also*/
.tree li a:hover, .tree li a:hover+ul li a {
	background: #c8e4f8; color: #000; border: 1px solid #94a0b4;
}
/*Connector styles on hover*/
.tree li a:hover+ul li::after, 
.tree li a:hover+ul li::before, 
.tree li a:hover+ul::before, 
.tree li a:hover+ul ul::before{
	border-color:  #94a0b4;
}

/*.level3hide2,.level3hide3,.level3hide4,.level3hide5{
    display:none;
}

.level4hide2,.level4hide3,.level4hide4,.level4hide5{
    display:none;
}
*/
.tree .jos14{
  display:none;
}

.tree .jos15{
  display:none;
}
.tree .jos16{
  display:none;
}

.tree .jos17{
  display:none;
}
.tree .jos18{
  display:none;
}

.tree .jos19{
  display:none;
}
.tree .jos20{
  display:none;
}
.tree .jos23{
  display:none;
}
.tree .jos24{
  display:none;
}


.tree .jos49{
  display:none;
}
.tree .jos50{
  display:none;
}

.tree .jos51{
  display:none;
}
.tree .jos52{
  display:none;
}


.tree .jos55{
  display:none;
}
.tree .jos56{
  display:none;
}

.tree .jos57{
  display:none;
}
.tree .jos58{
  display:none;
}

.tree .jos59{
  display:none;
}
.tree .jos60{
  display:none;
}

.tree .jos61{
  display:none;
}
.tree .jos62{
  display:none;
}
      </style>
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