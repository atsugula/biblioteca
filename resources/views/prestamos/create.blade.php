@extends('layouts.app')
{{-- @extends('layout') --}}

@section('content')
<h1>Registrar Préstamo</h1>

<form action="{{ route('prestamos.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Libro</label>
        <select name="libro_id" class="form-control select2">
            @foreach($libros as $libro)
                <option value="{{ $libro->id }}">{{ $libro->titulo }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label>Usuario</label>
        <select name="usuario_id" class="form-control select2">
            @foreach($usuarios as $usuario)
                <option value="{{ $usuario->id }}">{{ $usuario->nombre_completo }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label>Fecha de préstamo</label>
        <input type="date" name="fecha_prestamo" class="form-control">
    </div>
    <button class="btn btn-success">Guardar</button>
</form>
@endsection
