<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sistema Biblioteca</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="#">Biblioteca</a>
        <div>
            <a class="btn btn-outline-light me-2" href="{{ route('libros.index') }}">Libros</a>
            <a class="btn btn-outline-light me-2" href="{{ route('usuarios.index') }}">Usuarios</a>
            <a class="btn btn-outline-light" href="{{ route('prestamos.index') }}">Préstamos</a>
        </div>
    </div>
</nav>

<div class="container">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @yield('content')
</div>
</body>
</html>
