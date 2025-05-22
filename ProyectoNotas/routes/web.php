<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ReminderController;
use App\Models\Category;
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
    Route::get("/", function () {
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
        $categories = Category::all();
        return view('notesForm', compact('categories'));
    })->name('notes.form');

    Route::post('/logout', [AuthController::class, 'logout'])->name("logout");
    Route::post("/notes", [NoteController::class, 'createNotes'])->name("notes.create");

    Route::get("/notes/{id}", [NoteController::class, 'show'])->name("notes.show");
    Route::put("/notes", [NoteController::class, 'update'])->name("notes.update");

    Route::delete("/notes/{id}", [NoteController::class, 'destroy'])->name("notes.delete");



    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/categoryform', [CategoryController::class, 'create'])->name('category.create');
    Route::get("/category/{id}", [CategoryController::class, 'show'])->name('category.show');
    Route::post("/category", [CategoryController::class, 'store'])->name('category.store');
    Route::put("/category", [CategoryController::class, 'update'])->name('category.update');
    Route::delete("/category/{id}", [CategoryController::class, 'destroy'])->name('category.destroy');
    Route::get('/reminderform', [ReminderController::class, 'create'])->name('reminders.create');
    Route::post('/reminder', [ReminderController::class, 'store'])->name('reminders.store');
    Route::get('/reminders', [ReminderController::class, 'upcoming'])->name('reminders.upcoming');
    Route::delete('/reminders/{id}', [ReminderController::class, 'destroy'])->name('reminders.destroy');

});
