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

    public function showRegister()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'rol' => 'nullable|string|in:root,admin,user',
            'estado' => 'nullable|string|in:activo,inactivo',
        ]);

        $user = User::create([
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'rol' => $request->input('rol', 'user'),
            'estado' => $request->input('estado', 'activo'),
        ]);

        Auth::login($user);

        // return redirect()->intended('dashboard');
        return redirect('dashboard');
    }

    public function showDashboard()
    {
        return view('dashboard');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
