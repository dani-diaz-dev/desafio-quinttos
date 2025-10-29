<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Desafio Quinttos - Gestión de Tareas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
@if(Auth::check())
    <form method="POST" action="{{ route('logout') }}" class="d-inline right-panel">
        @csrf
        <button type="submit" class="btn btn-sm">Cerrar sesión</button>
    </form>
@endif
@yield('content')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
