<?php
namespace App\Http\Controllers\API;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'rol' => 'nullable|string|in:root,admin,user',
            'estado' => 'nullable|string|in:activo,inactivo',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $rol = $request->input('rol', 'user');
        if ($rol ==='root' && User::where('rol', 'root')->exists()) {
            return response()->json(['error' => 'Ya existe un usuario con rol root'], 403);
        }
        try {
            $user= User::create([
                'nombres' => $request->nombres,
                'apellidos' => $request->apellidos,
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'rol' => $rol,
                'estado' => $request->input('estado', 'activo'),
            ]);
            return response()->json(['status' => 'User created successfully', 'user' => $user], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al crear el usuario: ' . $e->getMessage()], 500);
        }
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $user = User::where('email', $request->input('email'))->first();
        if (!$user || !Hash::check($request->input('password'), $user->password)) {
            return response()->json(['error' => 'Credenciales incorrectas'], 401);
        }
        if ($user->estado !== 'activo') {
            return response()->json(['error' => 'Usuario inactivo, comuniquese con los Administradores del sistema'], 403);
        }
        // $token = $user->createToken('auth_token')->plainTextToken;
        $token = 'mocked_token_for_demo_purposes'; // Reemplaza esto con la generación real del token
        return response()->json(['status' => 'Login successful', 'access_token' => $token, 'token_type' => 'Bearer']);
    }
}