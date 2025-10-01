{{-- @extends('layout') --}}
@extends('layouts.app')

@section('content')
<h1>Libros</h1>
<a href="{{ route('libros.create') }}" class="btn btn-primary mb-3">Registrar Libro</a>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Código</th>
            <th>Título</th>
            <th>Autor</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($libros as $libro)
        <tr>
            <td>{{ $libro->codigo }}</td>
            <td>{{ $libro->titulo }}</td>
            <td>{{ $libro->autor }}</td>
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
    @endforeach
    </tbody>
</table>
@endsection
