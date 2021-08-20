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
              $me = App\User::latest()->where('seller_id',$id)->first();
              $total=0;
              $totalt=0;
              $total1=0;
              $i=0;
              $j=0;
              $count=App\User::latest()->where('id','<=',$me->id)->whereIn('ref_id',[2000,$id,$me->ref_id])->count();
                      
              $tum=$count-1;
              $sum=$count+$tum+5+1;
              $bum=$count+$tum;
             
              
if($sum>=11){
    if($count%2==0){
       $sum=$count+6+1;  
      
    }
    
    else{
        
       
        $sum=$count+6;    
        
     

    
}
         
       
    
    
}

else{
   $sum=$count+$tum+5+1; 
}

if($count==3)
        {
                          $twos=App\User::orderBy('created_at','asc')->skip($sum+8)->take(2)->get();

        }
        elseif($count==4)
        {
                          $twos=App\User::orderBy('created_at','asc')->skip($sum+8)->take(2)->get();

        }
        elseif($count==7){
                                     $twos=App\User::orderBy('created_at','asc')->skip($sum+2)->take(2)->get();
 
        }
        else{
                      $twos=App\User::orderBy('created_at','asc')->skip($sum)->take(2)->get();
    
        }
             
 $two=App\User::orderBy('created_at','asc')->where('seller_id',$twos[0]['seller_id'])->first();
 $three=App\User::orderBy('created_at','asc')->where('seller_id',$twos[1]['seller_id'])->first();
 if(($twos[0]['ref_id'])==$id || ($twos[0]['ref_id'])==2000 || ($twos[0]['ref_id'])==$me->ref_id || ($twos[1]['ref_id'])==$id || ($twos[1]['ref_id'])==2000 || ($twos[1]['ref_id'])==$me->ref_id){
      ?>
                
                <ul>
		<li>
    <a href="#"><strong>Seller ID:</strong> {{$id}}<br><strong>Name:</strong> {{$me->first_name}} {{$me->last_name}} <br><strong>Points:</strong>{{$me->points}}</a>
			<ul>
				<li>
        <a href="{{ route('backend.tree.index',$two->seller_id) }}"><strong>Carry A</strong><br><strong>Seller ID:</strong> {{$two->seller_id}}<br><strong>Name:</strong> {{$two->first_name}} {{$two->last_name}} <br><strong>Points:</strong>{{$two->points}}</a>
					<ul>
          <?php 
          if($sum>=11){
                                      $tis=App\User::orderBy('created_at','asc')->skip($sum+4)->take(2)->get();

}
else{
                         
                          
                          $tis=App\User::orderBy('created_at','asc')->skip($sum+2)->take(2)->get();
  
}

                        $ts1=App\User::orderBy('created_at','asc')->where('seller_id',$tis[0]['seller_id'])->first();
                        $ts2=App\User::orderBy('created_at','asc')->where('seller_id',$tis[1]['seller_id'])->first();

if(($tis[0]['ref_id'])==$id || ($tis[0]['ref_id'])==2000 || ($tis[0]['ref_id'])==$me->ref_id || ($tis[1]['ref_id'])==$id || ($tis[1]['ref_id'])==2000 || ($tis[1]['ref_id'])==$me->ref_id){


          ?>
            <li>
            <a href="{{ route('backend.tree.index',$ts1->seller_id) }}"><strong>Carry A</strong><br><strong>Seller ID:</strong> {{$ts1->seller_id}}<br><strong>Name:</strong> {{$ts1->first_name}} {{$ts1->last_name}} <br><strong>Points:</strong>{{$ts1->points}}</a>
            <!--<ul>
            <?php 
                        $toso=App\User::orderBy('created_at','asc')->skip($count+9+2)->take(2)->get();
                        $t1o=App\User::orderBy('created_at','asc')->where('seller_id',$toso[0]['seller_id'])->first();
                        $t2o=App\User::orderBy('created_at','asc')->where('seller_id',$toso[1]['seller_id'])->first();



          ?>
            <li>
            <a href="#"><strong>Carry A</strong><br><strong>Seller ID:</strong> {{$t1o->seller_id}}<br><strong>Name:</strong> {{$t1o->first_name}} {{$t1o->last_name}} <br><strong>Points:</strong>{{$t1o->points}}</a>
						</li>
						<li>
            <a href="#"><strong>Carry B</strong><br><strong>Seller ID:</strong> {{$t2o->seller_id}}<br><strong>Name:</strong> {{$t2o->first_name}} {{$t2o->last_name}} <br><strong>Points:</strong>{{$t2o->points}}</a>
						</li>
					</ul>-->
						</li>
						<li>
            <a href="{{ route('backend.tree.index',$ts2->seller_id) }}"><strong>Carry B</strong><br><strong>Seller ID:</strong> {{$ts2->seller_id}}<br><strong>Name:</strong> {{$ts2->first_name}} {{$ts2->last_name}} <br><strong>Points:</strong>{{$ts2->points}}</a>
            <!--<ul>
            <?php 
                        $t4=App\User::orderBy('created_at','asc')->skip($count+7)->take(2)->get();
                        $t3o=App\User::orderBy('created_at','asc')->where('seller_id',$t4[0]['seller_id'])->first();
                        $t4o=App\User::orderBy('created_at','asc')->where('seller_id',$t4[1]['seller_id'])->first();



          ?>
            <li>
            <a href="#"><strong>Carry A</strong><br><strong>Seller ID:</strong> {{$t3o->seller_id}}<br><strong>Name:</strong> {{$t3o->first_name}} {{$t3o->last_name}} <br><strong>Points:</strong>{{$t3o->points}}</a>
						</li>
						<li>
            <a href="#"><strong>Carry B</strong><br><strong>Seller ID:</strong> {{$t4o->seller_id}}<br><strong>Name:</strong> {{$t4o->first_name}} {{$t4o->last_name}} <br><strong>Points:</strong>{{$t4o->points}}</a>
						</li>
					</ul>-->
          
          	</li>
          	<?php }?>
					</ul>
				</li>
				<li>
        <a href="{{ route('backend.tree.index',$three->seller_id) }}"><strong>Carry B</strong><br><strong>Seller ID:</strong> {{$three->seller_id}}<br><strong>Name:</strong> {{$three->first_name}} {{$three->last_name}} <br><strong>Points:</strong>{{$three->points}}</a>
					<ul>
						<ul>
            <?php 
             if($sum>=11){
                                  $tos=App\User::orderBy('created_at','asc')->skip($sum+8)->take(2)->get();
       
             }
             else{
                 
                                         $tos=App\User::orderBy('created_at','asc')->skip($sum+4)->take(2)->get();

             }
                        $t1=App\User::orderBy('created_at','asc')->where('seller_id',$tos[0]['seller_id'])->first();
                        $t2=App\User::orderBy('created_at','asc')->where('seller_id',$tos[1]['seller_id'])->first();


                        if(($tos[0]['ref_id'])==$id || ($tos[0]['ref_id'])==2000 || ($tos[0]['ref_id'])==$me->ref_id || ($tos[1]['ref_id'])==$id || ($tos[1]['ref_id'])==2000 || ($tos[1]['ref_id'])==$me->ref_id){

          ?>
            <li>
            <a href="{{ route('backend.tree.index',$t1->seller_id) }}"><strong>Carry A</strong><br><strong>Seller ID:</strong> {{$t1->seller_id}}<br><strong>Name:</strong> {{$t1->first_name}} {{$t1->last_name}} <br><strong>Points:</strong>{{$t1->points}}</a>
              
              <!--<ul>
              <?php 
                        $t5=App\User::orderBy('created_at','asc')->skip($count+9)->take(2)->get();
                        $t51=App\User::orderBy('created_at','asc')->where('seller_id',$t5[0]['seller_id'])->first();
                        $t52=App\User::orderBy('created_at','asc')->where('seller_id',$t5[1]['seller_id'])->first();



          ?>
            <li>
            <a href="#"><strong>Carry A</strong><br><strong>Seller ID:</strong> {{$t51->seller_id}}<br><strong>Name:</strong> {{$t51->first_name}} {{$t51->last_name}} <br><strong>Points:</strong>{{$t51->points}}</a>
						</li>
						<li>
            <a href="#"><strong>Carry B</strong><br><strong>Seller ID:</strong> {{$t52->seller_id}}<br><strong>Name:</strong> {{$t52->first_name}} {{$t52->last_name}} <br><strong>Points:</strong>{{$t52->points}}</a>
						</li>
					</ul>-->
						</li>
						<li>
            <a href="{{ route('backend.tree.index',$t2->seller_id) }}"><strong>Carry B</strong><br><strong>Seller ID:</strong> {{$t2->seller_id}}<br><strong>Name:</strong> {{$t2->first_name}} {{$t2->last_name}} <br><strong>Points:</strong>{{$t2->points}}</a>
					<!--	<ul>
            <?php 
                        $t6=App\User::orderBy('created_at','asc')->skip($count+11)->take(2)->get();
                        $t61=App\User::orderBy('created_at','asc')->where('seller_id',$t6[0]['seller_id'])->first();
                        $t62=App\User::orderBy('created_at','asc')->where('seller_id',$t6[1]['seller_id'])->first();



          ?>
            <li>
            <a href="#"><strong>Carry A</strong><br><strong>Seller ID:</strong> {{$t61->seller_id}}<br><strong>Name:</strong> {{$t61->first_name}} {{$t61->last_name}} <br><strong>Points:</strong>{{$t61->points}}</a>
						</li>
						<li>
            <a href="#"><strong>Carry B</strong><br><strong>Seller ID:</strong> {{$t62->seller_id}}<br><strong>Name:</strong> {{$t62->first_name}} {{$t62->last_name}} <br><strong>Points:</strong>{{$t62->points}}</a>
						</li>
					</ul>-->
            
            </li>
            <?php }?>
					</ul>
					</ul>
				</li>
			</ul>
			<?php } ?>
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
.tree .pos3{
  display:none;
}
.tree .pos4{
  display:none;
}

.tree .pos5{
  display:none;
}
.tree .pos6{
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
.tree .jos7{
  display:none;
}
.tree .jos8{
  display:none;
}

.tree .jos9{
  display:none;
}
.tree .jos10{
  display:none;
}

.tree .jos13{
  display:none;
}
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