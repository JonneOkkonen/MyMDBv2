# MyMDB API v1.0

  MyMDB API is available in `https://mymdb.jonneokkonen.com/api/`.
  Returns give query result in JSON format. 
  
## Authentication

  There are two authentication methods session_token and api_token.
  API_token can be found on users settings while logged in.
  Session_token is saved to a cookie named 'mymdb_session' while user is logged in.
  To be able to use api you have to provide `session_token` or `api_token` in get parameter when sending request to API.
  
## List of Movies

Return list of all movies in alphabetical order (A->Ö). Uses pagination. By default there are 100 movies per page.

### URL

  `https://mymdb.jonneokkonen.com/api/movies`

### Method

  `GET`

### URL Params

#### Required
 
`session_token=` OR `api_token`  
`page=`

### Success Response

  * **Code:** 200 <br />
    **Content:** 
    ```json
    {
        "current_page":1,
        "data": [
            {
               "movieID":5,
               "userID":1,
               "name":"Pako Alcatrazista",
               "type":"Blu-Ray",
               "imdbID":"tt0079116",
               "language":"English",
               "country":"USA",
               "runtime":"112 min",
               "year":"1979",
               "genre":"Biography, Crime, Drama, Thriller",
               "rated":"PG",
               "released":"22 Jun 1979",
               "actors":"Clint Eastwood, Patrick McGoohan, Roberts Blossom, Jack Thibeau",
               "director":"Don Siegel",
               "writer":"J. Campbell Bruce (book), Richard Tuggle (screenplay)",
               "rating":"7.6 (106,930)",
               "awards":"N\/A",
               "production":"Paramount Home Video",
               "rottenTomatoes":"96%",
               "plot":"The true story of three inmates who attempt a daring escape from 
                       the infamous prison, Alcatraz Island. Although no-one had managed to escape before, 
                       bank robber Frank Morris masterminded this elaborately detailed and, as far as anyone 
                       knows, ultimately successful, escape. In 29 years, this seemingly impenetrable federal 
                       penitentiary, which housed Al Capone and \"Birdman\" Robert Stroud, was only broken once 
                       by three inmates never heard of again.",
               "posterURL":"https:\/\/m.media-amazon.com\/images\/M\/MV5BNDQ3MzNjMDItZjE0ZS00ZTYxLTgxNT
                            AtM2I4YjZjNWFjYjJlL2ltYWdlXkEyXkFqcGdeQXVyNTAyODkwOQ@@._V1_SX300.jpg",
               "created_at":"2019-12-02 15:31:26",
               "updated_at":"2019-12-02 15:31:26"
                
            }
            ...
        ],
        "first_page_url":"https:\/\/mymdb.jonneokkonen.com\/api\/movies?page=1",
        "from":1,
        "last_page":1,
        "last_page_url":"https:\/\/mymdb.jonneokkonen.com\/api\/movies?page=1",
        "next_page_url":null,
        "path":"https:\/\/mymdb.jonneokkonen.com\/api\/movies",
        "per_page":100,
        "prev_page_url":null,
        "to":5,
        "total":5}
    ```
 
### Error Response

  * **Code:** 400 <br />
    **Content:** 
    ```json
    [{
        "error": "API-token incorrect"
    }]
    ```

       OR

  * **Code:** 400 <br />
    **Content:** 
    ```json
    [{
        "error": "Session token invalid"
    }]
    ```
    
## Single Movie

Return data for single movie.

### URL

  `https://mymdb.jonneokkonen.com/api/movie/{id}`

### Method

  `GET`

### URL Params

#### Required
 
`session_token=` OR `api_token`  

### Success Response

  * **Code:** 200 <br />
    **Content:** 
    ```json
    [
        {
            "movieID": 5,
            "userID": 1,
            "name": "Pako Alcatrazista",
            "type": "Blu-Ray",
            "imdbID": "tt0079116",
            "language": "English",
            "country": "USA",
            "runtime": "112 min",
            "year": "1979",
            "genre": "Biography, Crime, Drama, Thriller",
            "rated": "PG",
            "released": "22 Jun 1979",
            "actors": "Clint Eastwood, Patrick McGoohan, Roberts Blossom, Jack Thibeau",
            "director": "Don Siegel",
            "writer": "J. Campbell Bruce (book), Richard Tuggle (screenplay)",
            "rating": "7.6 (106,930)",
            "awards": "N/A",
            "production": "Paramount Home Video",
            "rottenTomatoes": "96%",
            "plot": "The true story of three inmates who attempt a daring escape from the infamous prison, Alcatraz Island. Although no-one had managed to escape before, bank robber Frank Morris masterminded this elaborately detailed and, as far as anyone knows, ultimately successful, escape. In 29 years, this seemingly impenetrable federal penitentiary, which housed Al Capone and \"Birdman\" Robert Stroud, was only broken once by three inmates never heard of again.",
            "posterURL": "https://m.media-amazon.com/images/M/MV5BNDQ3MzNjMDItZjE0ZS00ZTYxLTgxNTAtM2I4YjZjNWFjYjJlL2ltYWdlXkEyXkFqcGdeQXVyNTAyODkwOQ@@._V1_SX300.jpg",
            "created_at": "2019-12-02 15:31:26",
            "updated_at": "2019-12-02 15:31:26"
        }
    ]
    ```
 
