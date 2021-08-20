@extends('backend.layouts.app')

@section('title', 'Create Funds')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Funds</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Funds</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        {{-- Messages will display here --}}
        @include('backend.layouts.flash')
        <div class="card card-default">
          <!-- form -->
          <form action="{{ route('backend.funds.update','1') }}" id="sales_info" method="POST">
            @csrf
            @method('PUT')

            <div class="card-header">
              <h3 class="card-title">Fund Settings</h3> 
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-md-6 offset-md-3">
                  
                  <div class="form-group">
                    <label for="email">Referrence</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="referrence" placeholder="Referrence Point" value="{{ $settings->referrence }}">
                     
                        
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="email">Affiliate</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="affiliate" placeholder="affiliate" value="{{ $settings->affiliate}}">
                       
                       
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="email">M.S.P</label>
                    <div class="input-group">
                        <input type="text" class="form-control " name="msp" placeholder="M.S.P Points" value="{{ $msp }}">
                         <a href="{{ route('backend.msp.create') }}"><button type="button" class="btn btn-md btn-primary"><i class="fas fa-link"></i> More</button>
</a>
                                                                        <input type="text" class="form-control" name="dbmsp" placeholder="Total MSP Points" value="{{ $msptotal }}" readonly>
<a href="{{ route('backend.msp.distribute') }}"><button type="button" class="btn btn-md btn-danger"><i class="fas fa-power-off"></i> Distribute</button>
</a>
                       
                       
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="email">Royality</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="royality" placeholder="Royality Points" value="{{ $tot }}">
                                                <input type="text" class="form-control" name="dbroyality" placeholder="Total Royality Points" value="{{ $totalroyal }}" readonly>

                          <a href="{{ route('backend.royality.distribute') }}"><button type="button" class="btn btn-md btn-primary"><i class="fas fa-power-off"></i> Distribute</button>
</a>
                       
                    </div>
                  </div>



                  <div class="form-group">
                    <label for="email">Reward</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="reward" placeholder="Reward Points" value="{{ $settings->reward }}">
                       
                        
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="email">Charitable Fund</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="charity"  placeholder="Charity Points" value="{{ $settings->charity }}">
                       
                       
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="email">Dealership</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="dealership"  placeholder="Dealership" value="{{ $settings->dealership }}">
                       
                      
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="email">Matching</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="matching"  placeholder="Matching Points" value="{{ $settings->matching }}">
                      
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="email">Company Profit</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="profit"  placeholder="Company Profit Point" value="{{ $settings->profit }}">
                       
                        
                    </div>
                  </div>
                


                  <div class="row">
                    <div class="col-md-6">
                      <button type="submit" class="btn btn-md btn-success"><i class="fas fa-save"></i> Save</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.row -->
            </div>
          </form>
          <!-- /.form -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection