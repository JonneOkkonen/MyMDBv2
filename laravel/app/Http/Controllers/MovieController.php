<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Setting;

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

        // Load Movie Type options from users settings
        $options = explode(";", Setting::where('userID', Auth::id())
                                        ->orderBy('typeList', 'asc')
                                        ->value('typeList'));
        return view('movies/movie')->with('typeOptions', $options);
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

        // Load Movie Type options from users settings
        $options = explode(";", Setting::where('userID', Auth::id())
                                        ->orderBy('typeList', 'asc')
                                        ->value('typeList'));
        return view("movies/movie")->with('typeOptions', $options);
    }
}
