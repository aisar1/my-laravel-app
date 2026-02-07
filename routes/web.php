<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomePageController;

//Route::get('/', [HomeController::class, 'index'])->name('home');


/*Route::get('/homepage', [HomePageController::class, 'display']);

// 2. The route to handle the form submission (POST)


//Route::get('/', [LoginController::class, 'index'])->name('login');
Route::get('/', function () {
    return view('login');
})->middleware('auth');
Route::post('/login', [LoginController::class, 'authenticate']);*/


Route::get('/', [LoginController::class, 'index'])->name('login');

// 1. The route to display the form (GET)
Route::get('/register', [RegisterController::class, 'create'])->name('register');

Route::get('/homepage', [HomePageController::class, 'display'])->middleware('auth')->name('homepage');

Route::post('/', [LoginController::class, 'authenticate'])->name('login');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::post('/register', [RegisterController::class, 'store'])->name('register');