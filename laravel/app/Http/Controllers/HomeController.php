<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Setting;

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

    public function settings() {
        // Get user data
        $data = DB::table('users')
                    ->select('name', 'email', 'api_token')
                    ->where('id', Auth::id())
                    ->get();

        // Get setting for user
        $settings = DB::table('settings')->where('userID', Auth::id())->get();

        return view('settings', ['user' => $data[0], 'settings' => $settings[0]]);
    }

    function changeSettings() {
        // Generate New API-token
        if(request('generateToken') != null) {
            $result = DB::table('users')
                        ->where('id', Auth::id())
                        ->update(['api_token' => Str::random(60)]);
            if($result == 1) {
                return redirect()->back()->with('success', "New API-token generated successfully");
            }else {
                return redirect()->back()->with('msg', "New API-token generation failed");
            }
        }else {
            DB::transaction(function () {
                DB::table('users')
                    ->where('id', Auth::id())
                    ->update([
                        'name' => request('name'),
                        'email' => request('email')
                    ]);
                
                DB::table('settings')
                    ->where('userID', Auth::id())
                    ->update([
                        'profileStatus' => request('profileStatus'),
                        'typeList' => request('typeList')
                    ]);
            });
            return redirect()->back()->with('success', "Settings updated successfully");
        }
    }
}
