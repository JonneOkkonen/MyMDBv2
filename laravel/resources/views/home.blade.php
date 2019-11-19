@extends('layouts.app')

@section('heading')
    <h1>Welcome</h1>
    <span class="subheading">{{ Auth::user()->name }}</span>
    <br>
    <span class="subheading">Your are successfully logged in.</span>
@endsection