
@extends('app.layout')
@section('titulo')
    Página 1
@endsection

@section('contenido')
    <h1>Validaciones</h1>

    <div class="container mt-4">
        {{-- Formulario con POST hacia la ruta --}}
        <form method="POST" action="{{ route('pag-4') }}" >
        
            @csrf
            
            {{-- Nombre --}}
            <div class="col-md-6">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required minlength="3" maxlength="50" value="{{ old('nombre') }}">
                <div class="invalid-feedback">
                    Por favor ingresa un nombre válido.
                </div>
                @error('nombre')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Edad --}}
            <div class="col-md-6">
                <label for="edad" class="form-label">Edad</label>
                <input type="number" class="form-control" id="edad" name="edad" required min="1" max="120" value="{{ old('edad') }}">
                <div class="invalid-feedback">
                    Ingresa una edad válida entre 1 y 120.
                </div>
                @error('edad')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Sexo --}}
            <div class="col-md-6">
                <label for="sexo" class="form-label">Sexo</label>
                <select class="form-select" id="sexo" name="sexo" required>
                    <option selected disabled value="">Selecciona...</option>
                    <option value="M" {{ old('sexo') == 'M' ? 'selected' : '' }}>Masculino</option>
                    <option value="F" {{ old('sexo') == 'F' ? 'selected' : '' }}>Femenino</option>
                    <option value="O" {{ old('sexo') == 'O' ? 'selected' : '' }}>Otro</option>
                </select>
                <div class="invalid-feedback">
                    Por favor selecciona una opción.
                </div>
                @error('sexo')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Correo --}}
            <div class="col-md-6">
                <label for="correo" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" id="correo" name="correo" required value="{{ old('correo') }}">
                <div class="invalid-feedback">
                    Ingresa un correo válido.
                </div>
                @error('correo')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Botón --}}
            <div class="col-12">
                <button class="btn btn-primary" type="submit">Enviar</button>
            </div>
        </form>
    </div>

    {{-- Script de validación Bootstrap --}}
    <script>
        (() => {
            'use strict';
            const forms = document.querySelectorAll('.needs-validation');
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();
    </script>
@endsection
