<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use Illuminate\Http\Request;
use App\Servicios\Arboles\ArbolLibros;
use App\Servicios\Arboles\ArbolCategorias;

class LibroController extends Controller
{
    private ArbolLibros $arbolLibros;
    private ArbolCategorias $arbolCategorias;

    // Ambos árboles se inyectan automáticamente por el contenedor de Laravel
    public function __construct(ArbolLibros $arbolLibros, ArbolCategorias $arbolCategorias)
    {
        $this->arbolLibros = $arbolLibros;
        $this->arbolCategorias = $arbolCategorias;
    }

    public function index(Request $request)
    {
        $categoriaBuscada = $request->input('categoria');

        $libros = Libro::all();

        // Construir ambos árboles
        foreach ($libros as $libro) {
            $this->arbolLibros->insertar($libro);
            $this->arbolCategorias->insertar($libro->categoria, $libro);
        }

        // Libros ordenados (por código)
        $librosOrdenados = $this->arbolLibros->recorridoInOrden();

        // Si se busca una categoría específica, obtener sus libros
        $librosFiltrados = $categoriaBuscada
            ? $this->arbolCategorias->buscarPorCategoria($categoriaBuscada)
            : $librosOrdenados;

        return view('libros.index', [
            'libros' => $librosFiltrados,
            'categoriaBuscada' => $categoriaBuscada,
        ]);
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
            'anio_publicacion' => 'required',
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
