<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
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
    public function index()
    {
        return view('home');
    }

    public function session() {
        // Get Sessions from database
        $sessions = DB::table("sessions")->where('user_ID', Auth::id())->get();
        // Convert Unix Timestamp to formatted date
        foreach($sessions as $item) {
            $item->last_activity = date("d-m-Y H:i:s", $item->last_activity);
        }
        return view('auth/session')->with('sessions', $sessions);
    }

    public function session_delete() {
        // Get session id
        $id = request('deleteButton');
        $msg = "Session delete not successfull";
        $result = DB::table("sessions")->where('id', $id)->delete();
        if($result == 1) $msg = "Session deleted successfully";
        return redirect()->back()->with('msg', $msg);
    }
}
