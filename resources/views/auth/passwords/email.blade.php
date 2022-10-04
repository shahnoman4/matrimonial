@extends('layouts.app')

@section('content')
<div class="login-box">
  <div class="login-logo">
    <img src="{{ asset('img/logo.png') }}">
  </div>
<div class="login-box-body">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            <p class="login-box-msg">Reset your password</p>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-12 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                        <a class="btn btn-link" href="{{ route('home') }}">
                            {{ __('Back to Login') }}
                            
                        </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
