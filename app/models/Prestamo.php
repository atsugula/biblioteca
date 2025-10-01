<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    use HasFactory;

    protected $fillable = [
        'libro_id',
        'usuario_id',
        'fecha_prestamo',
        'fecha_devolucion',
    ];

    // Relación con libro
    public function libro()
    {
        return $this->belongsTo(Libro::class);
    }

    // Relación con usuario
    public function usuario()
    {
        return $this->belongsTo(BibliotecaUsuario::class, 'usuario_id');
    }
}
