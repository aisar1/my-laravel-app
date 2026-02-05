<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // Show the registration form
    public function create()
    {
        return view('auth.register');
    }

    // Handle the form submission
    public function store(Request $request)
    {
        // 1. Validate the data (Security check)
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users', // Ensure email is unique
            'password' => 'required|min:6|confirmed', // 'confirmed' checks password_confirmation field
        ]);

        // 2. Create the User in the database
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']), // Always encrypt passwords!
        ]);

        // 3. Redirect somewhere (e.g., home)
        return redirect('/')->with('success', 'Account created successfully!');
    }
}