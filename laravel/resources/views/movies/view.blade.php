@extends('layouts.app')

@section('scripts')
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('js/movies.js') }}"></script>
    <script src="{{ asset('js/cookie.js') }}"></script>
@endsection

@section('styles')
    <link href="{{ asset('css/movies.css') }}" rel="stylesheet">
@endsection

@section('heading')
    <h1>Movies</h1>
    <span class="subheading" id="subHeading">You have x movies on your collection.</span>
@endsection

@section('heading-content')
    <!-- MovieTypeBar -->
    <div class="progress" id="movieTypeBar"></div>
    <br>
@endsection

@section('header-bottom')
    <!--Tab Selector-->
    <ul class="nav nav-tabs" id="views">
        <li class="nav-item tabItem" id="gridSelector">
            <a class="nav-link tabLink" data-toggle="tab" href="#gridView" onclick="Select('grid');">
            <img src="{{ asset('img/grid-three-up.svg') }}" style="width: 16px; height: 16px;">  Grid View</a>
        </li>
        <li class="nav-item tabItem" id="listSelector">
            <a class="nav-link tabLink" data-toggle="tab" href="#listView" onclick="Select('list');">
            <img src="{{ asset('img/list.svg') }}" style="width: 16px; height: 16px;"> List View</a>
        </li>
    </ul>
@endsection

@section('content')
<!-- Main Content -->
<div class="tab-content">
        <div id="gridView" class="tab-pane fade">
            <div class="row" id="movieGrid"></div>
        </div>
        <div id="listView" class="tab-pane fade">
            <table class="table table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Type</th>
                        <th scope="col" width="30px"></th>
                        <th scope="col" width="30px"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>MovieName</td>
                        <td>MovieType</td>
                        <td></td>
                        <td></td>
                </tbody>
            </table>
        </div>
</div>
<!-- SelectView with JavaScript -->
<script type="text/javascript" src="{{ asset('js/viewSelector.js') }}"></script>
<script>
    // Load Movies
    $(document).ready(function() {
        LoadMovieCount();
        LoadMovies();
    });
</script>
@endsection