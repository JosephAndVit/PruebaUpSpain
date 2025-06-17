<?php

namespace App\Application\Producto\Query\ObtenerProducto;

use App\Domain\Producto\ValueObject\ProductoId;

final class ObtenerProductoQuery
{
    public function __construct(public ProductoId $id) {}
}
