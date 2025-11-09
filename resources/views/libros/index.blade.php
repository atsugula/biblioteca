@extends('layouts.app')

@section('content')
<h1>Libros</h1>

<a href="{{ route('libros.create') }}" class="btn btn-primary mb-3">Registrar Libro</a>

{{-- Filtro por categoría --}}
<form method="GET" action="{{ route('libros.index') }}" class="mb-4 d-flex align-items-center">
    <input type="text" name="categoria" class="form-control me-2"
           placeholder="Buscar por categoría..." value="{{ $categoriaBuscada }}">
    <button type="submit" class="btn btn-secondary">Filtrar</button>
    @if ($categoriaBuscada)
        <a href="{{ route('libros.index') }}" class="btn btn-link">Quitar filtro</a>
    @endif
</form>

@if($categoriaBuscada)
    <div class="alert alert-info">
        Mostrando libros de la categoría: <strong>{{ $categoriaBuscada }}</strong>
    </div>
@endif

<table class="table table-striped align-middle">
    <thead>
        <tr>
            <th>Código</th>
            <th>Título</th>
            <th>Autor</th>
            <th>Categoría</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    @forelse($libros as $libro)
        <tr>
            <td>{{ $libro->codigo }}</td>
            <td>{{ $libro->titulo }}</td>
            <td>{{ $libro->autor }}</td>
            <td>{{ $libro->categoria }}</td>
            <td>{{ $libro->estado }}</td>
            <td>
                <a href="{{ route('libros.show', $libro) }}" class="btn btn-info btn-sm">Ver</a>
                <a href="{{ route('libros.edit', $libro) }}" class="btn btn-warning btn-sm">Editar</a>
                <form action="{{ route('libros.destroy', $libro) }}" method="POST" style="display:inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar libro?')">Eliminar</button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="6" class="text-center text-muted">No hay libros registrados.</td>
        </tr>
    @endforelse
    </tbody>
</table>
@endsection
