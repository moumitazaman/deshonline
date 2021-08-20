@extends('frontend.layouts.app-cart')

@section('title', 'Cart')

@section('content')
<link rel="stylesheet" href="{{ asset('backend/plugins/sweetalert2/sweetalert2.min.css') }}">
<script src="{{ asset('frontend/js/jquery-3.3.1.min.js') }}"></script>

    


    <div class="container" style="margin-top: 50px">
    <div style="text-transform:uppercase; margin: 0 auto; color: #a19a9a; text-align:center">
    <h2>Your Order Has been Confirmed</h2>              
			</div>
        
 
     
        <div class="row justify-content-center">
                
                       
                    <br><a href="{{ url('/clear') }}" class="btn pointer btn-dark">Continue Shopping</a>
                </div>
        </div>
        <br><br>
    </div>
    <script src="{{ asset('backend/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

    <script>
<?php for($i=1;$i<20;$i++){?>
    $( ".increment-btn<?php echo $i;?>" ).click(function() {
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
                      data:{id:id},
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
@endsection


@section('scripts')

@endsection