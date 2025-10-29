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
        <table class="table table-striped align-middle">
            <thead>
            <tr>
                <th>Título</th>
                <th>Descripción</th>
                <th>Estado</th>
                <th>Fecha</th>
                <th class="text-end">Acciones</th>
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
                    <td class="text-end">
                        <button class="btn btn-sm btn-primary edit-btn" data-id="{{ $task->id }}">Editar</button>
                        <button class="btn btn-sm btn-danger delete-btn" data-id="{{ $task->id }}">Eliminar</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No se encontraron tareas.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    {{-- Modal Crear --}}
    @include('tasks.partials.create-modal')

    {{-- Modal Editar --}}
    @include('tasks.partials.edit-modal')

    {{-- Modal Eliminar --}}
    @include('tasks.partials.delete-modal')

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Editar tarea
            document.querySelectorAll('.edit-btn').forEach(btn => {
                btn.addEventListener('click', async () => {
                    const id = btn.dataset.id;
                    const res = await fetch(`/tasks/${id}/edit`);
                    const task = await res.json();

                    document.getElementById('editId').value = task.id;
                    document.getElementById('editTitle').value = task.title;
                    document.getElementById('editDescription').value = task.description || '';
                    document.getElementById('editStatus').value = task.status;

                    document.getElementById('editTaskForm').action = `/tasks/${id}`;
                    new bootstrap.Modal('#editTaskModal').show();
                });
            });

            // Eliminar tarea
            document.querySelectorAll('.delete-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    const id = btn.dataset.id;
                    document.getElementById('deleteTaskForm').action = `/tasks/${id}`;
                    document.getElementById('deleteId').value = id;
                    new bootstrap.Modal('#deleteTaskModal').show();
                });
            });
        });
    </script>
@endsection
