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
        return view('movies/view');
    }
}
