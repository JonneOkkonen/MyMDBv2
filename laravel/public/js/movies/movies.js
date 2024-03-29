// Load Page Data
function OnLoad() {
    document.getElementById("error").style = "display: none";
    document.getElementById("success").style = "display: none";
    LoadMovieCount();
    LoadMovies(GetCookie("page"));
}

function OnDetailsLoad() {
    let movieID = GetCookie("movieID");
    if(movieID != null) {
        LoadSingleMovie(movieID);
    }else {
        // Display movieID missing error
    }
}

// Load Single Movie from API
function LoadSingleMovie(id) {
    let url = window.location.origin + "/~jonne/MyMDB/laravel/public/api/movie/" + id;
    let sessionToken = GetCookie('mymdb_session');
    $.ajax({
        url: url,
        cache: false,
        type: "GET",
        data: {
            session_token: sessionToken
        }
    }).done(function(response) {
        LoadDetailsView(response);
    }).fail(function(response) {
        console.log(response.responseJSON.error);
        if(response.responseJSON.error == "Movie not found") {
            document.getElementById("movieDetailTitle").innerHTML = "Movie not found";
        }
    });
}

function ChangePage(index) {
    let searchTerm = document.getElementById("search").value;
    SetCookie("page", index);
    LoadMovies(index, searchTerm);
}

// Load Movies Data from API
function LoadMovies(page, search = "") {
    let url = window.location.origin + "/~jonne/MyMDB/laravel/public/api/movies";
    if(search != "") url = window.location.origin + "/~jonne/MyMDB/laravel/public/api/movies/search";
    let sessionToken = GetCookie('mymdb_session');
    $.ajax({
        url: url,
        cache: false,
        type: "GET",
        data: {
            session_token: sessionToken,
            page: page,
            searchTerm: search
        }
    }).done(function(response) {
        OnLoadPagination(response);
        LoadGridView(response.data);
        LoadTableView(response.data);
    }).fail(function(response) {
        console.log(response.responseJSON.error);
    });
}

/*
    MovieTypeBar:
    <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">2 Blu-Ray</div>
*/
function LoadMovieCount() {
    // Loading Text
    document.getElementById("subHeading").innerHTML = "Loading...";
    // API URL
    let url = window.location.origin + "/~jonne/MyMDB/laravel/public/api/movies/count";
    // SessionToken
    let sessionToken = GetCookie('mymdb_session');
    // Ajax GET Request
    $.ajax({
        url: url,
        cache: false,
        type: "GET",
        data: {
            session_token: sessionToken
        }
    }).done(function(response) {
        console.log(response.length);
        if(response.length != "0") {
            // All Movie Count
            let count = response[response.length - 1].count;
            // SubHeading Content
            let content = "You have " + count + " movies on your collection.";
            // If count is one use movie instead of movies
            if(count == 1) content = "You have " + count + " movie on your collection.";
            // Set SubHeading Content
            document.getElementById("subHeading").innerHTML = content;
            // MovieTypeBar elem
            let movieTypeBar = document.getElementById("movieTypeBar");
            // Show MovieTypeBar
            movieTypeBar.style = "";
            // Make sure that view is empty
            movieTypeBar.innerHTML = "";
            // Create Bar Sections
            for(let type of response) {
                if(type.type != "All") {
                    // Create div and set all attributes
                    let elem = document.createElement("div");
                    elem.setAttribute("class", "progress-bar");
                    elem.setAttribute("role", "progressbar");
                    elem.setAttribute("style", "width: " + type.count / count * 100 + "%; background-color: " + GetRandomColor());
                    elem.setAttribute("aria-valuenow", type.count / count * 100);
                    elem.setAttribute("aria-valuemin", "0");
                    elem.setAttribute("aria-valuemax", "100");
                    elem.innerHTML = type.count + " " + type.type;
                    // Append Div to MovieTypeBar
                    movieTypeBar.append(elem);
                }
            }
        }else {
            // Set SubHeading Content
            document.getElementById("subHeading").innerHTML = "You don't have any movies yet.";
            // Hide MovieTypeBar elem
            let movieTypeBar = document.getElementById("movieTypeBar").style = "display: none";
        }
    }).fail(function(response) {
        console.log(response);
    });
}

