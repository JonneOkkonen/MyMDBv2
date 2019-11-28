function AddMovie() {
    // Save Data
    let url = window.location.origin + "/~jonne/MyMDB/laravel/public/api/movies/add";
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
        ClearForm();
    }).fail(function(response) {
        console.log(response);
    });
}

function ClearForm() {
    document.getElementById("MovieForm").reset();
    // Reset other fields
    document.getElementById("plot").value = "";
    document.getElementById("poster").src = "../img/no-poster-available.jpg";
    document.getElementById("imdbScore").innerHTML = "";
    document.getElementById("rottenTomatoesScore").innerHTML = "";
    document.getElementById("imdbID").value = "";
}

function GetValue(id) {
    return document.getElementById(id).value;
}