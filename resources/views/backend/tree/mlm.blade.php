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
                      <h5 class="description-header">{{$totalA*150}}</h5>
                      <span class="description-text">Team A Carry</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-6">
                    <div class="description-block">
                      <h5 class="description-header">{{$totalB*150}}</h5>
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
              @if($levelone1)

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
                      <h5 class="description-header">{{ $totalA1*150}}</h5>
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
            </div></a>
            <!-- /.widget-user -->

              </div>
              @else
              <div class="col-md-6 col-sm-6 col-6" style="text-align:center;">
                  </div>
     @endif         
<!--2-->
@if($levelone2)
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
                      <h5 class="description-header">{{$totalA2*150}}</h5>
                      <span class="description-text">Team A Carry</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-6">
                    <div class="description-block">
                      <h5 class="description-header">{{$totalB2*150}}</h5>
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
              @else
              <div class="col-md-6 col-sm-6 col-6" style="text-align:center;">
                  </div>
@endif
              
              @if($leveltwo1)


              <div class="col-md-3 col-sm-3 col-3" style="text-align:center;">
            
           <a href="{{ route('backend.tree.index',$leveltwo1->seller_id) }}">   <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-info">
                <h3 class="widget-user-username">{{$leveltwo1->first_name}} {{$leveltwo1->last_name}}</h3>
                <h5 class="widget-user-desc">Seller ID:<strong>{{$leveltwo1->seller_id}}</strong></h5>

              </div>
              <div class="widget-user-image">
                <img class="img-circle elevation-2" src="{{ asset('backend/img/tree.png')}}" alt="User Avatar">
              </div>

              <div class="card-footer">
                <div class="row">
                <div class="col-sm-12">
                    <div class="description-block">
                    <h6 >PCN:<strong>{{$leveltwo1->pcn}}</strong></h6>
<h6>Designation: <?php if($leveltwo1->grade){ echo "MSP";}?> {{$leveltwo1->grade}}</h6>
<h6>Total Matching:{{$leveltwo1->matches}}</h6>
<h6>Refference ID:{{$leveltwo1->ref_id}}</h6>

                    </div>
</div>
                 
                  <!-- /.col -->
                  <div class="col-sm-6 border-right">
                    <div class="description-block">
                      <h5 class="description-header">{{$totalA3*150}}</h5>
                      <span class="description-text">Team A Carry</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-6">
                    <div class="description-block">
                      <h5 class="description-header">
 {{$totalB3*150}}</h5>
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
               @else
                            <div class="col-md-3 col-sm-3 col-3" style="text-align:center;">
</div>

@endif
              <!--2-->
              @if($leveltwo2)     
              <div class="col-md-3 col-sm-3 col-3" style="text-align:center;">
            
           <a href="{{ route('backend.tree.index',$leveltwo2->seller_id) }}">   <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-info">
                <h3 class="widget-user-username">{{$leveltwo2->first_name}} {{$leveltwo2->last_name}}</h3>
                <h5 class="widget-user-desc">Seller ID:<strong>{{$leveltwo2->seller_id}}</strong></h5>

              </div>
              <div class="widget-user-image">
                <img class="img-circle elevation-2" src="{{ asset('backend/img/tree.png')}}" alt="User Avatar">
              </div>

              <div class="card-footer">
                <div class="row">
                <div class="col-sm-12">
                    <div class="description-block">
                    <h6 >PCN:<strong>{{$leveltwo2->pcn}}</strong></h6>
<h6>Designation: <?php if($leveltwo2->grade){ echo "MSP";}?> {{$leveltwo2->grade}}</h6>
<h6>Total Matching:{{$leveltwo2->matches}}</h6>
<h6>Refference ID:{{$leveltwo2->ref_id}}</h6>

                    </div>
</div>
                 
                  <!-- /.col -->
                  <div class="col-sm-6 border-right">
                    <div class="description-block">
                      <h5 class="description-header">{{$totalA32*150}}</h5>
                      <span class="description-text">Team A Carry</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-6">
                    <div class="description-block">
                      <h5 class="description-header">
 {{$totalB32*150}}</h5>
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
              @else
                            <div class="col-md-3 col-sm-3 col-3" style="text-align:center;">