// Random Color Generator
function GetRandomColor() {
    var letters = '0123456789ABCDE'; // F left a way to avoid white colors
    var color = '#';
    for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
  }

/*
    Movie Grid Item Template:
    <div class='col'>
        <div class='poster'>
            <img class='poster-img-top' src="{{ asset('img/no-poster-available.jpg') }}" alt='movieName' href="#movieID">
            <br>
            <span class="movieName"><b>MovieName</b></span>
            <span class="movieType">MovieType</span>
        </div>
    </div>
*/
function LoadGridView(data) {
    // GridView Element
    let elem = document.getElementById("movieGrid");
    // Make sure that view is empty
    elem.innerHTML = "";
    // Create MovieCards for all movies
    for(let movie of data) {
        // MovieCard
        let poster = "img/no-poster-available.jpg";
        if(movie.posterURL != null) poster = movie.posterURL;
        let movieCard = `
            <div class='col'>
                <div class='poster'>
                    <a href='movies/${movie.movieID}'><img class='poster-img-top' src='${poster}' alt='${movie.name}'></a>
                    <br>
                    <span class='movieName'><a href="movies/${movie.movieID}" data-toggle="tooltip" title="${movie.name}">${movie.name}</a></span>
                    <span class='movieType'>${movie.type}</span>
                </div>
            </div>
        `;
        // Add Movie Card to GridView
        elem.innerHTML += movieCard;
    }
}

/*
    Movie List Row Template:
    <tr>
        <td>MovieName</td>
        <td>MovieType</td>
        <td></td>
        <td></td>
    </tr>
*/
function LoadTableView(data) {
    // TableView Element
    let elem = document.getElementById("movieList");
    // Make sure that view is empty
    elem.innerHTML = "";
    // Add all movies to listview
    for(let movie of data) {
        // MovieRow
        let movieRow = `
            <tr>
                <td><a href="movies/${movie.movieID}">${movie.name}</a></td>
                <td>${movie.type}</td>
                <td class='td_button'><button class="btn btn-primary iconButton">
                <a href="movies/edit/${movie.movieID}" id="editButton"><img src='img/pencil.svg' style='width: 25px; height: 25px;'></a>
            </button></td>
                <td class='td_button'><button class='btn btn-danger iconButton' value='${movie.movieID}' 
                onclick='DeleteMovie(this.value)'><img src='img/trash.svg' style='width: 25px; height: 25px;'></button></td>
            </tr>
        `;
        elem.innerHTML += movieRow;
    }
}

