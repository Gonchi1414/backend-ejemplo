<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DashBoard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
    <header class="header-general">
        <div class="user-info left">
            <span>
                Hola, {{ auth()->user()->nombres }}
            </span>
            <br>
            <small> Email: {{ auth()->user()->email }}</small>
        </div>
        <div class="right">
            <form action="/logout" method="post" class="logout-form">
                @csrf
                <button type="submit" class="btn btn-logout">Cerrar Sesión</button>
            </form>
        </div>
    </header>
    <main class="dashboard-container">
        <h1>Bienvenido al Dashboard</h1>
        <p>Esta es la página de inicio después de iniciar sesión.</p>
    </main>
</body>

</html>