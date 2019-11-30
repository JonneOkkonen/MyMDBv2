@extends('layouts.app')

@section('styles')
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
@endsection

@section('heading')
    <div class="register-form">
        <h2 class="header">{{ __('Change Password') }}</h2>

        <div class="card-body">
        <form  class="form-horizontal" method="POST" action="{{ url('changePassword') }}">
            @csrf

            @if (session('msg'))
                <div class="alert alert-danger">
                    {{ session('msg') }}
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="form-group row">
                <div class="col-md-8 offset-md-2">
                    <input id="oldPassword" type="password" class="form-control @error('oldPassword') is-invalid @enderror" 
                            name="oldPassword" value="{{ old('oldpassword') }}" required autocomplete="oldPassword"
                            placeholder="Old Password">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-8 offset-md-2">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                            name="password" required autocomplete="new-password" placeholder="Password">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-8 offset-md-2">
                    <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" 
                            required autocomplete="new-password" placeholder="Confirm new password">
                </div>
            </div>
            <br>
            <div class="form-group">
                <div class="col-md-8 offset-md-2">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Change Password') }}
                    </button>
                </div>
            </div>
            </form>
        </div>
    </div>
@endsection
