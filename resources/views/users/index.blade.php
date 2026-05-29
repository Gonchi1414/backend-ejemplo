@extends('layouts.app')
@section('title', 'Gestión de Usuarios')
@section('content')
<div class="table-container">
    <div class="table-header">
        <h2> Gestión de Usuarios</h2>
        <a href="{{ route('users.create') }}" class="btn btn-register">Crear Nuevo Usuario</a>
    </div>
    <div class="table-content">
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombres</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->nombres }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->rol }}</td>
                    <td>{{ $user->estado ? 'Activo' : 'Inactivo' }}</td>
                    <td class="actions">
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-edit">Editar</a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete" onclick="return confirm('¿Estás seguro de eliminar este usuario?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection