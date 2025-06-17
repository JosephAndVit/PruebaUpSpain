<?php

namespace App\Application\Producto\Query\ObtenerProducto;

use App\Domain\Producto\ValueObject\ProductoId;

final class ObtenerProductoQueryHandler
{
    public function obtenerProductoId(ObtenerProductoQuery $query): array
    {
        return []; // Devolveriamos el producto por id de la persistencia correspondiente.
    }
}
