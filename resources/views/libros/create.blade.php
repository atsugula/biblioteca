@extends('layouts.app')
{{-- @extends('layout') --}}

@section('content')
<h1>Registrar Libro</h1>

<form action="{{ route('libros.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Código</label>
        <input type="text" name="codigo" class="form-control">
    </div>
    <div class="mb-3">
        <label>Título</label>
        <input type="text" name="titulo" class="form-control">
    </div>
    <div class="mb-3">
        <label>Autor</label>
        <input type="text" name="autor" class="form-control">
    </div>
    <div class="mb-3">
        <label>Año de publicación</label>
        <input type="number" name="anio_publicacion" class="form-control">
    </div>
    <div class="mb-3">
        <label>Categoría</label>
        <input type="text" name="categoria" class="form-control">
    </div>
    <button class="btn btn-success">Guardar</button>
</form>
@endsection
