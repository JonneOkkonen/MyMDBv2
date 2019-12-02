<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Encryption\DecryptException;
use Auth;
use Crypt;

class ApiController extends Controller
{
    private static $sessionAuth = false;

    public function __construct()
    {
        if(request('session_token') == NULL) {
            self::$sessionAuth = false;
            $this->middleware('auth:api');
        }else {
            self::$sessionAuth = true;
        }
    }

    // List all movies from user
    public function all()
    {
        if(self::$sessionAuth) {
            // Try to Decrypt Session ID
            try {
                $decryptedID = Crypt::decrypt(request('session_token'), false);
            }catch(DecryptException $e) {
                return response()->json([
                    'error' => 'Session token invalid'
                ], 400);
            }
            if(DB::table('sessions')->where('id', $decryptedID)->exists()) {
                $userID = DB::table('sessions')->where('id', $decryptedID)->value('user_id');
            }
            else {
                return response()->json([
                    'error' => 'Session token invalid'
                ], 400);
            }
        }else {
            $userID = Auth::guard('api')->user()->id;
        }
        $movies = Movie::where('userID', $userID)->orderBy('name', 'asc')->paginate(100);
        if($movies == "[]") {
            return response()->json([
                'msg' => '0 movies found'
            ], 200);
        }else {
            return response()->json($movies, 200);
        }
    }

    // List single movie
    public function single($id)
    {
        if(self::$sessionAuth) {
            // Try to Decrypt Session ID
            try {
                $decryptedID = Crypt::decrypt(request('session_token'), false);
            }catch(DecryptException $e) {
                return response()->json([
                    'error' => 'Session token invalid'
                ], 400);
            }
            if(DB::table('sessions')->where('id', $decryptedID)->exists()) {
                $userID = DB::table('sessions')->where('id', $decryptedID)->value('user_id');
            }
            else {
                return response()->json([
                    'error' => 'Session token invalid'
                ], 400);
            }
        }else {
            $userID = Auth::guard('api')->user()->id;
        }
        $movies = DB::table('movies')->where('userID', $userID)->where('movieID', $id)->get();
        if($movies == "[]") {
            return response()->json([
                'error' => 'Movie not found'
            ], 400);
        }else {
            return response()->json($movies, 200);
        }
    }

    // Delete single movie
    public function delete($id)
    {
        if(self::$sessionAuth) {
            // Try to Decrypt Session ID
            try {
                $decryptedID = Crypt::decrypt(request('session_token'), false);
            }catch(DecryptException $e) {
                return response()->json([
                    'error' => 'Session token invalid'
                ], 400);
            }
            if(DB::table('sessions')->where('id', $decryptedID)->exists()) {
                $userID = DB::table('sessions')->where('id', $decryptedID)->value('user_id');
            }
            else {
                return response()->json([
                    'error' => 'Session token invalid'
                ], 400);
            }
        }else {
            $userID = Auth::guard('api')->user()->id;
        }
        $movie = Movie::find($id);
        if($movie == NULL || $movie->userID != $userID) {
            return response()->json([
                'error' => 'Movie not found'
            ], 400);
        }else {
            $movie->delete();

            return response()->json([
                'msg' => 'Movie Deleted Successfully'
            ], 200);
        }
    }

    // Add Movie to database
    public function add()
    {
        if(self::$sessionAuth) {
            // Try to Decrypt Session ID
            try {
                $decryptedID = Crypt::decrypt(request('session_token'), false);
            }catch(DecryptException $e) {
                return response()->json([
                    'error' => 'Session token invalid'
                ], 400);
            }
            if(DB::table('sessions')->where('id', $decryptedID)->exists()) {
                $userID = DB::table('sessions')->where('id', $decryptedID)->value('user_id');
            }
            else {
                return response()->json([
                    'error' => 'Session token invalid'
                ], 400);
            }
        }else {
            $userID = Auth::guard('api')->user()->id;
        }
        if(request('name') != NULL) {
            $movie = new Movie();
            $movie->userID = $userID;
            $movie->name = request('name');
            if(request('type') != NULL) $movie->type = request('type');
            if(request('imdbID') != NULL) $movie->imdbID = request('imdbID');
            if(request('language') != NULL) $movie->language = request('language');
            if(request('country') != NULL) $movie->country = request('country');
            if(request('runtime') != NULL) $movie->runtime = request('runtime');
            if(request('year') != NULL) $movie->year = request('year');
            if(request('genre') != NULL) $movie->genre = request('genre');
            if(request('rated') != NULL) $movie->rated = request('rated');
            if(request('released') != NULL) $movie->released = request('released');
            if(request('actors') != NULL) $movie->actors = request('actors');
            if(request('director') != NULL) $movie->director = request('director');
            if(request('writer') != NULL) $movie->writer = request('writer');
            if(request('rating') != NULL) $movie->rating = request('rating');
            if(request('awards') != NULL) $movie->awards = request('awards');
            if(request('production') != NULL) $movie->production = request('production');
            if(request('rottenTomatoes') != NULL) $movie->rottenTomatoes = request('rottenTomatoes');
            if(request('plot') != NULL) $movie->plot = request('plot');
            if(request('posterURL') != NULL) $movie->posterURL = request('posterURL');
            $movie->save();
            return response()->json([
                'msg' => 'Movie Added Successfully'
            ], 200);
        }else {
            return response()->json([
                'error' => 'Name cannot be null'
            ], 400);
        }
    }

