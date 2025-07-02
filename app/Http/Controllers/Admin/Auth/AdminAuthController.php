<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    // show login form
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }
    // handle login request
    public function login(Request $request)
    {
        // check if the request is valid
        $request->validate([
            'username' => 'required',
            'password' => 'required|min:6',
        ]);
        // check if the user is an admin
        $credentials = $request->only('username', 'password');
        if (auth()->attempt($credentials)) {
            // check if the user is an admin
            if (auth()->user()->role === 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Welcome to the admin dashboard');
            } else {
                auth()->logout();
                return redirect()->back()->withErrors(['error' => 'You are not authorized to access this area']);
            }
        }
    }
}
