<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('login');
})->name('login');

Route::get('/notes', function () {
    return view('Notes');
})->name('notes.index');

Route::get('/formnotes', function () {
    return view('NotesForm');
})->name('notes.form');

Route::get('/register', function () {
    return view('Register');
})->name('register.form');



Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');