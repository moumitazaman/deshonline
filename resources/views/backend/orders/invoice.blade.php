@extends('backend.layouts.app')

@section('title', 'View Order')

@push('styles')
<!-- Select2 -->
  <link rel="stylesheet" href="{{asset('backend/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endpush

@section('content')
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            {{-- Messages will display here --}}
            @include('backend.layouts.flash')
            <div class="row mb-2">
              
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
  
        <!-- Main content -->
        <div class="content">
          <div class="container-fluid">
            <div class="card card-default">
<div style="margin-top:2px; text-align:center;">
<button onclick="window.print()" class="btn btn-warning"><i class="fas fa-print"></i>Print</button>


</div>
              <!-- form -->
              <form class="bgimg">
                @csrf
                <div class="card-header" style="margin-top:50px;">
                <div class="col-sm-12">
                <h3 style="margin-top:10px; text-align: center; font-size: 20px; font-weight: bold; padding: 0px;">Receipt Voucher</h3>
                <span  id="basic-addon2">Invoice#: </span>{{ $agent->order_id }}
                <span style="float:right;" >Date: <?php echo $currentdate=date('Y-m-d H:i:s'); ?></span>


              </div>
  
                  
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                  <div class="col-sm-8 lilb">
                  <div class="col-md-6" style="float:left;">
                      <div class="form-group">
                      <?php 
                        $uid= $agent->user_id;
                        $user= DB::table('users')->where('id',$uid)->first();

                        ?>

<span>{{  $user->first_name }} {{  $user->last_name }}</span>  <br>
<span>                  {{ $user->address}}
</span> 
<span>                    {{$user->email}}
</span><br>
                    {{$user->phone}}                     
                      </div>
                      <div class="form-group">
                       
                      </div>
                      <div class="form-group">
                      
                        
                      </div>
                    </div>
                    <!-- To Fields -->
                    <div class="col-md-4"  style="float:right;">
                      
                    </div>
                  

                  </div>
                  <div class="col-sm-4 lilb" style="text-align:right;">
                  
                  

                    <div>
                    <div class="form-group" style="padding-right:45px;">
                     
                      
                    </div>

                    <div>
                      <div class="form-group">

                       
                      </div>
                      </div>

                    <div>
                    <div class="form-group" style="padding-right:25px;">
                          <span id="basic-addon2">Order Date: </span>{{ $agent->order_date }}
                       
                        
                      </div>
                    </div>

                   

                  </div>
                   
                    <!-- Serial & Voucher -->
                    
                    <!-- Vat No. -->
                    
                    <!-- Date -->
                   
                    <!-- From Fields -->
                  
                    <!-- AWB & Delivery Place -->
                    
                     
                    </div>
                  </div>
                   <!-- /.row -->
                  <div class="row" style="margin-top:100px;">
                    <div class="col-md-12">
                    <div style="text-align:center;">
                    <label >Product List</label>
                    </div>

                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                             <label>Products</label>
                          </div>
                        </div>
                       
                      </div>
                      <div id="more_field">
                        <div class="row multi-field" id="row">
                          <div class="col-md-6">
                            <div class="form-group">
                            <table class="table nob">
                            <tr>
                      <th>Name</th>
                      <th>Price</th>

                      <th>No. of items</th>


                      <th>Amount</th>

                            </tr>
                            <?php 
                            $oid=$agent->order_id;
                            $prod= DB::table('order_details')->where('order_id',$oid)->get();


                            ?>
                           
                            @foreach ($prod as $pro)
                               
                                
                                <?php 
                            $products= DB::table('product')->where('id',$pro->product_id)->get();

                                ?>
                                @foreach ($products as $product)
                                <tr>
                                <td>{{$product->product_name}}</td>
                                <td>{{$product->price}}</td>

                                <td>{{$pro->totalquantity}}</td>
                                <td>{{$pro->total_price}}</td>
                                </tr>

                                @endforeach
                                @endforeach
                             
                              </table>
                            </div>
                          </div>
                     
                          
                        </div>
                      </div>
                    
                    </div>
                 
                    
                      <div class="col-sm-12" style="margin-top:50px;">
                      <div class="col-sm-8" style="float:left;">
                      </div>
                      <div class="col-sm-4" style="text-align:right;padding-right:150px; float:right; font-size:20px;border:1px solid #cccccc;"><label for="Total" style="padding-right:5px;">Total: </label>{{ $agent->total_amount}}</div>

                      

                      </div>
                     
                          <!-- .row -->
                          
                          <!-- /.row -->
                          <div class="row">
                            <div class="col-md-12 offset-md-6">
                              <div class="form-group">
                              </div>
                            </div>
                            <div class="col-md-4">
                              <input name="total" id="result_hidden" type="hidden">
                            </div>
                          </div>
                          <!-- /.row -->
                          <div class="col-sm-12" style="margin-top:300px;">
                        </div>
                      </div>
                      <!-- /.card-body -->
                    </div>
                  </div>
                  <!-- /.row -->
                  <div class="row" style="margin-top:20px; text-align:center;">
                    <div class="col-md-4 offset-md-4">
                      <!-- VAT is here -->
                      <button onclick="window.print()" class="btn btn-warning"><i class="fas fa-print"></i>Print</button>


                    </div>
                  </div>
                </div>
              </form>
              <!-- /.form -->

            </div>
            <!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
      </div>
                 
                    
@endsection

@push('scripts')
<!-- Select2 -->
  <script src="{{asset('backend/plugins/select2/js/select2.full.min.js')}}"></script>
<!-- InputMask -->
  {{-- <script src="{{asset('backend/plugins/moment/moment.min.js')}}"></script>
  <script src="{{asset('backend/plugins/inputmask/min/jquery.inputmask.bundle.min.js')}}"></script> --}}
<!-- Custom JS -->
  <script type="text/javascript">
    
    
      


    
  </script>
@endpush