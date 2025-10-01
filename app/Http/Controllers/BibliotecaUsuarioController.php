<?php

namespace App\Http\Controllers;

use App\Models\BibliotecaUsuario;
use Illuminate\Http\Request;

class BibliotecaUsuarioController extends Controller
{
    public function index()
    {
        $usuarios = BibliotecaUsuario::all();
        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'identificacion' => 'required|unique:biblioteca_usuarios',
            'nombre_completo' => 'required',
            'correo' => 'required|email|unique:biblioteca_usuarios',
            'telefono' => 'nullable',
        ]);

        BibliotecaUsuario::create($request->all());

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario registrado correctamente.');
    }

    public function show(BibliotecaUsuario $usuario)
    {
        return view('usuarios.show', compact('usuario'));
    }

    public function edit(BibliotecaUsuario $usuario)
    {
        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, BibliotecaUsuario $usuario)
    {
        $request->validate([
            'identificacion' => 'required|unique:biblioteca_usuarios,identificacion,' . $usuario->id,
            'nombre_completo' => 'required',
            'correo' => 'required|email|unique:biblioteca_usuarios,correo,' . $usuario->id,
            'telefono' => 'nullable',
        ]);

        $usuario->update($request->all());

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy(BibliotecaUsuario $usuario)
    {
        $usuario->delete();
        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario eliminado correctamente.');
    }
}
