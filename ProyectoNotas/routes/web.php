<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NoteController;
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
    Route::get('/notes', [NoteController::class, 'index'])->name(name: 'notes.index');
    Route::get("/notes/importante", [NoteController::class, 'importantNotes'])->name('notes.importante');

    Route::get('/formnotes', function () {
        return view('NotesForm');
    })->name('notes.form');

    Route::post('/logout', [AuthController::class, 'logout'])->name("logout");
    Route::post("/notes", [NoteController::class, 'createNotes'])->name("notes.create");

    Route::get("/notes/{id}", [NoteController::class, 'show'])->name("notes.show");
    Route::put("/notes", [NoteController::class, 'update'])->name("notes.update");
    
    Route::delete("/notes/{id}", [NoteController::class, 'destroy'])->name("notes.delete");



    Route::get('/category');
});


