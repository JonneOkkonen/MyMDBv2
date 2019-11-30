@extends('layouts.app')

@section('scripts')
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('js/settings.js') }}"></script>
@endsection

@section('styles')
    <link href="{{ asset('css/settings.css') }}" rel="stylesheet">
@endsection

@section('heading')
    <h1>Settings</h1>
@endsection

@section('content')
    <div class="container text-center" id="formContainer">
        <form class="form-horizontal" method="POST" action="{{ url('settings') }}">
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
                <label for="name" class="col-md-4 control-label text-md-right">{{ __('Name:') }}</label>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" 
                            name="name" value="{{ $user->name }}" required autocomplete="name">
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-md-4 control-label text-md-right">{{ __('Email:') }}</label>
                <div class="col-md-6">
                    <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" 
                            name="email" value="{{ $user->email }}" required autocomplete="email">
                </div>
            </div>
            <div class="form-group row">
                <label for="api_token" class="col-md-4 control-label text-md-right">{{ __('API-token:') }}</label>
                <div class="col-md-6 text-left">
                    <input id="api_token" type="text" class="form-control" 
                        value="{{ $user->api_token }}" readonly required autocomplete="email">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6 offset-md-4">
                    <input type="submit" class="btn btn-primary formButton" 
                        name="generateToken" value="Generate new API-token">
                </div>
            </div>
            <div class="form-group row">
                <label for="profileStatus" class="col-md-4 control-label text-md-right">{{ __('Profile Status:') }}</label>
                <div class="col-md-6 text-left">
                    <select id="profileStatus" name="profileStatus" class="form-control">
                        @if($settings->profileStatus == 'private')
                            <option value="private" selected>Private</option>
                        @else
                            <option value="private">Private</option>
                        @endif
                        @if($settings->profileStatus == 'public')
                            <option value="public" selected>Public</option>
                        @else
                            <option value="public">Public</option>
                        @endif
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="typeList" class="col-md-4 control-label text-md-right">{{ __('Type List:') }}</label>
                <div class="col-md-6 text-left">
                    <input type="hidden" id="typeList" name="typeList" value="{{ $settings->typeList }}">
                    <div class="input-group text">
                        <input type="text" class="form-control" placeholder="Add type" id="newItem">
                        <div class="input-group-btn">
                            <input type="button" id="addType" class="btn btn-primary inputButton" 
                                    value="Add">
                        </div>
                    </div>
                    <ul id="typelist"></ul>
                </div>
            </div>
            <br>
            <br>
            <div class="form-group row">
                <button type="submit" class="button btn btn-success submitButton" 
                        id="submitForm" style="width: 90%;">Save Changes</button>
            </div>
        </form>
    </div>
    <script>
        // Add/Delete New Item to/from list 
        $(document).ready(function() {
            // Load data to type list
            OnLoad();
            // Add Type EventListener
            $("#addType").click(function() {
                if($("#newItem").val() != "") {
                    $("#typelist").append("<li>" + $("#newItem").val() + "  <span class='deleteButton'><b>X</b></span></li>");
                }
                $("#newItem").val("");
                // Convert To CSV after adding new item
                ConvertToCSV();
            });
            $(".deleteButton").click(function() {
                    $(this).closest('li').remove();
                    // Convert To CSV after deleting item
                    ConvertToCSV();
            });
        });
    </script>
@endsection