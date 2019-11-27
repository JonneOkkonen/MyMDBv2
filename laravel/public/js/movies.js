function LoadMovies() {
    let url = window.location.origin + "/~jonne/MyMDB/laravel/public/api/movies";
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
        LoadGridView(response);
    }).fail(function(response) {
        console.log(response);
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
    Movie Template:
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
    let elem = document.getElementById("movieGrid");
    for(let movie of data) {
        let movieCard = `
            <div class='col'>
                <div class='poster'>
                    <img class='poster-img-top' src='img/no-poster-available.jpg' alt='${movie.name}' href='#movieID'>
                    <br>
                    <span class='movieName'>${movie.name}</span>
                    <span class='movieType'>${movie.type}</span>
                </div>
            </div>
        `;
        elem.innerHTML += movieCard;
    }
}
