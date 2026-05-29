@extends('layouts.app')
@section('title', 'Nuevo Usuario')
@section('content')
<div class="form-container-wrapper">
    <div class="container register-container">
        <h1>Registro de nuevos usuarios</h1>
        <form action="{{ route('users.store') }}" method="post" class="register-form">
            @csrf

            <div class="form-group">
                <label for=" nombres">Nombres:</label>
                <input type="text" id="nombres" name="nombres" value="{{ old('nombres') }}" required>
            </div>
            <div class="form-group">
                <label for="apellidos">Apellidos:</label>
                <input type="text" id="apellidos" name="apellidos" value="{{ old('apellidos') }}" required>
            </div>
            <div class="form-group">
                <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            </div>
            <div class="form-group">
                <label for="rol">Rol:</label>
                <select id="rol" name="rol">
                    <option value="">Selecciona un rol</option>
                    <option value="admin" {{ old('rol') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="user" {{ old('rol') == 'user' ? 'selected' : '' }}>User</option>
                </select>
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirmar Contraseña:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>
            <button type="submit" class="btn btn-register">Registrar</button>

        </form>
        @if ($errors->any())
        <div class="error-messages">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
</div>

@endsection