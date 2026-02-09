<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        // 1. Validate inputs (Added 'role')
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'phone' => 'nullable|string|max:20',
            'department' => 'required|string',
            'position' => 'required|string',
            'salary' => 'required|numeric|min:0',
            'joining_date' => 'required|date',
            // NEW: Ensure role is either 'admin' or 'staff'
            'role' => 'required|string|in:admin,staff', 
        ]);

        // 2. Generate Temp Password
        $temporaryPassword = Str::random(8);

        // 3. Hash Password
        $validated['password'] = Hash::make($temporaryPassword);

        // 4. Create Employee
        Employee::create($validated);

        // 5. Redirect
        return redirect()->route('employees.create')
            ->with('success', 'Employee created! Temporary Password: ' . $temporaryPassword);
    }
}