<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    // List all movies from user
    // Add Pagination in future
    public function all()
    {
        $response = self::CheckAPIKey(request('key'));
        if($response == "APIKeyCorrect") {
            $userID = DB::table('users')->where('api_token', request('key'))->value('id');
            $movies = Movie::all()->where('userID', $userID);
            return response()->json($movies, 200);
        }else {
            return $response;
        }
    }

    // List single movie
    // Checks userID. Doesn't show other users movies
    public function single($id)
    {
        $response = self::CheckAPIKey(request('key'));
        if($response == "APIKeyCorrect") {
            $userID = DB::table('users')->where('api_token', request('key'))->value('id');
            $movies = Movie::all()->where('userID', $userID)->where('movieID', $id);
            if($movies == "[]") {
                return response()->json([
                    'error' => 'Movie not found'
                ], 400);
            }else {
                return response()->json($movies, 200);
            }
        }else {
            return $response;
        }
    }

    // Add Movie to database
    public function add()
    {
        $response = self::CheckAPIKey(request('key'));
        if($response == "APIKeyCorrect") {
            $userID = DB::table('users')->where('api_token', request('key'))->value('id');
            if(request('name') != NULL) {
                $movie = new Movie();
                $movie->userID = $userID;
                $movie->name = request('name');
                if(request('type') != NULL) $movie->type = request('type');
                if(request('runtime') != NULL) $movie->runtime = request('runtime');
                if(request('year') != NULL) $movie->year = request('year');
                if(request('genre') != NULL) $movie->genre = request('genre');
                if(request('rated') != NULL) $movie->rated = request('rated');
                if(request('released') != NULL) $movie->released = request('released');
                if(request('actors') != NULL) $movie->actors = request('actors');
                if(request('director') != NULL) $movie->director = request('director');
                if(request('writer') != NULL) $movie->writer = request('writer');
                if(request('rating') != NULL) $movie->rating = request('rating');
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
        }else {
            return $response;
        }
    }

    // Update movie data
    public function update($id)
    {
        $response = self::CheckAPIKey(request('key'));
        if($response == "APIKeyCorrect") {
            $userID = DB::table('users')->where('api_token', request('key'))->value('id');
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
                    if(request('runtime') != NULL) $movie->runtime = request('runtime');
                    if(request('year') != NULL) $movie->year = request('year');
                    if(request('genre') != NULL) $movie->genre = request('genre');
                    if(request('rated') != NULL) $movie->rated = request('rated');
                    if(request('released') != NULL) $movie->released = request('released');
                    if(request('actors') != NULL) $movie->actors = request('actors');
                    if(request('director') != NULL) $movie->director = request('director');
                    if(request('writer') != NULL) $movie->writer = request('writer');
                    if(request('rating') != NULL) $movie->rating = request('rating');
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
        }else {
            return $response;
        }
    }

    // Return movie type count
    public function count()
    {
        $response = self::CheckAPIKey(request('key'));
        if($response == "APIKeyCorrect") {
            $userID = DB::table('users')->where('api_token', request('key'))->value('id');
            $sql = "SELECT IFNULL(type, 'All') as type, count(*) as count FROM movies WHERE userID = 1 GROUP BY type WITH ROLLUP";
            $movies = DB::table('movies')
                                ->selectRaw("IFNULL(type, 'All') as type, count(*) as count")
                                ->where('userID', $userID)
                                ->groupBy(DB::raw('type WITH ROLLUP'))
                                ->get();
            return response()->json($movies, 200);
        }else {
            return $response;
        }
    }

    // Check if API key is correct
    public function CheckAPIKey($key) {
        if($key) {
            if(DB::table('users')->where('api_token', $key)->exists()) {
                return "APIKeyCorrect";
            }else {
                return response()->json([
                    'error' => 'API-key incorrect'
                ], 400);
            }
        }else {
            return response()->json([
                'error' => 'No API-key'
            ], 400);
        }
    }
}
