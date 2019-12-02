@extends('layouts.app')

@section('scripts')
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('js/movies/movies.js') }}"></script>
    <script src="{{ asset('js/cookie.js') }}"></script>
@endsection

@section('styles')
    <link href="{{ asset('css/movies.css') }}" rel="stylesheet">
@endsection

@section('heading')
<style>
    .site-heading {
        width: 80%;
    }
</style>
<div class="alert alert-success" id="success" style="display: none"></div>
<div class="alert alert-danger" id="error" style="display: none"></div>
<div class="container" id="movieDetails">
    <div class="row">
        <div class="col-lg-3 text-center text-light">
            <br>
            <img src="{{ asset('img/no-poster-available.jpg') }}" id="poster" class='img-thumbnail'>
            <br>
            <br>
            <img src="{{ asset('img/imdb_logo.jpg') }}" alt='imdbLogo' style='height: 32px; width: 32px;'> <span class="ratingText" id="imdbRating"></span>
            <img src="{{ asset('img/rotten_tomatoes_logo.png') }}" alt='RottenTomatoesLogo' style='height: 32px; width: 38px;'> <span class="ratingText" id="rottenTomatoesRating"></span>
            <br>
            <br>
            <div class="row">
                <div class="col-6 text-right">
                    <button class="btn btn-primary iconButton">
                        <a href="#" id="editButton"><img src='../img/pencil.svg' style='width: 25px; height: 25px;'></a>
                    </button>
                </div>
                <div class="col-6 text-left">
                    <button class='btn btn-danger iconButton' id="deleteButton" onclick='DeleteMovie(this.value, false)'>
                        <img src='../img/trash.svg' style='width: 25px; height: 25px;'>
                    </button>
                </div>
            </div>
            <br>
            <br>
        </div>
        <div class="col-lg-9 text-light text-left">                  
            <h1 id="movieDetailTitle"></h1>
            <h3 id="movieDetailContent1"></h3>
            <div id="movieDetailContent2"></div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        OnDetailsLoad();
    });
</script>
@endsection