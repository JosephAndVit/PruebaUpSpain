<?php

namespace App\Domain\Producto\ValueObject;

use Doctrine\ORM\Mapping as ORM;
use InvalidArgumentException;

#[ORM\Embeddable]
final class Descripcion
{
    #[ORM\Column(name: "descripcion", type: "text")]
    private string $descripcion;

    public function __construct(string $descripcion)
    {
        $descripcion = trim($descripcion);

        if (strlen($descripcion) < 10) {
            throw new InvalidArgumentException("La descripción debe tener al menos 10 caracteres.");
        }

        if (strlen($descripcion) > 1000) {
            throw new InvalidArgumentException("La descripción no puede exceder los 1000 caracteres.");
        }

        $this->descripcion = $descripcion;
    }

    public function descripcion(): string
    {
        return $this->descripcion;
    }

    public function __toString(): string
    {
        return $this->descripcion;
    }
}
