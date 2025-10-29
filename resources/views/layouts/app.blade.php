<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Desafio Quinttos - Gestión de Tareas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
@if(Auth::check())
    <nav class="mb-3">
        <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-sm">Tareas</a>
        <a href="{{ route('stats.index') }}" class="btn btn-outline-info btn-sm">Estadísticas</a>
        <form method="POST" action="{{ route('logout') }}" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-outline-danger btn-sm">Cerrar sesión</button>
        </form>
    </nav>
@endif
@yield('content')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
