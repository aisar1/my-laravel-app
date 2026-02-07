<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function display()
    {
        

        // 2. Send them to the 'home' view
        return view('welcome');
    }
}
