function LoadDataToForm(imdb) {
    // Write Data to correct fields
    document.getElementById("name").value = imdb.Title;
    document.getElementById("runtime").value = imdb.Runtime;
    document.getElementById("year").value = imdb.Year;
    document.getElementById("genre").value = imdb.Genre;
    document.getElementById("rated").value = imdb.Rated;
    document.getElementById("language").value = imdb.Language;
    document.getElementById("country").value = imdb.Country;
    document.getElementById("production").value = imdb.Production;
    document.getElementById("released").value = imdb.Released;
    document.getElementById("imdbRating").value = imdb.imdbRating + " (" + imdb.imdbVotes + ")";
    document.getElementById("director").value = imdb.Director;
    document.getElementById("writer").value = imdb.Writer;
    document.getElementById("actors").value = imdb.Actors;
    document.getElementById("awards").value = imdb.Awards;
    document.getElementById("plot").innerHTML = imdb.Plot;
    document.getElementById("posterURL").value = imdb.Poster;
    document.getElementById("imdbScore").innerHTML = imdb.imdbRating + " (" + imdb.imdbVotes + ")";
    if(imdb.Poster != "") {
        document.getElementById("poster").src = imdb.Poster;
    }
    document.getElementById("rottenTomatoesScore").innerHTML = imdb.Ratings[1].Value;
    document.getElementById("rottenTomatoesRating").value = imdb.Ratings[1].Value;
    }

    function imdbUpdate() {
        var imdbID = document.getElementById("imdbID").value; 
        let url = window.location.origin + "/~jonne/MyMDB/laravel/public/api/omdb/search";
        let sessionToken = GetCookie('mymdb_session');
        $.ajax({
            url: url,
            cache: false,
            type: "GET",
            data: {
                session_token: sessionToken,
                id: imdbID
            }
        }).done(function(response) {
            console.log(response);
            LoadDataToForm(response);
        }).fail(function(response) {
            console.log(response.responseJSON.error);
        });
    }
}