### Error Response

  * **Code:** 400 <br />
    **Content:** 
    ```json
    [{
        "error": "API-token incorrect"
    }]
    ```

       OR

  * **Code:** 400 <br />
    **Content:** 
    ```json
    [{
        "error": "Session token invalid"
    }]
    ```

        OR
        
  * **Code:** 400 <br />
    **Content:** 
    ```json
    [{
        "error": "Movie not found"
    }]
    ```
    
## Add Movie

Add movie to database

### URL

  `https://mymdb.jonneokkonen.com/api/movies/add`

### Method

  `GET`

### URL Params

#### Required
 
`session_token=` OR `api_token`  
`name=`

### Optional

`type=`  
`imdbID=`  
`language=`  
`country=`  
`runtime=`  
`year=`  
`genre=`  
`rated=`  
`released=`  
`actors=` 
`director=`  
`writer=`  
`rating=`  
`awards=`  
`production=`  
`rottenTomatoes=`  
`plot=`  
`posterURL=`  

### Success Response

  * **Code:** 200 <br />
    **Content:** 
    ```json
    {
        "msg": "Movie Added Successfully"
    }
    ```
 
### Error Response

  * **Code:** 400 <br />
    **Content:** 
    ```json
    [{
        "error": "API-token incorrect"
    }]
    ```

       OR

  * **Code:** 400 <br />
    **Content:** 
    ```json
    [{
        "error": "Session token invalid"
    }]
    ```

        OR
        
  * **Code:** 400 <br />
    **Content:** 
    ```json
    [{
        "error": "Name cannot be null"
    }]
    ```
    
## Update Movie

Update movie data to database

### URL

  `https://mymdb.jonneokkonen.com/api/movies/update/{id}`

### Method

  `GET`

### URL Params

#### Required
 
`session_token=` OR `api_token`  
`name=`

### Optional

`type=`  
`imdbID=`  
`language=`  
`country=`  
`runtime=`  
`year=`  
`genre=`  
`rated=`  
`released=`  
`actors=` 
`director=`  
`writer=`  
`rating=`  
`awards=`  
`production=`  
`rottenTomatoes=`  
`plot=`  
`posterURL=`  

### Success Response

  * **Code:** 200 <br />
    **Content:** 
    ```json
    {
        "msg": "Movie Updated Successfully"
    }
    ```
 
### Error Response

  * **Code:** 400 <br />
    **Content:** 
    ```json
    [{
        "error": "API-token incorrect"
    }]
    ```

       OR

  * **Code:** 400 <br />
    **Content:** 
    ```json
    [{
        "error": "Session token invalid"
    }]
    ```

        OR
        
  * **Code:** 400 <br />
    **Content:** 
    ```json
    [{
        "error": "Name cannot be null"
    }]
    
    ```
    
        OR
        
  * **Code:** 400 <br />
    **Content:** 
    ```json
    [{
        "error": "Movie not found"
    }]
    
    ```
    
## Delete Movie

Delete data for single movie.

### URL

  `https://mymdb.jonneokkonen.com/api/movies/delete/{id}`

### Method

  `GET`

### URL Params

#### Required
 
`session_token=` OR `api_token`  

### Success Response

  * **Code:** 200 <br />
    **Content:** 
    ```json
    {
        "msg": "Movie Deleted Successfully"
    }
    ```
 
### Error Response

  * **Code:** 400 <br />
    **Content:** 
    ```json
    [{
        "error": "API-token incorrect"
    }]
    ```

       OR

  * **Code:** 400 <br />
    **Content:** 
    ```json
    [{
        "error": "Session token invalid"
    }]
    ```

        OR
        
  * **Code:** 400 <br />
    **Content:** 
    ```json
    [{
        "error": "Movie not found"
    }]
    ```
    
## Count Movies

Return movie type count

### URL

  `https://mymdb.jonneokkonen.com/api/count`

### Method

  `GET`

### URL Params

#### Required
 
`session_token=` OR `api_token`  

### Success Response

  * **Code:** 200 <br />
    **Content:** 
    ```json
    [
        {
            "type": "Blu-Ray",
            "count": 1
        },
        {
            "type": "NoValue",
            "count": 1
        },
        {
            "type": "All",
            "count": 2
        }
    ]
    ```
 
### Error Response

  * **Code:** 400 <br />
    **Content:** 
    ```json
    [{
        "error": "API-token incorrect"
    }]
    ```

       OR

  * **Code:** 400 <br />
    **Content:** 
    ```json
    [{
        "error": "Session token invalid"
    }]
    ```
    
