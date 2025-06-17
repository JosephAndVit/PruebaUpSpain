<?php

namespace App\Domain\Producto;

use App\Domain\Producto\ValueObject\VarianteId;
use App\Domain\Producto\ValueObject\Talla;
use App\Domain\Producto\ValueObject\Color;
use App\Domain\Producto\ValueObject\Precio;
use App\Domain\Producto\ValueObject\Cantidad;
use App\Domain\Producto\ValueObject\Imagen;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "variantes")]
class Variante
{
    #[ORM\Id]
    #[ORM\Column(type: "string", length: 36, unique: true)]
    private string $id;

    #[ORM\Embedded(class: Talla::class)]
    private Talla $talla;

    #[ORM\Embedded(class: Color::class)]
    private Color $color;

    #[ORM\Embedded(class: Precio::class)]
    private Precio $precio;

    #[ORM\Embedded(class: Cantidad::class)]
    private Cantidad $stock;

    #[ORM\Embedded(class: Imagen::class)]
    private Imagen $imagen;

    #[ORM\ManyToOne(targetEntity: Producto::class, inversedBy: 'variantes')]
    #[ORM\JoinColumn(name: 'producto_id', referencedColumnName: 'id', nullable: false)]
    private Producto $producto;

    public function __construct(
        VarianteId $id,
        Talla $talla,
        Color $color,
        Precio $precio,
        Cantidad $stock,
        Imagen $imagen
    ) {
        $this->id = $id->valor();

        $this->talla = $talla;
        $this->color = $color;
        $this->precio = $precio;
        $this->stock = $stock;
        $this->imagen = $imagen;
    }

    public function actualizarStock(Cantidad $nuevaCantidad): void
    {
        $this->stock = $nuevaCantidad;
    }

    public function id(): VarianteId
    {
        return new VarianteId($this->id);
    }

    public function talla(): Talla
    {
        return $this->talla;
    }

    public function color(): Color
    {
        return $this->color;
    }

    public function precio(): Precio
    {
        return $this->precio;
    }

    public function stock(): Cantidad
    {
        return $this->stock;
    }

    public function imagen(): Imagen
    {
        return $this->imagen;
    }

    public function asociarProducto(Producto $producto): void
    {
        $this->producto = $producto;
    }

    public function producto(): Producto
    {
        return $this->producto;
    }
}
