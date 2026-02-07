<?php

namespace App\Http\Controllers;

use App\Models\Post; // Import your Post model
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // 1. Get all posts from the database (latest first)
        $posts = Post::latest()->get();

        // 2. Send them to the 'home' view
        return view('home', ['posts' => $posts]);
    }
}