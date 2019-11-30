@extends('layouts.app')

@section('scripts')
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('js/cookie.js') }}"></script>
    <script src="{{ asset('js/movies/imdbUpdate.js') }}"></script>
    <script src="{{ asset('js/movies/saveMovie.js') }}"></script>
@endsection

@section('styles')
    <link href="{{ asset('css/movies.css') }}" rel="stylesheet">
@endsection

@section('heading')
    <h1 id="heading">Add/Edit Movie</h1>
@endsection

@section('content')
<div class="container text-center" id="formContainer">
        <div class="row">
            <div class="col-lg-3 text-center">
                <img src="{{ asset('img/no-poster-available.jpg') }}" id="poster" class='img-thumbnail'>
                <br>
                <br>
                <img src="{{ asset('img/imdb_logo.jpg') }}" alt="imdbLogo" style="height: 32px; width: 32px;"> <span class="ratingText" id="imdbScore"></span>
                
                <img src="{{ asset('img/rotten_tomatoes_logo.png') }}" alt="RottenTomatoesLogo" style="height: 32px; width: 38px;"> <span class="ratingText" id="rottenTomatoesScore"></span>
                <br>
                <br>
                <div class="input-group text">
                    <input type="text" class="form-control" name="imdbID" placeholder="imdbID" id="imdbID">
                    <div class="input-group-btn">
                        <input type="button" class="btn btn-primary inputButton" value="Update" name="imdbUpdate" onclick="imdbUpdate();">
                    </div>
                </div>
                <br>
                <br>
            </div>
            <div class="col-lg-9" id="form">
                <form id="MovieForm">
                    <div class="form-row">
                        <div class="form-group col-10">
                            <label for="name">Name</label>
                            <input type="text" id="name" class="form-control" name="name" placeholder="Name" required>
                        </div>
                        <div class="form-group col-2">
                            <label for="type">Type</label>
                            <select name="type" class="form-control" id="typeSelector" required>
                                <option value="NoValue">Select type</option>
                                @foreach($typeOptions as $typeOption)
                                    <option value="{{ $typeOption }}">{{ $typeOption }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-3">
                            <label for="runtime">Runtime</label>
                            <input type="text" id="runtime" class="form-control" name="runtime" placeholder="Runtime">
                        </div>
                        <div class="form-group col-3">
                            <label for="year">Year</label>
                            <input type="text" id="year" class="form-control" name="year" placeholder="Year">
                        </div>
                        <div class="form-group col-3">
                            <label for="genre">Genre</label>
                            <input type="text" id="genre" class="form-control" name="genre" placeholder="Genre">
                        </div>
                        <div class="form-group col-3">
                            <label for="rated">Rated</label>
                            <input type="text" id="rated" class="form-control" name="rated" placeholder="Rated">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-4">
                            <label for="language">Language</label>
                            <input type="text" id="language" class="form-control" name="language" placeholder="Language">
                        </div>
                        <div class="form-group col-4">
                            <label for="country">Country</label>
                            <input type="text" id="country" class="form-control" name="country" placeholder="Country">
                        </div>
                        <div class="form-group col-4">
                            <label for="production">Production</label>
                            <input type="text" id="production" class="form-control" name="production" placeholder="Production">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-4">
                            <label for="released">Released</label>
                            <input type="text" id="released" class="form-control" name="released" placeholder="Released">
                        </div>
                        <div class="form-group col-4">
                            <label for="imdbRating">Rating (IMDb)</label>
                            <input type="text" id="imdbRating" class="form-control" name="imdbRating" placeholder="Rating">
                        </div>
                        <div class="form-group col-4">
                            <label for="rottenTomatoesRating">Rating (RottenTomatoes)</label>
                            <input type="text" id="rottenTomatoesRating" class="form-control" name="rottenTomatoesRating" placeholder="Rating">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-4">
                            <label for="director">Director</label>
                            <input type="text" id="director" class="form-control" name="director" placeholder="Director">
                        </div>
                        <div class="form-group col-4">
                            <label for="writer">Writer</label>
                            <input type="text" id="writer" class="form-control" name="writer" placeholder="Writer">
                        </div>
                        <div class="form-group col-4">
                            <label for="actors">Actors</label>
                            <input type="text" id="actors" class="form-control" name="actors" placeholder="Actors">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="awards">Awards</label>
                            <input type="text" id="awards" class="form-control" name="awards" placeholder="Awards">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="plot">Plot</label>
                            <textarea class="form-control" rows="5" placeholder="Plot" id="plot" name="plot"></textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="actors">PosterURL</label>
                            <input type="text" id="posterURL" class="form-control" name="posterURL" placeholder="PosterURL">
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="form-row">
                        <button class="button btn btn-success submitButton" id="submitForm" style="width: 100%;">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            switch(GetCookie("mode")) {
                case "edit":
                    document.getElementById("heading").innerHTML = "Edit movie";
                    LoadSingleMovie();
                break;
                case "add":
                    document.getElementById("heading").innerHTML = "Add movie";
                break;
            }
            $("#submitForm").click(function(event) {
                // Prevent default action
                event.preventDefault();
                SaveMovie();
            });
        });
    </script>
@endsection