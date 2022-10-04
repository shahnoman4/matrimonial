@extends('layouts.app')
@section('content')
@if(session('error'))
    <script>
      $( document ).ready(function() {
        swal("Failed", "{{session('error')}}", "error");
      });

    </script>
@endif
<style>
    .login-page, .register-page {
    background: #333;
}
</style>
<div class="login-box">
  <div class="login-logo">
  <img src="https://free-matrimonial.com/assets/img/logo-white.png">
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Login in to start your session</p>

    <form method="POST" action="{{ route('login') }}">
    @csrf
      <div class="form-group has-feedback">
        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        @if ($errors->has('email'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
      </div>
      <div class="form-group has-feedback">
        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required >
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        @if ($errors->has('password'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck" style="margin-left: 20px;">
            <label>
              <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">
            {{ __('Login') }}
          </button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <a class="btn btn-link" href="#">
        {{ __('Forgot Your Password?') }}
    </a>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
@endsection
