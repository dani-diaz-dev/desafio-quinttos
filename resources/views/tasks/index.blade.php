@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-3 d-flex justify-content-between align-items-center">
            Listado de Tareas
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createTaskModal">
                + Nueva tarea
            </button>
        </h1>

        {{-- Mensajes flash --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        {{-- Filtros --}}
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

        {{-- Tabla --}}
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

    {{-- Modal Crear Tarea --}}
    <div class="modal fade" id="createTaskModal" tabindex="-1" aria-labelledby="createTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('tasks.store') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="createTaskModalLabel">Nueva tarea</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">Título</label>
                            <input type="text" name="title" id="title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Descripción</label>
                            <textarea name="description" id="description" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Estado</label>
                            <select name="status" id="status" class="form-select">
                                <option value="pending" selected>Pendiente</option>
                                <option value="completed">Completada</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
