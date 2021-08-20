@extends('frontend.layouts.app')

@section('title', 'Cart')

@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/product_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/product_responsive.css')}}">



<link rel="stylesheet" href="{{ asset('backend/plugins/sweetalert2/sweetalert2.min.css') }}">
<script src="{{ asset('frontend/js/jquery-3.3.1.min.js') }}"></script>

    


    <div class="container" style="margin-top: 20px">
    <?php 
		$settings=App\Settings::where('id',1)->first();


				?>
        
        @if(session()->has('success_msg'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('success_msg') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        @endif
        @if(session()->has('alert_msg'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session()->get('alert_msg') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        @endif
        @if(count($errors) > 0)
            @foreach($errors0>all() as $error)
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ $error }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            @endforeach
        @endif
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <br>
                @if(\Cart::getTotalQuantity()>0)
                    <h4><span id="qtyold">{{ \Cart::getTotalQuantity()}}</span><span id="qty"></span> Product(s) In Your Cart</h4><br>
                @else
                    <h4>No Product(s) In Your Cart</h4><br>
                    <a href="{{url('/')}}" class="btn btn-dark">Continue Shopping</a>
                @endif
                <?php $count =1;?>
                
                @foreach($cartCollection as $item)
               

                    <div class="row cg{{ $item->id}}" style="padding-left: 30px;">
                        <div class="col-lg-3">
                            <img src="<?php echo asset('/').'uploads/'.$item->associatedModel->img_name; ?>" class="img-thumbnail" width="200" height="200">
                        </div>
                        <div class="col-lg-5 nodesign">
                            <p>
                                <b><a href="{{url('/')}}">{{ $item->name }}</a></b><br>
                                <b>Price: </b>{{$settings->currency}}<input type="text" value="{{ $item->price}}" class="price" name="price" disabled>
<br>
                                <b>Sub Total: </b>{{$settings->currency}}<input type="text" value="{{ \Cart::get($item->id)->getPriceSum() }}" class="subtotal<?php echo $count;?>" disabled><br>
                                {{--                                <b>With Discount: </b>${{ \Cart::get($item->id)->getPriceSumWithConditions() }}--}}
                            </p>
                        </div>
                        <div class="col-lg-4">
                            <div class="row">
                            <?php 
                            $products = App\Product::where('id',$item->id)->first();

                            $prototal=$products->quantity;
                            
                            ?>
                                <form action="{{ route('cart.update') }}" class="sendupdate<?php echo $count;?>" method="POST">
                                    {{ csrf_field() }}
                                    <div class="form-group row">

                                        <!--<input type="number" class="quantity form-control form-control-sm" value="{{ $item->quantity }}"
                                                  name="quantity" oninput="this.value = Math.abs(this.value)" style="width: 70px; margin-right: 10px;">-->
                                                  <input type="hidden" class="rowId<?php echo $count;?>" value="{{$item->rowId}}"/>
                                                  <input type="hidden" value="{{ $prototal}}" class="prototal<?php echo $count;?>" name="prototal" disabled>

        <input type="hidden" name="proId" class="proId<?php echo $count;?>" value="{{$item->id}}"/>
        <input type="hidden" value="{{ $item->price}}" class="price<?php echo $count;?>" name="price" disabled>
        <input type="text" size="2" value="{{$item->quantity}}" name="qty" class="qty<?php echo $count;?>"
               autocomplete="off" style="text-align:center; max-width:50px; margin-left:70px; "  MIN="1" MAX="30">
                                       
                                        <button type="button"  class="pointer btn btn-secondary btn-sm decrement-btn<?php echo $count;?>"  style="margin-right: 15px;"><i class="fa fa-minus"></i></button>
                                        

                                        <button type="button"  data-quantity="{{$item->quantity}}"  class=" pointer btn btn-secondary btn-sm increment-btn<?php echo $count;?>"  style="margin-right: 25px;"><i class="fa fa-plus"></i></button>

                                    </div>
                                </form>
                                <form class="sendid">
                                    {{ csrf_field() }}
                                    <input type="hidden" value="{{ $item->id }}" class="did" name="did">
                                            <input type="hidden" size="2" value="{{$item->quantity}}" name="qty" class="qty<?php echo $count;?>">

                                    <button type="button" data-id="{{$item->id}}"  class="remove-item<?php echo $count;?> pointer btn-danger btn-sm" style="margin-right: 10px;"><i class="fa fa-times"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <?php $count++;?>

                @endforeach
               
            </div>
            @if(count($cartCollection)>0)
                <div class="col-lg-5">
                    <div class="card">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><b>Total: </b><span id="totalold">{{$settings->currency}}{{ \Cart::getTotal() }}</span><span id="total"></span></li>

                        </ul>
                    </div>
                    <br><a href="{{ url('/') }}" class="btn btn-dark">Continue Shopping                         <span id="prototal"></span>
</a>
                    <a href="{{ route('checkout.index') }}" class="btn btn-success">Proceed To Checkout</a>
                </div>
            @endif
        </div>
        <br><br>
    </div>
    <script src="{{ asset('backend/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

    <script>
<?php for($i=1;$i<20;$i++){?>
    $( ".increment-btn<?php echo $i;?>" ).click(function() {
        var prototal=$('.prototal<?php echo $i;?>').val()-1;
if(prototal == 0){
    Swal.fire({
        text: 'Product Out of Stock',
		type: 'error',
		timer: 3000,
		showCancelButton: false,
  showConfirmButton: false
        
      })

}
else{

        var $counter = $('.qty<?php echo $i;?>');
    $counter.val( parseInt($counter.val()) + 1 );
    var num=$('.qty<?php echo $i;?>').val();
    var price= $('.price<?php echo $i;?>').val();
    var subtotal=price*num;
    $('.subtotal<?php echo $i;?>').val(subtotal);

    $.ajax({
	 headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
},  
   type:"POST",
   url: "{{route('cart.update')}}",
   data:$('.sendupdate<?php echo $i;?>').serializeArray(),

   success:function(data){

    $('#totalold').hide(300);
    $('#qtyold').hide(200);

    $('#qty').text(data.no);

    $('#total').text(data.total);

	

	  
   },
   error:function(error){
	 console.log(error)
	 alert("not send");
   },

   
 });
 
}

    });


    $( ".decrement-btn<?php echo $i;?>" ).click(function() {
        var $counter = $('.qty<?php echo $i;?>');
        if($counter.val()>1){
            $counter.val( parseInt($counter.val()) - 1 );
            var num=$('.qty<?php echo $i;?>').val();
    var price= $('.price<?php echo $i;?>').val();
    var subtotal=price*num;
    $('.subtotal<?php echo $i;?>').val(subtotal);
    
    $.ajax({
	 headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
},  
   type:"POST",
   url: "{{route('cart.update')}}",
   data:$('.sendupdate<?php echo $i;?>').serializeArray(),

   success:function(data){
    $('#totalold').hide(300);
    $('#qtyold').hide(200);

    $('#qty').text(data.no);

    $('#total').text(data.total);
  
	

	  
   },
   error:function(error){
	 console.log(error)
	 alert("not send");
   },

   
 });

        }
        else if($counter.val()==0) {
            $counter.val()=1;

        }
        else{
            $counter.val( parseInt($counter.val()));

        }
    });



    $( ".remove-item<?php echo $i;?>" ).click(function() {

        var id = $(this).data("id");
        var quant = $('.qty<?php echo $i;?>').val();

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Remove it!'
      }).then((result) => {
        if (result.value) {
            $.ajax({
                        headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },  
                      type:"POST",
                      url: "{{ route('cart.remove')}}",
                      data:{id:id,quant:quant},
                      success:function(data){
                        $('.cg'+id).hide(200);
                        $('#qtyold').hide(200);
                        $('#totalold').hide(200);


                        $('#qty').show(300);
                        $('#total').show(300);


                        $('#qty').text(data.qty);
                        $('#total').text(data.total);

                        window.location.reload();


                      }


                      
                      
                    });
                    
        }

      });

    });
    


<?php }?>


    </script>

    <style>
   .nodesign input{
        border:none;
        box-shadow:none;
        text-shadow:none;
        background:none !important;
    }
    
    </style>
@endsection


@section('scripts')

@endsection