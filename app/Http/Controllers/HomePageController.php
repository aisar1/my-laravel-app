<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomePageController extends Controller
{
    public function display()
    {
        
// 2. Get the currently logged-in user
        $user = Auth::user();

        // 3. Pass data to the view
        return view('welcome', compact('user'));
    }
}
