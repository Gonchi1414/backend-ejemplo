<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel de Administración')</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="admin-layout">
    <aside class="sidebar">
        <div class="sidebar-header">Panel Admin</div>
        <nav class="sidebar-nav">
            <a href="/dashboard" class="{{ request()->is('dashboard') ? 'active' : '' }}">Dashboard</a>
            @if(auth()->check() && in_array(auth()->user()->rol, ['root', 'admin']))
            <a href="/users" class="{{ request()->is('users') ? 'active' : '' }}">Gestión de Usuarios</a>
            @endif
        </nav>
    </aside>
    <div class="main-content">
        <header class="header-general">
            <div>
                <span>Bienvenido, {{ auth()->user()->nombres }}</span>
                <br>
                <span>{{ auth()->user()->email }}</span>
            </div>
            <form action="{{ route('logout') }}" method="post" class="logout-form">
                @csrf
                <button type="submit" class="btn btn-logout">Cerrar Sesión</button>
            </form>
        </header>
        <main>
            @yield('content')
        </main>
    </div>
</body>

</html>