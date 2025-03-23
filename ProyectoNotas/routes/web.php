<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/notes', function () {
    return view('Notes');
})->name('notes.index');

Route::get('/formnotes', function () {
    return view('NotesForm');
})->name('notes.form');

Route::get('/register', function () {
    return view('Register');
})->name('register.form');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');