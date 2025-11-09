<?php

namespace App\Servicios\Arboles;

class ArbolLibros
{
    private ?NodoLibro $raiz = null;

    public function insertar($libro): void
    {
        $this->raiz = $this->insertarRecursivo($this->raiz, $libro);
    }

    private function insertarRecursivo(?NodoLibro $nodo, $libro): NodoLibro
    {
        if ($nodo === null) {
            return new NodoLibro($libro);
        }

        if ($libro->codigo < $nodo->libro->codigo) {
            $nodo->izquierdo = $this->insertarRecursivo($nodo->izquierdo, $libro);
        } else {
            $nodo->derecho = $this->insertarRecursivo($nodo->derecho, $libro);
        }

        return $nodo;
    }

    public function buscar(string $codigo)
    {
        return $this->buscarRecursivo($this->raiz, $codigo);
    }

    private function buscarRecursivo(?NodoLibro $nodo, string $codigo)
    {
        if ($nodo === null) return null;
        if ($codigo === $nodo->libro->codigo) return $nodo->libro;

        return ($codigo < $nodo->libro->codigo)
            ? $this->buscarRecursivo($nodo->izquierdo, $codigo)
            : $this->buscarRecursivo($nodo->derecho, $codigo);
    }

    public function recorridoInOrden(): array
    {
        $resultado = [];
        $this->recorrerInOrden($this->raiz, $resultado);
        return $resultado;
    }

    private function recorrerInOrden(?NodoLibro $nodo, array &$resultado): void
    {
        if ($nodo !== null) {
            $this->recorrerInOrden($nodo->izquierdo, $resultado);
            $resultado[] = $nodo->libro;
            $this->recorrerInOrden($nodo->derecho, $resultado);
        }
    }
}