## Search Movie

Search movie from database. Uses pagination. By default there are 10 movies per page.

### URL

  `https://mymdb.jonneokkonen.com/api/movies/search`

### Method

  `GET`

### URL Params

#### Required
 
`session_token=` OR `api_token`  
`searchTerm=`  
`page=`  

### Success Response

  * **Code:** 200 <br />
    **Content:** 
    ```json
        {
        "current_page": 1,
        "data": [
            {
                "movieID": 11,
                "userID": 2,
                "name": "Napapiirin sankarit 2",
                "type": "NoValue",
                "imdbID": null,
                "language": null,
                "country": null,
                "runtime": null,
                "year": null,
                "genre": null,
                "rated": null,
                "released": null,
                "actors": null,
                "director": null,
                "writer": null,
                "rating": null,
                "awards": null,
                "production": null,
                "rottenTomatoes": null,
                "plot": null,
                "posterURL": null,
                "created_at": "2019-12-02 18:41:53",
                "updated_at": "2019-12-02 18:47:48"
            }
        ],
        "first_page_url": "https://mymdb.jonneokkonen.com/api/movies/search?page=1",
        "from": 1,
        "last_page": 1,
        "last_page_url": "https://mymdb.jonneokkonen.com/api/movies/search?page=1",
        "next_page_url": null,
        "path": "https://mymdb.jonneokkonen.com/api/movies/search",
        "per_page": 10,
        "prev_page_url": null,
        "to": 1,
        "total": 1
    }
    ```
 
### Error Response

  * **Code:** 400 <br />
    **Content:** 
    ```json
    [{
        "error": "API-token incorrect"
    }]
    ```

       OR

  * **Code:** 400 <br />
    **Content:** 
    ```json
    [{
        "error": "Session token invalid"
    }]
    ```

        OR
        
  * **Code:** 400 <br />
    **Content:** 
    ```json
    [{
        "error": "Search term missing"
    }]
    ```
    
## OMDb Search

This app uses OMDb API to retrieve movie data from imdb. This API is only usable with session_token.

### URL

  `https://mymdb.jonneokkonen.com/api/omdb/search`

### Method

  `GET`

### URL Params

#### Required
 
`session_token=`  
`id=`  

### Success Response

  * **Code:** 200 <br />
    **Content:** 
    ```json
    {
        "Title": "Lapland Odyssey",
        "Year": "2010",
        "Rated": "Not Rated",
        "Released": "15 Oct 2010",
        "Runtime": "92 min",
        "Genre": "Comedy, Drama, Romance",
        "Director": "Dome Karukoski",
        "Writer": "Pekko Pesonen",
        "Actors": "Pamela Tola, Jussi Vatanen, Jasper Pääkkönen, Timo Lavikainen",
        "Plot": "A comedy about Janne, a man from Lapland in Northern Finland, a man who has made a career out of living on welfare. Inari, his girlfriend, is tired of Janne's incapability of getting a grip on life. Janne wasn't even able to buy a digital TV box that Inari had given money for. Inari gives an ultimatum: a digital box needs to arrive by dawn or she leaves. Janne sets out into the night with his two friends to find a box. On their way to the city of Rovaniemi, Janne and his friends face many challenges, obstacles and temptations. They learn that they need to be daring. There's no room to give into bitterness. The most important thing isn't success, but rather the journey in itself.",
        "Language": "Finnish, English, Swedish, Russian",
        "Country": "Finland, Ireland, Sweden",
        "Awards": "7 wins & 5 nominations.",
        "Poster": "https://m.media-amazon.com/images/M/MV5BNDQ1NDQ4MjM2MF5BMl5BanBnXkFtZTcwNTM3Mjg5OA@@._V1_SX300.jpg",
        "Ratings": [
            {
                "Source": "Internet Movie Database",
                "Value": "6.9/10"
            }
        ],
        "Metascore": "N/A",
        "imdbRating": "6.9",
        "imdbVotes": "5,480",
        "imdbID": "tt1454505",
        "Type": "movie",
        "DVD": "08 Jan 2013",
        "BoxOffice": "N/A",
        "Production": "Helsinki Filmi Oy",
        "Website": "N/A",
        "Response": "True"
    }
    ```
 
### Error Response

  * **Code:** 400 <br />
    **Content:** 
    ```json
    [{
        "error": "OMDbSearch is not available with api token"
    }]
    ```

       OR

  * **Code:** 400 <br />
    **Content:** 
    ```json
    [{
        "error": "Session token invalid"
    }]
    ```

        OR
        
  * **Code:** 400 <br />
    **Content:** 
    ```json
    [{
        "error": "imdbID missing"
    }]
    ```
    
    
        OR
        
  * **Code:** 400 <br />
    **Content:** 
    ```json
    [{
        "error": "Incorrect IMDb ID."
    }]
    ```