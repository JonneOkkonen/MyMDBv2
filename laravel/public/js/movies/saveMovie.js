function SaveMovie() {
    // Set url depending with mode is active
    let url = "";
    switch(GetCookie("mode")) {
        case "edit":
            url = window.location.origin + "/~jonne/MyMDB/laravel/public/api/movies/update/" + GetCookie("movieID");
        break;
        case "add":
            url = window.location.origin + "/~jonne/MyMDB/laravel/public/api/movies/add";
        break;
    }
    let sessionToken = GetCookie('mymdb_session');
    let type = document.getElementById("typeSelector");
    var typeValue = type.options[type.selectedIndex].value;
    $.ajax({
        url: url,
        cache: false,
        type: "GET",
        data: {
            session_token: sessionToken,
            name: GetValue("name"),
            type: typeValue,
            runtime: GetValue("runtime"),
            year: GetValue("year"),
            genre: GetValue("genre"),
            rated: GetValue("rated"),
            released: GetValue("released"),
            actors: GetValue("actors"),
            director: GetValue("director"),
            writer: GetValue("writer"),
            rating: GetValue("imdbRating"),
            rottenTomatoes: GetValue("rottenTomatoesRating"),
            plot: GetValue("plot"),
            posterURL: GetValue("posterURL"),
            language: GetValue("language"),
            country: GetValue("country"),
            awards: GetValue("awards"),
            production: GetValue("production"),
            imdbID: GetValue("imdbID"),
        }
    }).done(function(response) {
        console.log(response);
        document.getElementById("success").innerHTML = "Movie saved successfully";
        document.getElementById("success").style = "display: block";
        ClearForm();
    }).fail(function(response) {
        console.log(response);
        document.getElementById("error").innerHTML = "Movie not found";
        document.getElementById("error").style = "display: block";
    });
}

// Load Single Movie from API
function LoadSingleMovie() {
    let url = window.location.origin + "/~jonne/MyMDB/laravel/public/api/movie/" + GetCookie("movieID");
    let sessionToken = GetCookie('mymdb_session');
    $.ajax({
        url: url,
        cache: false,
        type: "GET",
        data: {
            session_token: sessionToken
        }
    }).done(function(response) {
        console.log(response);
        LoadFormData(response);
    }).fail(function(response) {
        console.log(response.responseJSON.error);
        if(response.responseJSON.error == "Movie not found") {
            document.getElementById("error").innerHTML = "Movie not found";
            document.getElementById("error").style = "display: block";
        }
    });
}

// Load movie data to form on edit mode
function LoadFormData(data) {
    // Load data to form
    if(data[0].posterURL != null) document.getElementById("poster").src = data[0].posterURL;
    document.getElementById("imdbScore").innerHTML = data[0].rating;
    document.getElementById("rottenTomatoesScore").innerHTML = data[0].rottenTomatoes;
    document.getElementById("imdbID").value = data[0].imdbID;
    document.getElementById("name").value = data[0].name;
    $("select option").filter(function() {
        return $(this).text() == data[0].type;
      }).prop('selected', true);
    document.getElementById("runtime").value = data[0].runtime;
    document.getElementById("year").value = data[0].year;
    document.getElementById("genre").value = data[0].genre;
    document.getElementById("rated").value = data[0].rated;
    document.getElementById("language").value = data[0].language;
    document.getElementById("country").value = data[0].country;
    document.getElementById("production").value = data[0].production;
    document.getElementById("released").value = data[0].released;
    document.getElementById("imdbRating").value = data[0].rating;
    document.getElementById("rottenTomatoesRating").value = data[0].rottenTomatoes;
    document.getElementById("director").value = data[0].director;
    document.getElementById("writer").value = data[0].writer;
    document.getElementById("actors").value = data[0].actors;
    document.getElementById("awards").value = data[0].awards;
    document.getElementById("plot").value = data[0].plot;
    document.getElementById("posterURL").value = data[0].posterURL;
}

function ClearForm() {
    document.getElementById("MovieForm").reset();
    // Reset other fields
    document.getElementById("plot").value = "";
    switch(GetCookie("mode")) {
        case "edit":
            document.getElementById("poster").src = "../../img/no-poster-available.jpg";
        break;
        case "add":
            document.getElementById("poster").src = "../img/no-poster-available.jpg";
        break;
    }
    document.getElementById("imdbScore").innerHTML = "";
    document.getElementById("rottenTomatoesScore").innerHTML = "";
    document.getElementById("imdbID").value = "";
}

function GetValue(id) {
    return document.getElementById(id).value;
}