<?php

namespace App\Domain\Producto\ValueObject;

use InvalidArgumentException;

final class Precio
{
    private float $valor;

    public function __construct(float $valor)
    {
        if ($valor < 0) {
            throw new InvalidArgumentException("El precio no puede ser negativo.");
        }

        $this->valor = round($valor, 2);
    }

    public function valor(): float
    {
        return $this->valor;
    }

    public function __toString(): string
    {
        return number_format($this->valor, 2, '.', '');
    }
}
