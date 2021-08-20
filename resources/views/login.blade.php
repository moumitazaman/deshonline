@extends('layouts.app')

@section('content')
<link href="{{ asset('login.css') }}" rel="stylesheet">


<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="fadeIn first">
      <h1>Admin Panel</h1>
    </div>

    <!-- Login Form -->
    <form class="login-form" action="{{ route('adminlogin.post') }}" method="POST" role="form">
    @csrf
      <input class="fadeIn second" id="login" type="text" id="mobile_no" name="mobile_no" placeholder="Mobile Number" autofocus value="{{ old('mobile_no') }}">
     
      <input class="fadeIn third" type="password" id="password" name="password" placeholder="Password">
     
      <input type="submit" class="fadeIn fourth" value="Log In">
    </form>

    <!-- Remind Passowrd -->
    

  </div>
</div>
@endsection