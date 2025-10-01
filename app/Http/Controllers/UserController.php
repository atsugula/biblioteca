<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Compra;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate();

        return view('user.index', compact('users'))
            ->with('i', (request()->input('page', 1) - 1) * $users->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();
        return view('user.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mensaje = 'Usuario creado correctamente.';
        $tipo = 'success';
        request()->validate(User::$rules);

        $existeUsername = User::where('username','=',$request['username'])->get();

        if(count($existeUsername) == 0)User::create(['name' => $request['name'],'username' => $request['username'],'password' => Hash::make('12345678'),]);
        else {
            $mensaje = 'Ya hay un usuario con ese username, intente nuevamente.';
            $tipo = 'error';
        }
        return redirect()->route('usuarios.index')
            ->with($tipo, $mensaje);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $mensaje = 'Usuario actualizado correctamente.';
        $tipo = 'success';
        request()->validate(User::$rules);

        $existeUsername = User::where('username','=',$request['username'])
                                ->where('id','!=',$request['user'])->get();

        if(count($existeUsername) == 0){
            $user = User::find($request['user']);
            $user->update($request->all());
        }else {
            $mensaje = 'Ya hay un usuario con ese username, intente nuevamente.';
            $tipo = 'error';
        }
        return redirect()->route('usuarios.index')
            ->with($tipo, $mensaje);
    }

    public function cambiarContrasena(Request $request, User $user){
        $user = User::find($request['user']);
        request()->validate(['password' => ['required', 'min:8', 'confirmed']]);
        $password = Hash::make($request->password);
        $user->update([
            'password' => $password,
        ]);
        return redirect()->route('usuarios.index')
            ->with('success', 'Se cambio la contraseña satisfactoriamente');
    }

    public function mostrarContrasena($id)
    {
      $user = User::find($id);
      return view('user.cambiar-contrasena', compact('user'));
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $mensaje = 'Usuario eliminado correctamente.';
        $tipo = 'success';
        $user = User::find($id);

        $usuConVenta = Venta::where('id_comprador','=',$user->id)->get();
        $usuConCompra = Compra::where('id_comprador','=',$user->id)->get();
        if(count($usuConVenta) == 0 && count($usuConCompra) == 0){
            $user->delete();
        }else{
            $mensaje = 'Este usuario a realizado venta o compras, si se elimina alterara la generación de reportes.';
            $tipo = 'error';
        }
        return redirect()->route('usuarios.index')
            ->with($tipo, $mensaje);
    }
}
