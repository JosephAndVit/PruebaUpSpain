<?php

namespace App\Domain\Producto\ValueObject;

use InvalidArgumentException;

final class Cantidad
{
    private int $valor;

    public function __construct(int $valor)
    {
        if ($valor < 0) {
            throw new InvalidArgumentException("La cantidad en stock no puede ser negativa.");
        }

        $this->valor = $valor;
    }

    public function valor(): int
    {
        return $this->valor;
    }

    public function __toString(): string
    {
        return (string) $this->valor;
    }
}
