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
	<ul>
  <?php
  $id=2000;
              $me = App\User::latest()->where('seller_id',$id)->first();
              $total=0;
              $totalt=0;
              $total1=0;
              $i=0;
              $j=0;
              $k=0;
              $m=0;
              $n=0;
 
      ?>
		<li>
			<a href="#"><strong>Seller ID:</strong> {{$id}}<br><strong>Name:</strong> {{$me->first_name}} {{$me->last_name}} <br><strong>Points:</strong>{{$me->points}}</a>
			<ul>
      <?php
              $teams = app\User::where('ref_id',$id)->orderBy('created_at','asc')->skip(0)->take(2)->get();
              $teamscount = app\User::latest()->where('ref_id',$id)->count();

      ?>
      @foreach($teams as $team)
      <?php 
          $k++;
          $carries=App\Order::latest()->where('user_id',$team->id)->get();
                    foreach($carries as $carry){
                      $total+=$carry->total_item;
                    }

                 

      ?>
      
      				<li>
              <a href="{{ route('backend.tree.index',$team->seller_id) }}"><strong></strong><?php if($k==1){echo "Carry A";}else{ echo "Carry B";}?></strong><br><strong>Seller ID:</strong> {{$team->seller_id}}<br><strong>Name:</strong>{{$team->first_name}} {{$team->last_name}}<br><strong>Carry:</strong>{{$total}}</strong><br><strong>Points:</strong>{{$team->points}}<br><strong>Refference ID:</strong>{{$team->ref_id}}</a>
              <ul>

         <?php 
            if($teamscount>2)
            {
              $no=$teamscount-2;
             $level2= app\User::where('ref_id',$team->ref_id)->skip(2)->take(2)->get();
             $sellercount = app\User::latest()->where('ref_id',$team->seller_id)->count();
             $i++;
             if($sellercount<2){
               foreach($level2 as $lv2)
             {$m++;
               $getnewpos = app\User::where('id',$lv2->id)->orderBy('created_at','asc')->first();

           ?>
        <li class="hide{{$i}}">
							<a href="{{ route('backend.tree.index',$getnewpos->seller_id) }}"><?php if($m==1){echo "Carry A";}else{ echo "Carry B";}?><br><strong>Seller ID:</strong> {{$getnewpos->seller_id}}<br><strong>Name:</strong>{{$getnewpos->first_name}} {{$getnewpos->last_name}}<br><strong>Carry:</strong>{{$totalt}}</strong><br><strong>Points:</strong>{{$getnewpos->points}}<br><strong>Refference ID:</strong>{{$getnewpos->ref_id}}</a>
           </li>
           <?php 
             }
           
             }
             
           
            }
            else{

            }
            ?>
            
<?php
            $teas = app\User::where('ref_id',$team->seller_id)->orderBy('created_at','asc')->skip(0)->take(2)->get();
            $teascount = app\User::latest()->where('ref_id',$team->seller_id)->count();
?>
         
      </ul> 
 
          <ul>
         
          @foreach($teas as $tea)
         
          <?php 
          $n++;
                    $carries=App\Order::latest()->where('user_id',$tea->seller_id)->get();
                    foreach($carries as $carry){
                      $totalt+=$carry->total_item;
                    }

      ?>

            <li>
							<a href="{{ route('backend.tree.index',$tea->seller_id) }}"><?php if($n==1){echo "Carry A";}else{ echo "Carry B";}?><br><strong>Seller ID:</strong> {{$tea->seller_id}}<br><strong>Name:</strong>{{$tea->first_name}} {{$tea->last_name}}<br><strong>Carry:</strong>{{$totalt}}</strong><br><strong>Points:</strong>{{$tea->points}}<br><strong>Refference ID:</strong>{{$tea->ref_id}}</a>
              <ul>
              <?php 
            if($teascount>2)
            {
              $no=$teascount-2;
             $level3= app\User::where('ref_id',$tea->ref_id)->skip(2)->take(4)->get();
             $sellercount3 = app\User::latest()->where('ref_id',$tea->seller_id)->count();
             $i++;
             if($sellercount3<2){
               foreach($level3 as $lv3)
             {
               $getnewpos3 = app\User::where('id',$lv3->id)->orderBy('created_at','asc')->first();
               $j++;
           ?>
        <li class="jos{{$j}}">
							<a href="{{ route('backend.tree.index',$getnewpos3->seller_id) }}"><?php if($j==1 || $j==7 ){echo "Carry A";}else{ echo "Carry B";}?><br><strong>Seller ID:</strong> {{$getnewpos3->seller_id}}<br><strong>Name:</strong>{{$getnewpos3->first_name}} {{$getnewpos3->last_name}}<br><strong>Carry:</strong>{{$totalt}}</strong><br><strong>Points:</strong>{{$getnewpos3->points}}<br><strong>Refference ID:</strong>{{$getnewpos3->ref_id}}</a>
           </li>
           <?php 
             }
           
             }
             
           
            }
            else{   }
            ?>
              <?php
              $ts =app\User::where('ref_id',$tea->seller_id)->orderBy('created_at','asc')->get();

              $tscount = app\User::latest()->where('ref_id',$tea->seller_id)->count();

      ?>
                @foreach($ts as $t)
                <?php 
                    $carries=App\Order::latest()->where('user_id',$t->seller_id)->get();
                    foreach($carries as $carry){
                      $total1+=$carry->total_item;
                    }

      ?>

            <li>
							<a href="{{ route('backend.tree.index',$t->seller_id) }}"><strong>Seller ID:</strong> {{$t->seller_id}}<br><strong>Name:</strong>{{$t->first_name}} {{$t->last_name}}<br><strong>Carry:</strong>{{$total1}}</strong><br><strong>Points:</strong>{{$t->points}}<br><strong>Refference ID:</strong>{{$t->ref_id}}</a>
             <ul>
              <?php 
            if($tscount>2)
            {
              $no=$tscount-2;
             $level4= app\User::latest()->where('ref_id',$t->ref_id)->skip(0)->take(2)->get();
             $sellercount4 = app\User::latest()->where('ref_id',$t->seller_id)->count();
             $i++;
             if($sellercount4<2){
               foreach($level4 as $lv4)
             {
               $getnewpos4 = app\User::where('id',$lv4->id)->orderBy('created_at','asc')->first();
           ?>
        <li class="hide{{$i}}">
							<a href="{{ route('backend.tree.index',$getnewpos4->seller_id) }}"><strong>Seller ID:</strong> {{$getnewpos4->seller_id}}<br><strong>Name:</strong>{{$getnewpos4->first_name}} {{$getnewpos4->last_name}}<br><strong>Carry:</strong>{{$totalt}}</strong><br><strong>Points:</strong>{{$getnewpos4->points}}<br><strong>Refference ID:</strong>{{$getnewpos4->ref_id}}</a>
           </li>
           <?php 
             }
           
             }
             
           
            }
            else{

            }

            ?>
          
          
          
          	</li>
            @endforeach
					
					</ul>
              
						</li>
          
            @endforeach
					</ul>

				</li>
			@endforeach

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
	padding: 5px 5px;
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

.tree .hide2{
  display:none;
}

.tree .hide4{
  display:none;
}
.tree .jos3{
 display:none;
    
}

.tree .jos4{
 display:none;
    
}


.tree .jos5{
 display:none;
    
}
.tree .jos6{
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