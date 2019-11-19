@extends('layouts.app')

@section('styles')
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
@endsection

@section('heading')
    <div class="loginForm">
        <h2 class="header">{{ __('Login') }}</h2>

        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <div class="col-md-8 offset-md-2">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="{{ __('E-Mail Address') }}" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-8 offset-md-2">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="{{ __('Password') }}" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-8 offset-md-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-8 offset-md-2">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Login') }}
                        </button>
                    </div>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-2">
                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
