<?php

namespace App\Domain\Producto\ValueObject;

use Doctrine\ORM\Mapping as ORM;
use InvalidArgumentException;

#[ORM\Embeddable]
final class Nombre
{
    #[ORM\Column(name: "nombre", type: "string", length: 100)]
    private string $nombre;

    public function __construct(string $nombre)
    {
        $nombre = trim($nombre);

        if (empty($nombre)) {
            throw new InvalidArgumentException("El nombre del producto no puede estar vacío.");
        }

        if (strlen($nombre) < 5) {
            throw new InvalidArgumentException("El nombre del producto debe tener al menos 5 caracteres.");
        }

        if (strlen($nombre) > 100) {
            throw new InvalidArgumentException("El nombre del producto no puede exceder los 100 caracteres.");
        }

        $this->nombre = $nombre;
    }

    public function nombre(): string
    {
        return $this->nombre;
    }

    public function __toString(): string
    {
        return $this->nombre;
    }
}
