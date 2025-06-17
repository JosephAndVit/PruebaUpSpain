<?php

namespace App\Domain\Producto\ValueObject;

use Ramsey\Uuid\Uuid;
use Doctrine\ORM\Mapping as ORM;
use InvalidArgumentException;


#[ORM\Embeddable]
final class ProductoId
{
    // #[ORM\Column(name: "producto_id", type: "guid", unique: true)]
    #[ORM\Column(name: "producto_id", type: "guid", unique: true)]
    private string $id;

    public function __construct(?string $id = null)
    {
        if ($id === null) {
            $id = Uuid::uuid4()->toString();
        }

        if (!Uuid::isValid($id)) {
            throw new InvalidArgumentException("El ID del producto no es un UUID válido.");
        }

        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function __toString(): string
    {
        return $this->id;
    }
}
