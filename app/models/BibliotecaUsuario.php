<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BibliotecaUsuario extends Model
{
    use HasFactory;

    protected $table = 'biblioteca_usuarios';

    protected $fillable = [
        'identificacion',
        'nombre_completo',
        'correo',
        'telefono',
    ];

    // Un usuario puede tener varios préstamos
    public function prestamos()
    {
        return $this->hasMany(Prestamo::class, 'usuario_id');
    }
}
