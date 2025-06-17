<?php

namespace App\Domain\Producto\Event;

use App\Domain\Producto\ValueObject\ProductoId;
use App\Domain\Producto\ValueObject\Nombre;

class ProductoCreated
{
    public function __construct(
        public ProductoId $productoId,
        public Nombre $nombre
    ) {}
}
