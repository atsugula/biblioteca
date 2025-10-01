@extends('layout')

@section('content')
<h1>Préstamos</h1>
<a href="{{ route('prestamos.create') }}" class="btn btn-primary mb-3">Nuevo Préstamo</a>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Libro</th>
            <th>Usuario</th>
            <th>Fecha Préstamo</th>
            <th>Fecha Devolución</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($prestamos as $prestamo)
        <tr>
            <td>{{ $prestamo->libro->titulo }}</td>
            <td>{{ $prestamo->usuario->nombre_completo }}</td>
            <td>{{ $prestamo->fecha_prestamo }}</td>
            <td>{{ $prestamo->fecha_devolucion ?? 'Pendiente' }}</td>
            <td>
                <a href="{{ route('prestamos.show', $prestamo) }}" class="btn btn-info btn-sm">Ver</a>
                <a href="{{ route('prestamos.edit', $prestamo) }}" class="btn btn-warning btn-sm">Editar</a>
                <form action="{{ route('prestamos.destroy', $prestamo) }}" method="POST" style="display:inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar préstamo?')">Eliminar</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection
