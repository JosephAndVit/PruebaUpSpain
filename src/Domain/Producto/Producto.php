<?php

namespace App\Domain\Producto;

use App\Domain\Producto\ValueObject\ProductoId;
use App\Domain\Producto\ValueObject\Nombre;
use App\Domain\Producto\ValueObject\Descripcion;
use App\Domain\Producto\Event\ProductoCreated;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
#[ORM\Table(name: 'productos')]
class Producto
{
    #[ORM\Id]
    #[ORM\Embedded(class: ProductoId::class, columnPrefix: false)]
    private ProductoId $id;

    #[ORM\Embedded(class: Nombre::class)]
    private Nombre $nombre;

    #[ORM\Embedded(class: Descripcion::class)]
    private Descripcion $descripcion;

    #[ORM\OneToMany(mappedBy: 'producto', targetEntity: Variante::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $variantes;

    private array $events = [];

    public function __construct(ProductoId $id, Nombre $nombre, Descripcion $descripcion)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->variantes = new ArrayCollection();

        $this->recordEvent(new ProductoCreated($this->id, $this->nombre));
    }

    public function id(): ProductoId
    {
        return new ProductoId($this->id);
    }

    public function nombre(): Nombre
    {
        return $this->nombre;
    }

    public function descripcion(): Descripcion
    {
        return $this->descripcion;
    }

    public function agregarVariante(Variante $variante): void
    {
        if (!$this->variantes->contains($variante)) {
            $this->variantes->add($variante);
            $variante->asociarProducto($this);
        }
    }

    public function variantes(): Collection
    {
        return $this->variantes;
    }

    public function getEvents(): array
    {
        return $this->events;
    }

    private function recordEvent(object $event): void
    {
        $this->events[] = $event;
    }
}
