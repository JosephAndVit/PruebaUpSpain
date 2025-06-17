<?php

namespace App\Domain\Producto\ValueObject;

use Ramsey\Uuid\Uuid;
use InvalidArgumentException;

final class VarianteId
{
    private string $valor;

    public function __construct(?string $valor = null)
    {
        // $valor = $valor ?? Uuid::uuid4()->toString();

        // if (!Uuid::isValid($valor)) {
        //     throw new InvalidArgumentException("El ID de la variante no es un UUID válido.");
        // }

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
