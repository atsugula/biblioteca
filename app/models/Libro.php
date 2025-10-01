<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    use HasFactory;

    protected $table = 'libros';

    protected $fillable = [
        'codigo',
        'titulo',
        'autor',
        'anio_publicacion',
        'categoria',
        'estado',
    ];

    /**
     * Relación con los préstamos
     * Un libro puede estar en muchos préstamos.
     */
    public function prestamos()
    {
        return $this->hasMany(Prestamo::class, 'libro_id');
    }
}
