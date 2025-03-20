<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/notes', function () {
    return view('Notes');
})->name('notes.index');

Route::get('/formnotes', function () {
    return view('NotesForm');
})->name('notes.form');

/*PARTE DE CESAR

/* RUTAS PARA LOGIN Y REGISTRO */
Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/* PROTEGER RUTA DE DASHBOARD (Solo para usuarios autenticados) */
Route::get('/dashboard', function () {
    return "Bienvenido al dashboard";
})->middleware('auth')->name('dashboard'); 

