<?php

namespace App\Domain\Producto\ValueObject;

use InvalidArgumentException;

final class Talla
{
    private const TALLAS = ['XS', 'S', 'M', 'L', 'XL', 'XXL'];

    private string $valor;

    public function __construct(string $valor)
    {
        $valor = strtoupper(trim($valor));

        if (!in_array($valor, self::TALLAS, true)) {
            throw new InvalidArgumentException("Talla no válida: $valor.");
        }

        $this->valor = $valor;
    }

    public function valor(): string
    {
        return $this->valor;
    }

    public function __toString(): string
    {
        return $this->valor;
    }
}
