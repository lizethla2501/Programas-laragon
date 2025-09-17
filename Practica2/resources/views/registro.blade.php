@extends('app.inicio')

@section('title')
    Registro
@endsection

@section('contenedor')
<div class="d-flex justify-content-center align-items-center vh-100" style="background: linear-gradient(135deg, #f8bbd0, #ce93d8);">
    <div class="card shadow-lg p-4" style="max-width: 450px; width: 100%; border-radius: 20px; background-color: #fff0f6;">
        <div class="text-center mb-4">
            <h1 style="color: #8e24aa; font-weight: bold;">Registro</h1>
            <p style="color: #ad1457;">Crea tu cuenta fácilmente</p>
        </div>

        <form action="{{ route('hacer-registro') }}" method="POST">
            @csrf

            {{-- Nombre --}}
            <div class="mb-3">
                <label class="form-label" style="color:#6a1b9a;">Nombre</label>
                <input name="name" type="text" class="form-control rounded-pill shadow-sm @error('name') is-invalid @enderror">
                @error('name')
                <p class="text-danger small mt-1 text-center">{{$message}}</p>
                @enderror
            </div>

            {{-- Correo --}}
            <div class="mb-3">
                <label class="form-label" style="color:#6a1b9a;">Correo</label>
                <input name="email" type="email" class="form-control rounded-pill shadow-sm @error('email') is-invalid @enderror">
                <div class="form-text">Ingresa tu correo</div>
                @error('email')
                <p class="text-danger small mt-1 text-center">{{$message}}</p>
                @enderror
            </div>

            {{-- Contraseña --}}
            <div class="mb-3">
                <label class="form-label" style="color:#6a1b9a;">Contraseña</label>
                <input name="password" type="password" class="form-control rounded-pill shadow-sm @error('password') is-invalid @enderror">
                @error('password')
                <p class="text-danger small mt-1 text-center">{{$message}}</p>
                @enderror
            </div>

            {{-- Confirmar contraseña --}}
            <div class="mb-3">
                <label class="form-label" style="color:#6a1b9a;">Confirmar contraseña</label>
                <input name="password_confirmation" type="password" class="form-control rounded-pill shadow-sm @error('password_confirmation') is-invalid @enderror">
                @error('password_confirmation')
                <p class="text-danger small mt-1 text-center">{{$message}}</p>
                @enderror
            </div>

            {{-- Botón --}}
            <div class="d-grid">
                <button type="submit" class="btn btn-lg text-white rounded-pill shadow-sm"
                    style="background: linear-gradient(135deg, #ce93d8, #f48fb1); border:none;">
                    Aceptar
                </button>
            </div>
        </form>
    </div>
</div>
@endsection