<?php

namespace App\Domain\Producto\ValueObject;

use InvalidArgumentException;

final class Color
{
    private string $color;

    public function __construct(string $color)
    {
        $color = trim($color);

        if (!preg_match('/^#([A-Fa-f0-9]{6})$/', $color)) {
            throw new InvalidArgumentException("El color debe ser un código hexadecimal válido (por ejemplo: #FF5733).");
        }

        $this->color = strtoupper($color);
    }

    public function color(): string
    {
        return $this->color;
    }

    public function __toString(): string
    {
        return $this->color;
    }
}
