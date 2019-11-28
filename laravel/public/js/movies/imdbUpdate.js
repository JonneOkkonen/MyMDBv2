function imdbUpdate() {
    var imdbID = document.getElementById("imdbID").value; 
    var URL = "http://www.omdbapi.com/?i=" + imdbID + "&apikey=11626305&plot=full";
    var jsonData = GetJSON(URL);
    var imdb = JSON.parse(jsonData);
    
    // Error Checking
    if(imdb.Response == "False") {
        console.log(imdb.Error);
    }else {
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

    function GetJSON(url) {
        var resp ;
        var xmlHttp ;

        resp  = '' ;
        xmlHttp = new XMLHttpRequest();

        if(xmlHttp != null)
        {
            xmlHttp.open( "GET", url, false );
            xmlHttp.send( null );
            resp = xmlHttp.responseText;
        }
        return resp;
    }
}