<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        return view('calendar.index');
    }

    public function getEvents()
    {
        // 1. Fetch all leaves with user info
        $leaves = Leave::with('user')->get();
        $events = [];

        foreach ($leaves as $leave) {
            // FullCalendar needs +1 day for the end date to render correctly
            // Example: Leave on 12th (1 day). Start: 12th, End: 13th (exclusive)
            $endDate = date('Y-m-d', strtotime($leave->end_date . ' +1 day'));

            // Color Logic
            if ($leave->status === 'approved') {
                $color = '#10B981'; // Green
                $title = $leave->user->name;
            } elseif ($leave->status === 'rejected') {
                $color = '#EF4444'; // Red
                $title = "Rejected: " . $leave->user->name;
            } else {
                $color = '#F59E0B'; // Orange
                $title = "Pending: " . $leave->user->name;
            }

            $events[] = [
                'id' => $leave->id,
                'title' => $title,
                'start' => $leave->start_date, // "2026-02-12"
                'end'   => $endDate,           // "2026-02-13"
                'color' => $color,
                'allDay' => true,
                
                // DATA FOR MODAL
                'extendedProps' => [
                    'status' => $leave->status,
                    'type'   => $leave->type,
                    'reason' => $leave->reason,
                    'name'   => $leave->user->name
                ]
            ];
        }

        return response()->json($events);
    }
}