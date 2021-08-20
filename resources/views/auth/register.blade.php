@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<link href="{{ asset('register.css') }}" rel="stylesheet">
<script src="{{ asset('registerjs.js') }}" defer></script>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        @include('backend.layouts.flash');

            <div class="card animated bounceInDown myForm">
                <div class="card-header" style="text-align:center;"><h2>{{ __('Register') }}</h2></div>
                @if($errors->any())
<h4>{{$errors->first()}}</h4>
@endif

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" class="login-form">
                        @csrf
                          <div class="input-group mb-6">
                        <div class="input-group-append">
                          <span class="input-group-text" id="basic-addon2">Customer ID #</span>
                        </div>
                        <input type="text" class="form-control" placeholder="Customer ID" aria-label="Serial Number"
                          aria-describedby="basic-addon2" value="{{ str_pad($customer_id, $zero_fill, "0", STR_PAD_LEFT) }}" disabled>
                        <input type="hidden" name="customer_id" value="{{ $customer_id }}">
                      </div>

                        <div class="col form-group">
                                    <label for="first_name">First name</label>
                                    <input type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" id="first_name" value="{{ old('first_name') }}">
                                    @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col form-group">
                                    <label for="last_name">Last name</label>
                                    <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" id="last_name" value="{{ old('last_name') }}">
                                    @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">E-Mail Address</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="confirm_password" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                <span id='message'></span>
                            </div>
                        </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input class="form-control" type="text" name="address" id="address" value="{{ old('address') }}">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="city">Phone</label>
                                    <input type="text" class="form-control" name="phone" id="phone" value="{{ old('phone') }}">
                                </div>
                                
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="city">City</label>
                                    <input type="text" class="form-control" name="city" id="city" value="{{ old('city') }}">
                                   
                                </div>
                                
                               
                        

                        <div class="form-group row mb-0" style="text-align:center; padding-left:200px;">
                            <div class="col-md-12 offset-md-4" style="margin-bottom:10px;">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Register') }}
                                </button>
                                <a href="{{ url('/') }}"> <button type="button" class="btn btn-warning">
                                    {{ __('Go back') }}
                                </button></a>
                               
                            </div>
                            <div class="col-md-6 offset-md-4">
                            

                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script>
$('#password, #confirm_password').on('keyup', function () {
  if ($('#password').val() == $('#confirm_password').val()) {
    $('#message').html('Matching').css('color', 'green');
  } else 
    $('#message').html('Not Matching').css('color', 'red');
});

</script>
@endsection
