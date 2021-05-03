<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $loginWasSuccessful = Auth::attempt([ 
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ]);
        
        if ($loginWasSuccessful){
            $name = Auth::user()->name;
            return redirect()->route('home.user')->with('success', "Logged in");
        } else {
            return redirect()->route('auth.loginForm')->with('error', 'Invalid credentials.');
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('home.index')->with('success', "Logged out");
    }
    public function logoutRedirect()
    {
        // Auth::logout();
        return redirect()->route('home.index')->with('error', "Invalid URL");
    }
}