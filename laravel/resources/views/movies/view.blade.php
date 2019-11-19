@extends('layouts.app')

@section('styles')
    <link href="{{ asset('css/movies.css') }}" rel="stylesheet">
@endsection

@section('heading')
    <h1>Movies</h1>
    <span class="subheading">You have x movies on your collection.</span>
@endsection

@section('heading-content')
    <!-- MovieTypeBar -->
    <div class="progress">
        <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">2 Blu-Ray</div>
        <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">1 DVD</div>
        <div class="progress-bar bg-info" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">1 iTunes</div>
    </div>
    <br>
@endsection

@section('header-bottom')
    <!--Tab Selector-->
    <ul class="nav nav-tabs" id="views">
        <li class="nav-item tabItem" id="gridSelector">
            <a class="nav-link tabLink" data-toggle="tab" href="#gridView" onclick="Select('grid');">
            <img src="https://useiconic.com/open-iconic/svg/grid-three-up.svg" style="width: 16px; height: 16px;">  Grid View</a>
        </li>
        <li class="nav-item tabItem" id="listSelector">
            <a class="nav-link tabLink" data-toggle="tab" href="#listView" onclick="Select('list');">
            <img src="https://useiconic.com//open-iconic/svg/list.svg" style="width: 16px; height: 16px;"> List View</a>
        </li>
    </ul>
@endsection

@section('content')
<!-- Main Content -->
<div class="tab-content">
        <div id="gridView" class="tab-pane fade">
            <div class="row">
                <div class='col'>
                    <div class='poster'>
                        <img class='poster-img-top' src="{{ asset('img/no-poster-available.jpg') }}" alt='movieName' href="#movieID">
                        <br>
                        <span class="movieName"><b>MovieName</b></span>
                        <span class="movieType">MovieType</span>
                    </div>
                </div>
                <div class='col'>
                    <div class='poster'>
                        <img class='poster-img-top' src="{{ asset('img/no-poster-available.jpg') }}" alt='movieName' href="#movieID">
                        <br>
                        <span class="movieName"><b>MovieName</b></span>
                        <span class="movieType">MovieType</span>
                    </div>
                </div>
            </div>
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
@endsection