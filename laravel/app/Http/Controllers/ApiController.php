<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movies;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function all()
    {
        $response = self::CheckAPIKey(request('key'));
        if($response == "APIKeyCorrect") {
            $userID = DB::table('users')->where('api_token', request('key'))->value('id');
            $movies = Movies::all()->where('userID', $userID);
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
