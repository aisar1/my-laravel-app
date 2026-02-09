<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str; // <--- Import Str for random password

class RegisterController extends Controller
{
    // Show the form
    public function create()
    {
        return view('auth.register');
    }

    // Handle form submission
    public function store(Request $request)
    {
        // 1. Validate inputs (removed 'password' from rules)
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'nullable|string|max:20',
            'department' => 'required|string',
            'position' => 'required|string',
            'salary' => 'required|numeric|min:0',
            'joining_date' => 'required|date',
            'role' => 'required|string|in:admin,staff',
        ]);

        // 2. Generate a random temporary password (8 characters)
        $temporaryPassword = Str::random(8);

        // 3. Create the User
        User::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'department' => $validated['department'],
            'position' => $validated['position'],
            'salary' => $validated['salary'],
            'joining_date' => $validated['joining_date'],
            'role' => $validated['role'],
            'password' => Hash::make($temporaryPassword), // Hash the random password
        ]);

        // 4. Redirect back with success message AND the password
        return redirect()->back()
            ->with('success', 'Employee created successfully! Temporary Password: ' . $temporaryPassword);
    }
}