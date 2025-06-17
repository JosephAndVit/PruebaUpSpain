<?php

namespace App\Application\Producto\Command\CrearProducto;

use App\Domain\Producto\ValueObject\{ProductoId, Nombre, Descripcion};

final class CrearProductoCommand
{
    public function __construct(
        public ProductoId $id,
        public Nombre $nombre,
        public Descripcion $descripcion,
        public array $variantes,
    ) {}
}
