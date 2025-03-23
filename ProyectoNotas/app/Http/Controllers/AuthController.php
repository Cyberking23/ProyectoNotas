<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'FirstName' => 'required|string|max:255',
            'LastName' => 'required|string|max:255',
            'PhoneNumber' => 'required|string|max:15',
            'Email' => 'required|string|email|max:255|unique:users',
            'Password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'FirstName' => $request->input('FirstName'),
            'LastName' => $request->input('LastName'),
            'PhoneNumber' => $request->input('PhoneNumber'),
            'Email' => $request->input('Email'),
            'Password' => Hash::make($request->input('Password')),
        ]);

        return response()->json([
            'user' => $user,
            'message' => 'Usuario registrado exitosamente'
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'Email' => 'required|email',
            'Password' => 'required|string|min:8'
        ]);

        $credentials = [
            'Email' => $request->Email,
            'password' => $request->Password,
        ];

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Credenciales incorrectas'], 401);
        }

        $user = auth()->user();

        return response()->json([
            'message' => 'Usuario autenticado con éxito',
            'token' => $token,
            'user' => $user
        ], 200);
    }

    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());

        return response()->json(['message' => 'Sesión cerrada correctamente']);
    }
}