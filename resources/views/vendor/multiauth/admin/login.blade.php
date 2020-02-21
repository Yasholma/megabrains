@extends('multiauth::layouts.app') 
@section('content')

<div class="container-scroller mt-5">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
        <div class="row w-100 mx-auto">
            <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left p-5">
                <div class="brand-logo">
                    <img src="{{ asset('admin_assets/images/logo.jpg') }}" alt="MegaBrains">
                </div>
                <h4>{{ ucfirst(config('multiauth.prefix')) }} Login</h4>
                <h6 class="font-weight-light">Log in to continue.</h6>
                <form method="POST" class="pt-3" action="{{ route('admin.login') }}" aria-label="{{ __('Admin Login') }}">
                    @csrf

                    <div class="form-group">
                        <input type="email" class="form-control form-control-lg {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" id="email" placeholder="Email Address" required autofocus >
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span> 
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control form-control-lg {{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" name="password" placeholder="Password">
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span> 
                        @endif
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-block btn-md btn-gradient-primary font-weight-small auth-form-btn">
                            {{ __('Login') }}
                        </button>
                    </div>
                    <div class="form-check mt-1 d-flex align-items-center">
                        <div class="col-md-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old( 'remember') ? 'checked' : '' }}>
                                <label class="form-check-label text-muted" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>

                            <a class="btn btn-link text-black auth-link" href="{{ route('admin.password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        </div>
                    </div>
                    <div class="mb-2">
                        <button type="button" class="btn btn-block btn-sm btn-facebook auth-form-btn">
                        <i class="mdi mdi-facebook mr-2"></i>Connect using facebook
                        </button>
                    </div>
                    <div class="text-center mt-4 font-weight-light d-none">
                        Don't have an account? <a href="{{ route('admin.register') }}" class="text-primary">Create</a>
                    </div>
                </form>
            </div>
            </div>
        </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
    <!-- container-scroller -->
@endsection