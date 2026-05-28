<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <header class="header-general">
        <nav class="nav-menu">
            <a class="btn btn-register" href="/register">Registro</a>
            <a class="btn btn-login" href="/login">Ingresar</a>
        </nav>
    </header>
    <main class="container welcome-container">
        <div>
            <h1>Bienvenido a la aplicación de gestión de usuarios</h1>
            <p>Utiliza el menú para navegar por las diferentes secciones.</p>
        </div>
    </main>
</body>

</html>