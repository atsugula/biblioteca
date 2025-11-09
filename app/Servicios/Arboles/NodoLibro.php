<?php

namespace App\Servicios\Arboles;

class NodoLibro
{
    public $libro;
    public ?NodoLibro $izquierdo;
    public ?NodoLibro $derecho;

    public function __construct($libro)
    {
        $this->libro = $libro;
        $this->izquierdo = null;
        $this->derecho = null;
    }
}