    // Update movie data
    public function update($id)
    {
        if(self::$sessionAuth) {
            // Try to Decrypt Session ID
            try {
                $decryptedID = Crypt::decrypt(request('session_token'), false);
            }catch(DecryptException $e) {
                return response()->json([
                    'error' => 'Session token invalid'
                ], 400);
            }
            if(DB::table('sessions')->where('id', $decryptedID)->exists()) {
                $userID = DB::table('sessions')->where('id', $decryptedID)->value('user_id');
            }
            else {
                return response()->json([
                    'error' => 'Session token invalid'
                ], 400);
            }
        }else {
            $userID = Auth::guard('api')->user()->id;
        }
        if(request('name') != NULL) {
            $movie = Movie::find($id);
            if($movie == NULL || $movie->userID != $userID) {
                return response()->json([
                    'error' => 'Movie not found'
                ], 400);
            }else {
                $movie->userID = $userID;
                $movie->name = request('name');
                if(request('type') != NULL) $movie->type = request('type');
                if(request('imdbID') != NULL) $movie->runtime = request('imdbID');
                if(request('language') != NULL) $movie->runtime = request('language');
                if(request('country') != NULL) $movie->runtime = request('country');
                if(request('runtime') != NULL) $movie->runtime = request('runtime');
                if(request('year') != NULL) $movie->year = request('year');
                if(request('genre') != NULL) $movie->genre = request('genre');
                if(request('rated') != NULL) $movie->rated = request('rated');
                if(request('released') != NULL) $movie->released = request('released');
                if(request('actors') != NULL) $movie->actors = request('actors');
                if(request('director') != NULL) $movie->director = request('director');
                if(request('writer') != NULL) $movie->writer = request('writer');
                if(request('rating') != NULL) $movie->rating = request('rating');
                if(request('awards') != NULL) $movie->runtime = request('awards');
                if(request('production') != NULL) $movie->runtime = request('production');
                if(request('rottenTomatoes') != NULL) $movie->rottenTomatoes = request('rottenTomatoes');
                if(request('plot') != NULL) $movie->plot = request('plot');
                if(request('posterURL') != NULL) $movie->posterURL = request('posterURL');
                $movie->save();
                return response()->json([
                    'msg' => 'Movie Updated Successfully'
                ], 200);
            }
        }else {
            return response()->json([
                'error' => 'Name cannot be null'
            ], 400);
        }
    }

    // Return movie type count
    public function count()
    {
        if(self::$sessionAuth) {
            // Try to Decrypt Session ID
            try {
                $decryptedID = Crypt::decrypt(request('session_token'), false);
            }catch(DecryptException $e) {
                return response()->json([
                    'error' => 'Session token invalid'
                ], 400);
            }
            if(DB::table('sessions')->where('id', $decryptedID)->exists()) {
                $userID = DB::table('sessions')->where('id', $decryptedID)->value('user_id');
            }
            else {
                return response()->json([
                    'error' => 'Session token invalid'
                ], 400);
            }
        }else {
            $userID = Auth::guard('api')->user()->id;
        }
        $movies = DB::table('movies')
                            ->selectRaw("IFNULL(type, 'All') as type, count(*) as count")
                            ->where('userID', $userID)
                            ->groupBy(DB::raw('type WITH ROLLUP'))
                            ->get();
        return response()->json($movies, 200);
    }

    // List all movies from user
    public function search()
    {
        if(self::$sessionAuth) {
            // Try to Decrypt Session ID
            try {
                $decryptedID = Crypt::decrypt(request('session_token'), false);
            }catch(DecryptException $e) {
                return response()->json([
                    'error' => 'Session token invalid'
                ], 400);
            }
            if(DB::table('sessions')->where('id', $decryptedID)->exists()) {
                $userID = DB::table('sessions')->where('id', $decryptedID)->value('user_id');
            }
            else {
                return response()->json([
                    'error' => 'Session token invalid'
                ], 400);
            }
        }else {
            $userID = Auth::guard('api')->user()->id;
        }
        if(request("searchTerm") != null) {
            $searchTerm = request("searchTerm");
        }else {
            return response()->json([
                'error' => 'Search term missing'
            ], 400);
        }
        $movies = Movie::where('userID', $userID)
                        ->where('name', 'LIKE', "%{$searchTerm}%")
                        ->orderBy('name', 'asc')
                        ->paginate(10);
        if($movies == "[]") {
            return response()->json([
                'msg' => '0 movies found'
            ], 400);
        }else {
            return response()->json($movies, 200);
        }
    }

    // OMDb API search
    public function OMDbSearch() {
        if(self::$sessionAuth) {
            // Try to Decrypt Session ID
            try {
                $decryptedID = Crypt::decrypt(request('session_token'), false);
            }catch(DecryptException $e) {
                return response()->json([
                    'error' => 'Session token invalid'
                ], 400);
            }
            if(DB::table('sessions')->where('id', $decryptedID)->exists()) {
                if(request('id') != null) {
                    // Search
                    $url = "http://www.omdbapi.com/?i=" . request("id") . "&apikey=11626305&plot=full";
                    $json = json_decode(stream_get_contents(fopen($url, "rb")));
                    // Check for error
                    if($json->{"Response"} == "False") {
                        return response()->json([
                            'error' => $json->{"Error"}
                        ], 400);
                    }
                    if($json->{"Response"} == "True") {
                        return response()->json($json, 200);
                    }
                }else {
                    return response()->json([
                        'error' => 'imdbID missing'
                    ], 400);
                }
            }
            else {
                return response()->json([
                    'error' => 'Session token invalid'
                ], 400);
            }
        }else {
            return response()->json([
                'error' => 'OMDbSearch is not available with api token'
            ], 400);
        }
    }
}