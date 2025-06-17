<?php

namespace App\Domain\Producto\ValueObject;

use InvalidArgumentException;

final class Imagen
{
    private string $url;

    public function __construct(string $url)
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new InvalidArgumentException("La URL de la imagen no es válida.");
        }

        $this->url = $url;
    }

    public function valor(): string
    {
        return $this->url;
    }

    public function __toString(): string
    {
        return $this->url;
    }
}
