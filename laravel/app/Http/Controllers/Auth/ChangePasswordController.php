<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Hash;
use Auth;

class ChangePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show() {
        return view('auth/passwords/change');
    }

    public function change() {
        if (!(Hash::check(request('oldPassword'), Auth::user()->password))) {
            return redirect()->back()->with("msg","Old password is incorrect");
        }
        if(strcmp(request('oldPassword'), request('password')) == 0){
            return redirect()->back()->with("msg","New password can't be the same as old password");
        }
        if(strcmp(request('password'), request('password_confirmation')) != 0) {
            return redirect()->back()->with("msg", "New passwords doesn't match");
        }
        $validatedData = request()->validate([
            'oldPassword' => 'required',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ],[
            'oldPassword.required' => 'Old password is required',
            'password.required'  => 'New Password is required',
            'password_confirmation' => 'Password confirmation is required',
            'password.min'  => 'New Password min lenght is 6',
            'password_confirmation.min' => 'Password confirmation min lenght is 6'
        ]);
        $user = Auth::user();
        $user->password = bcrypt(request('password'));
        $user->save();
        return redirect()->back()->with("success","Password changed successfully");
    }
}