// Load Movie Data to DetailsView
function LoadDetailsView(data) {
    // Set MovieID to delete
    document.getElementById("deleteButton").value = data[0].movieID;
    // Set link to edit page
    document.getElementById("editButton").href = "edit/" + data[0].movieID;
    // Load data to DetailViewElements
    if(data[0].posterURL != null) {
        document.getElementById("poster").src = data[0].posterURL;
    }
    // Add Ratings
    document.getElementById("imdbRating").innerHTML = data[0].rating;
    document.getElementById("rottenTomatoesRating").innerHTML = data[0].rottenTomatoes;

    // Add Movie Title
    document.getElementById("movieDetailTitle").innerHTML = data[0].name;

    // Add Data to Content1 view
    // Ignore fields with null values
    let year = "", country = "", rated = "", runtime = "";
    if(data[0].year != null) year = ", " + data[0].year;
    if(data[0].country != null) country = ", " + data[0].country;
    if(data[0].rated != null) rated = ", " + data[0].rated;
    if(data[0].runtime != null) runtime = ", " + data[0].runtime;
    document.getElementById("movieDetailContent1").innerHTML = data[0].type + year + country + rated + runtime;

    // Add Data to Content2 view
    // Ignore fields with null values
    let released = "", genre = "", language = "", production = "", actors = "", 
        director = "", writer = "", awards = "", plot = "";
    if(data[0].released != null) released = `<p class="movieDetailRow"><b>Released:</b> ${data[0].released}</p>`;
    if(data[0].genre != null) genre = `<p class="movieDetailRow"><b>Genre:</b> ${data[0].genre}</p>`;
    if(data[0].language != null) language = `<p class="movieDetailRow"><b>Language:</b> ${data[0].language}</p>`;
    if(data[0].production != null) production = `<p class="movieDetailRow"><b>Production:</b> ${data[0].production}</p>`;
    if(data[0].actors != null) actors = `<p class="movieDetailRow"><b>Actors:</b> ${data[0].actors}</p>`;
    if(data[0].director != null) director = `<p class="movieDetailRow"><b>Director:</b> ${data[0].director}</p>`;
    if(data[0].writer != null) writer = `<p class="movieDetailRow"><b>Writer:</b> ${data[0].writer}</p>`;
    if(data[0].awards != null) awards = `<p class="movieDetailRow"><b>Awards:</b> ${data[0].awards}</p>`;
    if(data[0].plot != null) plot = `<p class="movieDetailRow"><b>Plot:</b></p>
                                     <p class="movieDetailRow">${data[0].plot}</p>`;
    document.getElementById("movieDetailContent2").innerHTML = `
        ${released}
        ${genre}
        ${language}
        ${production}
        ${actors}
        ${director}
        ${writer}
        ${awards}
        <br>
        ${plot}
    `;
}

// Delete Movie
function DeleteMovie(id, load = true) {
    if (confirm('Are you sure you want to delete this movie?')) {
        let url = window.location.origin + "/~jonne/MyMDB/laravel/public/api/movies/delete/" + id;
        let sessionToken = GetCookie('mymdb_session');
        $.ajax({
            url: url,
            cache: false,
            type: "GET",
            data: {
                session_token: sessionToken
            }
        }).done(function(response) {
            if(load) OnLoad();
            document.getElementById("success").innerHTML = "Movie deleted successfully";
            document.getElementById("success").style = "display: block";

        }).fail(function(response) {
            console.log(response.responseJSON.error);
            document.getElementById("error").innerHTML = "Movie delete failed";
            document.getElementById("error").style = "display: block";
        });
    }
}

// Search Movie
function Search(value) {
    let url = window.location.origin + "/~jonne/MyMDB/laravel/public/api/movies/search";
    let sessionToken = GetCookie('mymdb_session');
    if(value != "") {
        $.ajax({
        url: url,
        cache: false,
        type: "GET",
        data: {
            session_token: sessionToken,
            searchTerm: value
        }
        }).done(function(response) {
            // Make sure Result list is empty
            document.getElementById("results").innerHTML = "";
            // Load data to result list
            for(let item of response.data) {
                document.getElementById("results").innerHTML += `<option id="${item.movieID}" value="${item.name}"></option>`;
            }
        }).fail(function(response) {
            console.log(response.responseJSON.error);
            document.getElementById("error").innerHTML = "Seaching failed: " + response.responseJSON.error;
            document.getElementById("error").style = "display: block";
        });
    } 
}

// Show Search Results in grid/listview
function SearchButton() {
    // Show Stop Search Button
    document.getElementById("stopSearchButton").style = "display: block";
    // Load Results
    LoadMovies("1", document.getElementById("search").value);
}

// Stop Searching
function StopSearch() {
    // Clear search field
    document.getElementById("search").value = "";
    // Refresh View
    OnLoad();
    // Hide Stop Search Button
    document.getElementById("stopSearchButton").style = "display: none";
}