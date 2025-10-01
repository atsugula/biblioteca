@extends('layout')

@section('content')
<h1>Editar Libro</h1>

<form action="{{ route('libros.update', $libro) }}" method="POST">
    @csrf @method('PUT')
    <div class="mb-3">
        <label>Código</label>
        <input type="text" name="codigo" value="{{ $libro->codigo }}" class="form-control">
    </div>
    <div class="mb-3">
        <label>Título</label>
        <input type="text" name="titulo" value="{{ $libro->titulo }}" class="form-control">
    </div>
    <div class="mb-3">
        <label>Autor</label>
        <input type="text" name="autor" value="{{ $libro->autor }}" class="form-control">
    </div>
    <div class="mb-3">
        <label>Año</label>
        <input type="number" name="anio_publicacion" value="{{ $libro->anio_publicacion }}" class="form-control">
    </div>
    <div class="mb-3">
        <label>Categoría</label>
        <input type="text" name="categoria" value="{{ $libro->categoria }}" class="form-control">
    </div>
    <button class="btn btn-primary">Actualizar</button>
</form>
@endsection
