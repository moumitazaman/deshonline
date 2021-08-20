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
            .col-md-12 .col-md-4 {
                margin: auto;
            }

            @media only screen and (max-width: 600px) {
                .col-3 .img-circle {
                    display: none;
                }

                .col-3 .widget-user .widget-user-username {
                    font-size: 14px;
                }

                .col-3 h5 {
                    font-size: 1.2rem;
                }

                .col-3 h6 {
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
                            @foreach($data_set as $refer_user)
                                <div class=" @if($refer_user['level'] == 1) col-md-12 col-sm-12 col-12 @elseif($refer_user['level'] == 2) col-md-6 col-sm-6 col-6  @elseif($refer_user['level'] == 3) col-md-3 col-sm-3 col-3 @endif" style="text-align:center;">
                                    <!-- Widget: user widget style 1 -->
                                    <a href="{{ route('backend.tree.index',$refer_user['seller_id']) }}">
                                        <div class="card card-widget widget-user">
                                            <!-- Add the bg color to the header using any of the bg-* classes -->
                                            <div class="widget-user-header bg-info">
                                                <h3 class="widget-user-username">{{$refer_user['name'] }}</h3>
                                                <h5 class="widget-user-desc">Seller
                                                    ID:<strong>{{$refer_user['seller_id'] }}</strong></h5>

                                            </div>
                                            <div class="widget-user-image">
                                                <img class="img-circle elevation-2" src="{{ asset('backend/img/tree.png')}}"
                                                     alt="User Avatar">
                                            </div>

                                            <div class="card-footer">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="description-block">
                                                            <h6>PCN:<strong>{{$refer_user['pcn'] }}</strong></h6>
                                                            <h6>Designation:
                                                                @if($refer_user['grade']) "MSP" @endif
                                                                {{ $refer_user['grade'] }}
                                                            </h6>
                                                            <h6>Total Matching:{{ $refer_user['matches'] }}</h6>
                                                            <h6>Refference ID:{{ $refer_user['ref_id'] }}</h6>

                                                        </div>
                                                    </div>

                                                    <!-- /.col -->
                                                    <div class="col-sm-6 border-right">
                                                        <div class="description-block">
                                                            <h5 class="description-header">{{ '$refer_user*150'}}</h5>
                                                            <span class="description-text">Team A Carry</span>
                                                        </div>
                                                        <!-- /.description-block -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col-sm-6">
                                                        <div class="description-block">
                                                            <h5 class="description-header">{{'$refer_user*150'}}</h5>
                                                            <span class="description-text">Team B Carry</span>
                                                        </div>
                                                        <!-- /.description-block -->
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.row -->
                                            </div>
                                        </div>
                                    </a>
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

        function deleteRole(id) {
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
                    $('#delete-form-' + id).submit();
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
