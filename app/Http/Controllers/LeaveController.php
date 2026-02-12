<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{
    // 1. List Leaves (Admin sees all, Staff sees theirs)
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            $leaves = Leave::with('user')->latest()->get();
        } else {
            $leaves = Leave::where('user_id', Auth::id())->latest()->get();
        }

        return view('leaves.index', compact('leaves'));
    }

    // 2. Show Application Form
    public function create()
    {
        return view('leaves.create');
    }

    // 3. Store Application (Staff)
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string|max:255',
        ]);

        Leave::create([
            'user_id' => Auth::id(),
            'name'    => Auth::user()->name,
            'type' => $request->type,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'reason' => $request->reason,
            'status' => 'pending',
        ]);

        return redirect()->route('leaves.index')->with('success', 'Leave application submitted.');
    }

    // 4. Update Status (Admin Only)
    public function updateStatus(Request $request, Leave $leave)
    {
        // Security check: Only admins can do this
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $leave->update([
            'status' => $request->status,
            'admin_remark' => $request->admin_remark,
        ]);

        return back()->with('success', 'Leave status updated.');
    }
}