@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Estadísticas de tus tareas</h1>

        <div class="row g-3 mb-5">
            <div class="col-md-3">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-muted">Total</h5>
                        <h2>{{ $stats['total'] }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-muted">Completadas</h5>
                        <h2 class="text-success">{{ $stats['completed'] }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-muted">Pendientes</h5>
                        <h2 class="text-warning">{{ $stats['pending'] }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-muted">% Completadas</h5>
                        <h2>{{ $stats['percent'] }}%</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('home') }}" class="btn btn-primary">Volver al listado</a>
        </div>
    </div>
@endsection
