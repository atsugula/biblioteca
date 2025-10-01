@extends('layout')

@section('content')
<h1>Detalle del Libro</h1>
<ul>
    <li><strong>Código:</strong> {{ $libro->codigo }}</li>
    <li><strong>Título:</strong> {{ $libro->titulo }}</li>
    <li><strong>Autor:</strong> {{ $libro->autor }}</li>
    <li><strong>Año:</strong> {{ $libro->anio_publicacion }}</li>
    <li><strong>Categoría:</strong> {{ $libro->categoria }}</li>
    <li><strong>Estado:</strong> {{ $libro->estado }}</li>
</ul>
<a href="{{ route('libros.index') }}" class="btn btn-secondary">Volver</a>
@endsection
