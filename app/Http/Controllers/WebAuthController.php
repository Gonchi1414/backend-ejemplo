<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class WebAuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }
    public function login(Request $request)
    {
        // validamos datos que vienen del formulario
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        // verificamos estado activo del usuario
        $user = User::where('email', $request->email)->first();
        if ($user && $user->estado !== 'activo') {
            return back()->withErrors(['email' => 'Usuario inactivo, comuniquese con los Administradores del sistema']);
        }
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }
        return back()->withErrors([
            'email' => 'Credenciales incorrectas',
        ]);
    }
}
