@extends('layouts.app')
{{-- @extends('layout') --}}

@section('content')
<h1>Editar Préstamo</h1>

<form action="{{ route('prestamos.update', $prestamo) }}" method="POST">
    @csrf @method('PUT')
    <div class="mb-3">
        <label>Libro</label>
        <select name="libro_id" class="form-control">
            @foreach($libros as $libro)
                <option value="{{ $libro->id }}">{{ $libro->titulo }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label>Usuario</label>
        <select name="usuario_id" class="form-control">
            @foreach($usuarios as $usuario)
                <option value="{{ $usuario->id }}">{{ $usuario->nombre_completo }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label>Fecha de préstamo</label>
        <input type="date" name="fecha_prestamo" class="form-control">
    </div>
    <button class="btn btn-primary">Actualizar</button>
</form>
@endsection
