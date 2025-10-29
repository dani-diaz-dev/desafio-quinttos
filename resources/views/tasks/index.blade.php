@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-3">Listado de Tareas</h1>

        <form method="GET" action="{{ route('tasks.index') }}" class="mb-4">
            <div class="row g-2">
                <div class="col-md-4">
                    <input type="text" name="title" value="{{ request('title') }}" placeholder="Buscar por título" class="form-control">
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-select">
                        <option value="">-- Estado --</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pendiente</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completada</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Filtrar</button>
                </div>
            </div>
        </form>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>Título</th>
                <th>Descripción</th>
                <th>Estado</th>
                <th>Fecha</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($tasks as $task)
                <tr>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->description }}</td>
                    <td>
                        <span class="badge bg-{{ $task->status === 'completed' ? 'success' : 'warning' }}">
                            {{ $task->status_label }}
                        </span>
                    </td>
                    <td>{{ $task->created_at->format('d/m/Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No se encontraron tareas.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
