<?php

namespace App\Http\Controllers;

use App\Models\Prestamo;
use App\Models\Libro;
use App\Models\BibliotecaUsuario;
use Illuminate\Http\Request;

class PrestamoController extends Controller
{
    public function index()
    {
        $prestamos = Prestamo::with(['libro', 'usuario'])->get();
        return view('prestamos.index', compact('prestamos'));
    }

    public function create()
    {
        $libros = Libro::where('estado', 'disponible')->get();
        $usuarios = BibliotecaUsuario::all();
        return view('prestamos.create', compact('libros', 'usuarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'libro_id' => 'required|exists:libros,id',
            'usuario_id' => 'required|exists:biblioteca_usuarios,id',
            'fecha_prestamo' => 'required|date',
        ]);

        $prestamo = Prestamo::create($request->all());

        // Cambiar estado del libro a "prestado"
        $prestamo->libro->update(['estado' => 'prestado']);

        return redirect()->route('prestamos.index')
            ->with('success', 'Préstamo registrado correctamente.');
    }

    public function show(Prestamo $prestamo)
    {
        return view('prestamos.show', compact('prestamo'));
    }

    public function edit(Prestamo $prestamo)
    {
        $libros = Libro::all();
        $usuarios = BibliotecaUsuario::all();
        return view('prestamos.edit', compact('prestamo', 'libros', 'usuarios'));
    }

    public function update(Request $request, Prestamo $prestamo)
    {
        $request->validate([
            'libro_id' => 'required|exists:libros,id',
            'usuario_id' => 'required|exists:biblioteca_usuarios,id',
            'fecha_prestamo' => 'required|date',
            'fecha_devolucion' => 'nullable|date|after_or_equal:fecha_prestamo',
        ]);

        $prestamo->update($request->all());

        // Si ya se devolvió el libro, cambiar estado a disponible
        if ($prestamo->fecha_devolucion) {
            $prestamo->libro->update(['estado' => 'disponible']);
        }

        return redirect()->route('prestamos.index')
            ->with('success', 'Préstamo actualizado correctamente.');
    }

    public function destroy(Prestamo $prestamo)
    {
        // Si el préstamo se elimina y no hay devolución, liberar el libro
        if (!$prestamo->fecha_devolucion) {
            $prestamo->libro->update(['estado' => 'disponible']);
        }

        $prestamo->delete();
        return redirect()->route('prestamos.index')
            ->with('success', 'Préstamo eliminado correctamente.');
    }
}
