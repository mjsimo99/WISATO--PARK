@extends('layouts.guest')

@section('content')
<div id="login-page">
    <div class="container-fluid vh-100">
        <div class="align-content-center h-100 justify-content-center row">
            <div class="col-lg-3 col-sm-12 py-4">
                <div class="login-card bg-light card shadow-lg">
                    <div class="card-header f20 font-weight-bold text-center">{{ __('Admin Login') }}</div>

                    <div class="card-body">
                        <form method="POST" id="loginForm" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group">
                                <label for="email" class="col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email"
                                    class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                                    value="{{ old('email') ? old('email') : (env('DEMO', false) ? env('ADMIN_EMAIL', NULL) : '') }}" placeholder="E-Mail" required autofocus>
                                @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="password" class="text-md-right">{{ __('Password') }}</label>
                                <input id="password" type="password" value="{{ env('DEMO', false) ? env('ADMIN_PASSWORD', NULL) : '' }}" placeholder="*****"
                                    class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                                    required>

                                @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input m-1" type="checkbox" name="remember" id="remember" {{
                                        old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>

                            <div class="form-group mb-0">
                                <button type="submit" class="col-12 f18 btn btn-car">
                                    {{ __('Login') }}
                                </button>
                                @if(env('DEMO', false))
                                <div class="pt-2 text-center text-danger">Just click the above button to Login</div>
                                <div class="pt-3 text-center">
                                    <div class="btn btn-outline-twitter btn-xs btn-credential" data-email="{{ env('ADMIN_EMAIL', NULL) }}" data-password="{{ env('ADMIN_PASSWORD', NULL) }}">Admin Credential</div>
                                    <div class="btn btn-outline-twitter btn-xs btn-credential" data-email="{{ env('OPERATOR_EMAIL', NULL) }}" data-password="{{ env('OPERATOR_PASSWORD', NULL) }}">Operator Credential</div>
                                </div>
                                @endif

                                @if (Route::has('password.request'))
                                <a class="btn btn-link text-car pl-0 pt-3" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
</div>
@endsection