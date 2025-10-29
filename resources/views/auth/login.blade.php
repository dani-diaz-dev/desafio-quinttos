@extends('layouts.app')

@section('content')
    <div class="container mt-5" style="max-width: 420px;">
        <h2 class="mb-4 text-center">Iniciar sesión</h2>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @elseif(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('login.perform') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Correo electrónico</label>
                <input type="email" name="email" value="{{ old('email') }}"
                       class="form-control @error('email') is-invalid @enderror"
                       required autofocus>
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input type="password" name="password"
                       class="form-control @error('password') is-invalid @enderror"
                       required>
                @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary w-100">Entrar</button>
        </form>
    </div>
@endsection
