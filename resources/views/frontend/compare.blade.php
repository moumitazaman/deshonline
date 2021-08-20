<script src="{{ asset('frontend/js/jquery-3.3.1.min.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/bootstrap4/bootstrap.min.css')}}">
<script src="{{ asset('frontend/styles/bootstrap4/bootstrap.min.js')}}"></script>
<script src="{{ asset('frontend/styles/bootstrap4/popper.js')}}"></script>
<link rel="stylesheet" href="{{ asset('backend/plugins/sweetalert2/sweetalert2.min.css') }}">

<script src="{{ asset('backend/plugins/sweetalert2/sweetalert2.min.js') }}"></script>



    <div class="container" style="margin-top: 80px">
       
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-7">
                        <h4>Compare</h4>
                    </div>
                </div>
                <hr>
                <div class="row">

                <?php 
                $ids = session()->get( 'ids' );
                $idarr=explode(",",$ids);
                ?>
                @foreach($idarr as $id)
                <?php
                
                $products= DB::table('product')->where('id',$id)->get();
                    ?>
                    @foreach($products as $pro)
                        <div class="col-lg-3">
                            <div class="card" style="margin-bottom: 20px; height: auto;">
                                <img src="<?php echo asset('/').'uploads/'.$pro->img_name;?>"
                                     class="card-img-top mx-auto"
                                     style="height: 150px; width: 150px;display: block;"
                                >
                                <div class="card-body">
                                    <a href=""><h6 class="card-title">{{ $pro->product_name }}</h6></a>
                                    <p>${{ $pro->price }}</p>
<table class="table table-bordered">
  <thead>
    <tr>
      
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">Processor</th>
      <td>details</td>
     
    </tr>
    <tr>
      <th scope="row">RAM</th>
      <td>details</td>
     
    </tr>
    
    
  </tbody>
</table>
                                    <form class="sendform">
                                        {{ csrf_field() }}
                                        <input type="hidden" value="{{ $pro->id }}" class="id" name="pid">
                                        <input type="hidden" value="{{ $pro->product_name }}" id="name" name="name">
                                        <input type="hidden" value="{{ $pro->price }}" id="price" name="price">
                                        <input type="hidden" value="{{ $pro->img_name }}" id="img" name="img">
                                        <input type="hidden" value="1" id="quantity" name="quantity">
                                        <div class="card-footer" style="background-color: white;">
                                              <div class="row">
                                              <button type="button" data-id="{{$pro->id}}"  onclick="myFunc(this.form)"  class="pointer btn btn-secondary btn-sm  active" class="tooltip-test" title="add to cart">
                                                    <i class="fa fa-shopping-cart"></i> Add to Cart
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @endforeach

                </div>
            </div>
        </div>
    </div>
    <script>
	function myFunc(form) {

$.ajax({
	 headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
},  
   type:"POST",
   url: "{{route('cart.add')}}",
   data:$(form).serializeArray(),

   success:function(data){
	Swal.fire({
        text: 'Product Added',
		type: 'success',
		timer: 2000,
		showCancelButton: false,
  showConfirmButton: false
        
      })
   },
   error:function(error){
	 console.log(error)
	 alert("not send");
   },

   
 });


}
    </script>
