@extends('backend.layouts.app')

@section('title', 'Tree List')

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
                <h1 class="m-0 text-dark">Level 1</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
               
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
                  <table id="datatable" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>#ID</th>

                      <th>Name</th>
                      <th>Carry</th>
 <th>Total Carry</th>
                      <th>Refference ID </th>
                      <th>Grade</th>

                      <th>Created Date</th>
                     
                    </tr>
                    </thead>
                    <tbody>
                        <?php 
                      $teams = app\User::where('role_id',3)->skip(0)->take(2)->get();
                      $totalleftA=0;
                      $totalleftB=0;
                      $totalrightA=0;
                      $totalrightB=0;
                      $no=2;
                      
                        $one=App\User::where('role_id',3)->where('id','>',$teams[0]['id'])->where('wings','left')->where('track',1)->get();
                    
                        foreach($one as $o){
                          $carr=App\Order::latest()->where('user_id',$o->id)->get();  
                          foreach($carr as $c){
                        $totalleftA+=$c->total_item;
                    }   
                   
                        }
                         $totalleftA;
                         
        $two=App\User::where('role_id',3)->where('id','>',$teams[0]['id'])->where('wings','left')->where('track',2)->get();
        
         foreach($two as $t){
                          $carrb=App\Order::latest()->where('user_id',$t->id)->get();  
                          foreach($carrb as $cb){
                       $totalleftB+=$cb->total_item;
                    }   
                   
                        }
                         $totalleftB;

                    

 $three=App\User::where('role_id',3)->where('id','>',$teams[1]['id'])->where('wings','right')->where('track',1)->get();

  foreach($three as $th){
                          $carrth=App\Order::latest()->where('user_id',$th->id)->get();  
                          foreach($carrth as $cth){
                       $totalrightA+=$cth->total_item;
                    }   
                   
                        }
                         $totalrightA;
        $four=App\User::where('role_id',3)->where('id','>',$teams[1]['id'])->where('wings','right')->where('track',2)->get();
      
foreach($four as $fo){
                          $carrf=App\Order::latest()->where('user_id',$fo->id)->get();  
                          foreach($carrf as $cf){
                       $totalrightB+=$cf->total_item;
                    }   
                   
                        }
                         $totalrightB;
                        
                        $count=0;
                        
                                                $sellers = App\User::where('role_id',3)->skip(0)->take(2)->get();
                                               
   
                        ?>
                        
                      @foreach ($sellers as $key => $seller)  
                      <?php $count++;?>
                              <tr>
                        <td>{{ $seller->seller_id }}</td>
                        <td>{{ $seller->first_name }} {{ $seller->last_name }}</td>
<td><?php 
$total=0;
$carries=App\Order::latest()->where('user_id',$seller->id)->get();
                    foreach($carries as $carry){
                      $total+=$carry->total_item;
                    }   
                    echo $total;
   
?></td>
<td> 
<?php 
 $totalcarryA=0;
                      $totalcarryB=0;
$two=App\User::where('role_id',3)->where('id','>',$seller->id)->where('wings',$seller->wings)->where('track',1)->get();
        
        foreach($two as $t){
                          $carrb=App\Order::where('user_id',$t->id)->get();  
                          
                          foreach($carrb as $cb){
                        $totalcarryA+=$cb->total_item;
                    } 
                   
        }
                    echo "Carry A=".$totalcarryA;
                    
                    $three=App\User::where('role_id',3)->where('id','>',$seller->id)->where('wings',$seller->wings)->where('track',2)->get();
        
        foreach($three as $th){
                          $carr=App\Order::where('user_id',$th->id)->get();  
                          foreach($carr as $c){
                         $totalcarryB+=$c->total_item;
                    } 
        }
                    echo "Carry B=".$totalcarryB;

?></td>
                        <td>{{ $seller->ref_id}}</td>

                        <td>{{ $seller->grade}}</td>

                        <td>{{ $seller->created_at->format('j F, Y') }}</td>
                       
                      </tr>    
    
                      @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                    <th>#ID</th>

                      <th>Name</th>
                      <th>Carry</th>
<th>Total Carry</th>
                      <th>Refference ID </th>
                      <th>Grade</th>
                      <th>Created Date</th>
                      
                    </tr>
                    </tfoot>
                  </table>
                   <div style="text-align:center;">
                        <a href="{{ route('backend.tree.level', [$count,$no]) }}" class="btn btn-sm btn-success">Downline<i class="fas fa-angle-right"></i></a>
                      
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

    function deleteTeam(id){
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