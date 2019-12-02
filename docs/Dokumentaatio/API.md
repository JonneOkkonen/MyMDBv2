# MyMDB API v1.0

  MyMDB API is available in `https://mymdb.jonneokkonen.com/api/`.
  Returns give query result in JSON format. 
  
## Authentication

  There are two authentication methods session_token and api_token.
  API_token can be found on users settings while logged in.
  Session_token is saved to a cookie named 'mymdb_session' while user is logged in.
  To be able to use api you have to provide `session_token` or `api_token` get parameter when sending request to API.
  
## Movies

## URL

  `https://mymdb.jonneokkonen.com/api/`

## Method

  `GET`

## URL Params

### Required
 
`apiKey=`  

## Success Response

  * **Code:** 200 <br />
    **Content:** 
    ```json

    ```
 
## Error Response

  * **Code:** 200 <br />
    **Content:** 
    ```json
    [{
        "error": "Incorrect API - key"
    }]
    ```

       OR

  * **Code:** 200 <br />
    **Content:** 
    ```json
    [{
        "error": "Query was empty"
    }]
    ```
    
       OR

  * **Code:** 200 <br />
    **Content:** 
    ```json
    [{
        "error": "0 results from query"
    }]
    ```
       OR
  
  * **Code:** 200 <br />
    **Content:**   
    ```json
    [{
        "error" : "You have an error in your SQL syntax; check the manual 
        that corresponds to your MySQL server version for the right syntax to 
        use near 'Ajoneuvo LIMIT 1' at line 1"
        
    }]
    ```
