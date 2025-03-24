<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('guest')->group(function () {
    Route::get("/", function(){
        return redirect("/login"); 
    });
    Route::get('/login', function () {
        return view('login');
    })->name('login');

    Route::get('/register', function () {
        return view('register');
    })->name("register");

    Route::post('/login', [AuthController::class, 'login'])->name("login.post");
    Route::post('/register', [AuthController::class, 'register'])->name("register.post");
});

Route::middleware('auth')->group(function () {
    Route::get('/notes', function () {
        return view('Notes');
    })->name('notes.index');

    Route::get('/formnotes', function () {
        return view('NotesForm');
    })->name('notes.form');

    Route::post('/logout', [AuthController::class, 'logout']);
});


