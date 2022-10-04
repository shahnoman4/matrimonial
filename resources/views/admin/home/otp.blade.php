@extends('layouts.app')
@section('content')
@if(session('error'))
    <script>
      $( document ).ready(function() {
        swal("Failed", "{{session('error')}}", "error");
      });
      
    </script>
@endif
<div class="login-box">
  <div class="login-logo">
  <img src="{{ asset('img/logo.png') }}" width="310px">
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <h3 class="login-box-msg">Welcome <?php echo session()->get('fname').' '.session()->get('lname')?> </h3>
    <p class="login-box-msg text-red">Please enter your <b>OTP</b> to proceed further.<br><b>OTP</b> has been sent on your registered mobile number.</p>

    <form method="POST" action="./otp">
    @csrf
      <div class="form-group has-feedback">
        <input id="otp" type="number" class="form-control {{ $errors->has('otp') ? ' is-invalid' : '' }}" name="otp" value="{{ old('otp') }}" placeholder="One Time Password" required autofocus >
        <span class="fa fa-key form-control-feedback"></span>
        @if ($errors->has('otp'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('otp') }}</strong>
            </span>
        @endif
      </div>
      
      <div class="row">
        <div class="pull-right" style="margin-right: 15px;">
          <button type="submit" class="btn btn-primary btn-flat">
            {{ __('Login') }}
          </button>
        </div>
        <!-- Need to Remove below line -->
        <p class="login-box-msg text-red">Your OTP is: <?php echo session()->get('otp');?></p>
        <!-- /.col -->
      </div>
    </form>
    <!-- Logout Form-->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>  
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
@endsection