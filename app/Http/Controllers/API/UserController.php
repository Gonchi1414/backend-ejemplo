<?php

namespace App\Http\Controllers\API;

use APP\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller

{
    public function index()
    {
        return response()->json(['status' => 'success', 'data' => User::all()], 200);
    }

    /**
     * Display the specified resource.
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'Usuario no encontrado'], 404);
        }
        return response()->json(['status' => 'success', 'data' => $user], 200);
    }
    /**
     * Summary of update
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'Usuario no encontrado'], 404);
        }
        if ($user->rol === 'root') {
            return response()->json(['status' => 'error', 'message' => 'No se puede modificar un usuario root'], 403);
        }
        $validator = Validator::make($request->all(), [
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'rol' => 'nullable|string|in:root,admin,user',
            'estado' => 'nullable|string|in:activo,inactivo',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => 'Datos inválidos', 'errors' => $validator->errors()], 422);
        }
        $data = $request->only(['nombres', 'apellidos', 'email', 'password', 'rol', 'estado']);
        if ($request->has('password')) {
            $data['password'] = Hash::make($request->input('password'));
        }
        if (isset($data['rol']) && $data['rol'] === 'root' && $user->rol !== 'root') {
            return response()->json(['status' => 'error', 'message' => 'No se puede asignar el rol root a un usuario'], 403);
        }
        $user->update($data);
        return response()->json(['status' => 'success', 'message' => 'Usuario actualizado'], 200);
        
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'Usuario no encontrado'], 404);
        }
        if ($user->rol === 'root') {
            return response()->json(['status' => 'error', 'message' => 'No se puede eliminar un usuario root'], 403);
        }
        $user->delete();//softdelete
        return response()->json(['status' => 'success', 'message' => 'Usuario eliminado'], 200);
    }
}
