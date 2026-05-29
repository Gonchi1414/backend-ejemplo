<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de nuevos usuarios</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <header class="header-general">
        <div class="left">
            <a class="btn btn-out" href="/">Volver a Inicio</a>
        </div>
    </header>
    <main class="container register-container">
        <h1>Registro de nuevos usuarios</h1>
        <form action="/register" method="post" class="register-form">
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
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirmar Contraseña:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>
            <button type="submit" class="btn btn-register">Registrar</button>
        </form>
        <br>
        <p>¿Ya tienes una cuenta? <a href="/login">Inicia sesión aquí</a></p>
    </main>
</body>

</html>