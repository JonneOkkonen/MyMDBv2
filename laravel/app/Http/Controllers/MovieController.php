<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class MovieController extends Controller
{
    /**
     * Create a new controller instance.
     * Require Authentication
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function view()
    {
        // Set page cookie to 1
        setcookie("page", 1);
        return view('movies/view');
    }

    public function add() {
        // Set mode to cookie
        setcookie("mode", "add");
        return view('movies/movie');
    }

    public function detail($id) {
        // Save MovieID to cookie
        setcookie("movieID", $id);
        return view('movies/detail');
    }

    public function edit($id) {
        // Save MovieID and form mode to cookie
        setcookie("movieID", $id);
        setcookie("mode", "edit");
        return view("movies/movie");
    }
}
