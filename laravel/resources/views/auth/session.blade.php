@extends('layouts.app')

@section('styles')
    <link href="{{ asset('css/sessions.css') }}" rel="stylesheet">
@endsection

@section('heading')
    <h1>Sessions</h1>
    <span class="subheading">See devices where you are logged in</span>
@endsection

@section('content')
<div>
    <table class="table table-striped table-hover" id="sessionsTable">
        <thead class="thead-dark">
            <tr>
                <th scope="col">IP-address</th>
                <th scope="col">Device</th>
                <th scope="col" width="150">Last activity</th>
                <th scope="col" width="30"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($sessions as $session)
                <tr>
                    <td>{{ $session->ip_address }}</td>
                    <td>{{ $session->user_agent }}</td>
                    <td>{{ $session->last_activity }}</td>
                    <td>
                        <form method="POST" action="{{ url('/session') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button class='btn btn-danger iconButton' name="deleteButton" value='{{ $session->id }}'>
                                <img src='img/trash.svg' style='width: 25px; height: 25px;'>
                            </button>
                        </form>
                    </td>
                <tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection