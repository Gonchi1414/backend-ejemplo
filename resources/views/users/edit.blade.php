@extends('layouts.app')
@section('title', 'Editar Usuario')
@section('content')
<div class="form-container-wrapper">
    <div class="container register-container">
        <h1>Editar Usuario</h1>
        <form action="{{ route('users.update', $user->id) }}" method="post" class="register-form">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nombres">Nombres:</label>
                <input type="text" id="nombres" name="nombres" value="{{ old('nombres', $user->nombres) }}" required>
            </div>
            <div class="form-group">
                <label for="apellidos">Apellidos:</label>
                <input type="text" id="apellidos" name="apellidos" value="{{ old('apellidos', $user->apellidos) }}" required>
            </div>
            <div class="form-group">
                <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento', $user->fecha_nacimiento) }}" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
            </div>
            <div class="form-group">
                <label for="rol">Rol:</label>
                <select id="rol" name="rol" required>
                    <option value="">Selecciona un rol</option>
                    <option value="admin" {{ old('rol', $user->rol) == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="user" {{ old('rol', $user->rol) == 'user' ? 'selected' : '' }}>User</option>
                </select>
            </div>
            <div class="form-group">
                <label for="estado">Estado:</label>
                <select id="estado" name="estado" required>
                    <option value="">Selecciona un estado</option>
                    <option value="1" {{ old('estado', $user->estado) == '1' ? 'selected' : '' }}>Activo</option>
                    <option value="0" {{ old('estado', $user->estado) == '0' ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>
            <div class="form-group">
                <label for="password">Contraseña (dejar en blanco para mantener la actual):</label>
                <input type="password" id="password" name="password">
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirmar Contraseña:</label>
                <input type="password" id="password_confirmation" name="password_confirmation">
            </div>
            <button type="submit" class="btn btn-register">Actualizar</button>
        </form>
    </div>
</div>
@endsection