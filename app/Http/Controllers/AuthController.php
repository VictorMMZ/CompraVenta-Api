<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    // Procesar login del usuario
   public function login(Request $request)
{
    $validated = $request->validate([
        'email' => 'required|email',
        'password' => 'required|string|min:6',
    ]);

    if (!Auth::attempt($validated)) {

        return response()->json([
            'message' => 'Las credenciales no son válidas'
        ], 401);

    }

    $request->session()->regenerate();

    return response()->json([
        'message' => 'Login correcto',
        'user' => Auth::user()
    ], 200);
}

// logout del usuario
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Sesión cerrada correctamente');
    }

   // Obtener el usuario autenticado
    public function user(Request $request)
    {
        return response()->json(Auth::user());
    }

}