</div>
            @endif

<!--3-->
@if($leveltwo3)

<div class="col-md-3 col-sm-3 col-3" style="text-align:center;">
            
            <a href="{{ route('backend.tree.index',$leveltwo3->seller_id) }}">   <div class="card card-widget widget-user">
               <!-- Add the bg color to the header using any of the bg-* classes -->
               <div class="widget-user-header bg-info">
                 <h3 class="widget-user-username">{{$leveltwo3->first_name}} {{$leveltwo3->last_name}}</h3>
                 <h5 class="widget-user-desc">Seller ID:<strong>{{$leveltwo3->seller_id}}</strong></h5>
 
               </div>
               <div class="widget-user-image">
                 <img class="img-circle elevation-2" src="{{ asset('backend/img/tree.png')}}" alt="User Avatar">
               </div>
 
               <div class="card-footer">
                 <div class="row">
                 <div class="col-sm-12">
                     <div class="description-block">
                     <h6 >PCN:<strong>{{$leveltwo3->pcn}}</strong></h6>
 <h6>Designation: <?php if($leveltwo3->grade){ echo "MSP";}?> {{$leveltwo3->grade}}</h6>
 <h6>Total Matching:{{$leveltwo3->matches}}</h6>
 <h6>Refference ID:{{$leveltwo3->ref_id}}</h6>
 
                     </div>
 </div>
                  
                   <!-- /.col -->
                   <div class="col-sm-6 border-right">
                     <div class="description-block">
                       <h5 class="description-header">{{$totalA33*150}}</h5>
                       <span class="description-text">Team A Carry</span>
                     </div>
                     <!-- /.description-block -->
                   </div>
                   <!-- /.col -->
                   <div class="col-sm-6">
                     <div class="description-block">
                       <h5 class="description-header">
  {{$totalB33*150}}</h5>
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
                @else
                            <div class="col-md-3 col-sm-3 col-3" style="text-align:center;">
</div>

@endif
<!--4-->

@if($leveltwo4)
<div class="col-md-3 col-sm-3 col-3" style="text-align:center;">
            
            <a href="{{ route('backend.tree.index',$leveltwo4->seller_id) }}">   <div class="card card-widget widget-user">
               <!-- Add the bg color to the header using any of the bg-* classes -->
               <div class="widget-user-header bg-info">
                 <h3 class="widget-user-username">{{$leveltwo4->first_name}} {{$leveltwo4->last_name}}</h3>
                 <h5 class="widget-user-desc">Seller ID:<strong>{{$leveltwo4->seller_id}}</strong></h5>
 
               </div>
               <div class="widget-user-image">
                 <img class="img-circle elevation-2" src="{{ asset('backend/img/tree.png')}}" alt="User Avatar">
               </div>
 
               <div class="card-footer">
                 <div class="row">
                 <div class="col-sm-12">
                     <div class="description-block">
                     <h6 >PCN:<strong>{{$leveltwo4->pcn}}</strong></h6>
 <h6>Designation: <?php if($leveltwo4->grade){ echo "MSP";}?> {{$leveltwo4->grade}}</h6>
 <h6>Total Matching:{{$leveltwo4->matches}}</h6>
 <h6>Refference ID:{{$leveltwo4->ref_id}}</h6>
 
                     </div>
 </div>
                  
                   <!-- /.col -->
                   <div class="col-sm-6 border-right">
                     <div class="description-block">
                       <h5 class="description-header">{{$totalA34*150}}</h5>
                       <span class="description-text">Team A Carry</span>
                     </div>
                     <!-- /.description-block -->
                   </div>
                   <!-- /.col -->
                   <div class="col-sm-6">
                     <div class="description-block">
                       <h5 class="description-header">
  {{$totalB34*150}}</h5>
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




@endif






                  
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