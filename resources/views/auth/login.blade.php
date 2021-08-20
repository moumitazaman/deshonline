@extends('layouts.app')

@section('content')
<link href="{{ asset('login.css') }}" rel="stylesheet">
<div class="wrapper fadeInDown">
  <div id="formContent">

  {{-- Messages will display here --}}
            @include('backend.layouts.flash')
            <div class="card">
                <div class="card-header"><strong>{{ __('Login') }}</strong></div>
                <div class="logo"><a href="{{ url('/') }}"><img  class="img-responsive"  src="{{ asset('frontend/images/logo.jpg')}}"/></a></div>


                    <form method="POST" action="{{ route('login') }}" class="login-form" role="form">
                        @csrf

                        <div class="form-group row">
                            <label for="mobile_no" class="col-md-4 col-form-label text-md-right">{{ __('User ID #') }}</label>

                            <div class="col-md-6">
                                <input id="mobile_no" type="text" class="fadeIn second form-control @error('mobile_no') is-invalid @enderror" name="mobile_no" value="{{ old('mobile_no') }}" required >

                                @error('mobile_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="fadeIn third form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12 ">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Login') }}
                                </button>
                                <br>
                                <a class="btn btn-link" href="{{ route('register') }}">
                                <button type="button" class="btn btn-warning">

                                        {{ __('Create New Account') }}
                                        </button>
                                    </a>
                                    <a class="btn btn-link" href="{{ route('admin.registerform') }}">
                                    <button type="button" class="btn btn-danger">

                                        {{ __('Become a Seller?') }}
                                        </button>
                                    </a>
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                    <button type="button" class="btn btn-primary">

                                        {{ __('Forgot Your Password?') }}
                                        </button>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                
            </div>
    
</div>
</div>
@endsection
