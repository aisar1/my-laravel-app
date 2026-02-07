<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // 1. Show the login form
    public function index()
    {
        return view('auth.login');
    }

    // 2. Handle the login attempt
    public function authenticate(Request $request)
    {
        // Validate the input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Attempt to log the user in
        // Auth::attempt automatically encrypts the password input and checks it against the database
        if (Auth::attempt($credentials)) {
            
            // SECURITY: Regenerate session ID to prevent "Session Fixation" attacks
            $request->session()->regenerate();

            // Redirect to intended page or home
            return redirect()->intended(route('homepage'));
        }

        // If login fails, go back with an error
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
    
    // 3. Handle Logout
    public function logout(Request $request) 
    {
        Auth::logout();
        
        // Invalidate the session for security
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect(route('login'));
    }
}