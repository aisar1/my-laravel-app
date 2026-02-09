<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    // 1. Show the Password Reset Form
    public function edit()
    {
        return view('profile.password');
    }

    // 2. Handle the Password Update
    public function update(Request $request)
    {
        // Validate inputs
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'], // Laravel checks this automatically
            'password' => ['required', 'confirmed', Password::min(8)->letters()->numbers()],
        ]);

        // Update Password
        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('success', 'Password updated successfully!');
    }
}