@extends('backend.layouts.app')

@section('title', 'Admin List')

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
                <h1 class="m-0 text-dark">Admin List</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Admin</a></li>
                  <li class="breadcrumb-item active">Admin</li>
                  <li class="breadcrumb-item active">Admins</li>
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
                  <table id="datatable" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>#ID</th>

                      <th>Name</th>
                      <th>Email</th>

                      <th>Phone</th>
                                            <th>Grade</th>

                      <th>Created Date</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach ($admins as $key => $admin)    
                      <tr>
                        <td>{{ $admin->seller_id }}</td>
                        <td>{{ $admin->first_name }}{{ $admin->last_name }}</td>

                        <td>{{ $admin->email}}</td>
                        <td>{{ $admin->phone}}</td>

                                                <td>{{ $admin->grade}}</td>

                        <td>{{ $admin->created_at->format('j F, Y') }}</td>
                        <td>
                        <a href="{{ route('backend.admin.view', $admin->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                        <a href="{{ route('backend.admin.permission', $admin->id) }}" class="btn btn-sm btn-secondary"><i class="fas fa-key"></i></a>

                        <button class="btn btn-sm btn-danger" type="button" onclick="deleteTeam({{ $admin->id }})"><i class="fas fa-trash"></i></button>
                            <form id="delete-form-{{ $admin->id }}" action="{{ route('backend.team.destroy', $admin->id) }}" method="post" style="display: none;">
                              @csrf
                            </form>

                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                    <th>#ID</th>

                      <th>Name</th>
                      <th>Email</th>

                      <th>Phone</th>
                      <th>Created Date</th>
                      <th>Action</th>
                    </tr>
                    </tfoot>
                  </table>
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