<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'phone_number' => $request->input('phone_number'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        return redirect()->back()->with('success', 'Usuario registrado exitosamente');
    }

    
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8'
        ]);
    
        $user = User::where('email', $request->email)->first();
    
        if (!$user || !Hash::check($request->password, $user->password)) {
            return redirect()->route('login')->with('error', 'Credenciales incorrectas');
        }
    
        Auth::login($user);
        session(['user' => $user]);
    
        return redirect()->route('notes.index')->with('success', 'Inicio de sesión exitoso');
    }

    public function logout()
    {
        Auth::logout();
        session()->flush();

        return redirect()->route('login')->with('success', 'Sesión cerrada correctamente');
    }
}
