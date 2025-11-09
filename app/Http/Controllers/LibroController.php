<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use Illuminate\Http\Request;
use App\Servicios\Arboles\ArbolLibros;

class LibroController extends Controller
{

    private ArbolLibros $arbol;

    // El árbol se inyecta automáticamente por Laravel
    public function __construct(ArbolLibros $arbol)
    {
        $this->arbol = $arbol;
    }

    public function index()
    {
        $libros = Libro::all();

        foreach ($libros as $libro) {
            $this->arbol->insertar($libro);
        }

        $libros = $this->arbol->recorridoInOrden();

        return view('libros.index', compact('libros'));
    }

    public function create()
    {
        return view('libros.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|unique:libros',
            'titulo' => 'required',
            'autor' => 'required',
            'anio_publicacion' => 'required|digits:4|integer',
            'categoria' => 'required',
        ]);

        Libro::create($request->all());

        return redirect()->route('libros.index')
            ->with('success', 'Libro registrado correctamente.');
    }

    public function show(Libro $libro)
    {
        return view('libros.show', compact('libro'));
    }

    public function edit(Libro $libro)
    {
        return view('libros.edit', compact('libro'));
    }

    public function update(Request $request, Libro $libro)
    {
        $request->validate([
            'codigo' => 'required|unique:libros,codigo,' . $libro->id,
            'titulo' => 'required',
            'autor' => 'required',
            'anio_publicacion' => 'required|digits:4|integer',
            'categoria' => 'required',
        ]);

        $libro->update($request->all());

        return redirect()->route('libros.index')
            ->with('success', 'Libro actualizado correctamente.');
    }

    public function destroy(Libro $libro)
    {
        $libro->delete();
        return redirect()->route('libros.index')
            ->with('success', 'Libro eliminado correctamente.');
    }
}
