<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\ProfileController;

//Route::get('/', [HomeController::class, 'index'])->name('home');


/*Route::get('/homepage', [HomePageController::class, 'display']);

// 2. The route to handle the form submission (POST)


//Route::get('/', [LoginController::class, 'index'])->name('login');
Route::get('/', function () {
    return view('login');
})->middleware('auth');
Route::post('/login', [LoginController::class, 'authenticate']);*/


Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/', [LoginController::class, 'authenticate'])->name('login');


Route::post('/register', [RegisterController::class, 'store'])->name('register');




Route::middleware('auth')->group(function () {
    // ... existing routes ...
    Route::get('/homepage', [HomePageController::class, 'display'])->name('homepage');
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    // Salary section
    Route::get('/salary', [SalaryController::class, 'index'])->name('salary.index');
    Route::get('/salary/download', [SalaryController::class, 'download'])->name('salary.download');

    //reset password
    Route::get('/profile/password', [ProfileController::class, 'edit'])->name('password.edit');
    Route::put('/profile/password', [ProfileController::class, 'update'])->name('password.update');
});



Route::post('/logout', [LoginController::class, 'logout'])->name('logout');



