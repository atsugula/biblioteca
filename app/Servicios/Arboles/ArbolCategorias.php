<?php

namespace App\Servicios\Arboles;

class NodoCategoria
{
    public string $categoria;
    public array $libros;
    public ?NodoCategoria $izquierdo;
    public ?NodoCategoria $derecho;

    public function __construct(string $categoria, $libro = null)
    {
        $this->categoria = $categoria;
        $this->libros = $libro ? [$libro] : [];
        $this->izquierdo = null;
        $this->derecho = null;
    }
}

class ArbolCategorias
{
    private ?NodoCategoria $raiz = null;

    public function insertar(string $categoria, $libro): void
    {
        $this->raiz = $this->insertarRecursivo($this->raiz, $categoria, $libro);
    }

    private function insertarRecursivo(?NodoCategoria $nodo, string $categoria, $libro): NodoCategoria
    {
        if ($nodo === null) {
            return new NodoCategoria($categoria, $libro);
        }

        if ($categoria === $nodo->categoria) {
            $nodo->libros[] = $libro;
        } elseif (strcmp($categoria, $nodo->categoria) < 0) {
            $nodo->izquierdo = $this->insertarRecursivo($nodo->izquierdo, $categoria, $libro);
        } else {
            $nodo->derecho = $this->insertarRecursivo($nodo->derecho, $categoria, $libro);
        }

        return $nodo;
    }

    public function buscarPorCategoria(string $categoria): array
    {
        $nodo = $this->buscarCategoriaRecursivo($this->raiz, $categoria);
        return $nodo ? $nodo->libros : [];
    }

    private function buscarCategoriaRecursivo(?NodoCategoria $nodo, string $categoria): ?NodoCategoria
    {
        if ($nodo === null) {
            return null;
        }

        if ($categoria === $nodo->categoria) {
            return $nodo;
        }

        return (strcmp($categoria, $nodo->categoria) < 0)
            ? $this->buscarCategoriaRecursivo($nodo->izquierdo, $categoria)
            : $this->buscarCategoriaRecursivo($nodo->derecho, $categoria);
    }
}
