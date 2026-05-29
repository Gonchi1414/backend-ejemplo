<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class WebUserController extends Controller
{
    private function checkAdmin()
    {
        if (!Auth::check() || !in_array(Auth::user()->rol, ['root', 'admin'])) {
            abort(403, 'Acceso no autorizado');
        }
    }
    public function index()
    {
        $this->checkAdmin();
        $users = User::all();
        return view('users.index', compact('users'));
    }
    public function create()
    {
        $this->checkAdmin();
        return view('users.create');
    }
    public function store(Request $request)
    {
        $this->checkAdmin();
        $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'rol' => 'nullable|in:root,admin,user',
            'estado' => 'nullable|in:activo,inactivo',
        ]);
        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        if (empty($data['rol'])) $data['rol'] = 'user';
        if (empty($data['estado'])) $data['estado'] = 'activo';
        User::create($data);
        return redirect()->route('users.index')->with('success', 'Usuario creado exitosamente');
    }
    /**
     * Show the form for editing the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->checkAdmin();
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }
    /**
     * Update the specified resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  int  $id
      * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->checkAdmin();
        $user = User::findOrFail($id);
        $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'rol' => 'nullable|in:root,admin,user',
            'estado' => 'nullable|in:activo,inactivo',
        ]);
        $data = $request->only(['nombres', 'apellidos', 'fecha_nacimiento', 'email', 'rol', 'estado']);
        if($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }
        if (isset($data['rol']) && $data['rol'] === 'root' && $user->rol !== 'root') {
            return redirect()->route('users.index')->with('error', 'No puedes asignar el rol de root a otro usuario');
        }
        $user->update($data);
        return redirect()->route('users.index')->with('success', 'Usuario actualizado exitosamente');
    }
    /**
     * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
     */    
    public function destroy($id){
        $this->checkAdmin();
        $user = User::findOrFail($id);
        if ($user->rol === 'root') {
            return redirect()->route('users.index')->with('error', 'No puedes eliminar un usuario con rol root');
        }
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuario eliminado exitosamente');
    }
}