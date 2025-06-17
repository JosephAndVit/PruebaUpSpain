<?php

namespace App\Domain\Producto\Repository;

use App\Domain\Producto\Producto;

interface ProductoRepositoryInterface
{
    public function save(Producto $product): void;
    public function findById(string $id): ?Producto;
}
