<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
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

    public function add()
    {
        $response = self::CheckAPIKey(request('key'));
        if($response == "APIKeyCorrect") {
            $userID = DB::table('users')->where('api_token', request('key'))->value('id');
            if(request('name') != NULL) {
                $movie = new Movie();
                $movie->userID = $userID;
                $movie->name = request('name');
                $movie->type = request('type');
                $movie->runtime = request('runtime');
                $movie->year = request('year');
                $movie->genre = request('genre');
                $movie->rated = request('rated');
                $movie->released = request('released');
                $movie->actors = request('actors');
                $movie->director = request('director');
                $movie->writer = request('writer');
                $movie->rating = request('rating');
                $movie->rottenTomatoes = request('rottenTomatoes');
                $movie->plot = request('plot');
                $movie->posterURL = request('posterURL');
    
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
