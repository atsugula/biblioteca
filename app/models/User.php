<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    public $timestamps = false;

    static $rules = [
        'name' => 'required',
        'username' => 'required',
        'identificacion' => 'required|unique:users',
        'nombre_completo' => 'required',
        'correo' => 'required|email|unique:users',
        'telefono' => 'nullable',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'password',
        'identificacion',
        'nombre_completo',
        'correo',
        'telefono',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    // Un usuario puede tener varios préstamos
    public function prestamos()
    {
        return $this->hasMany(Prestamo::class, 'usuario_id');
    }

}
