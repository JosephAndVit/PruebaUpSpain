<?php

namespace App\Application\Producto\Command\CrearProducto;

use App\Application\Producto\Command\CrearProducto\CrearProductoCommand;
use App\Domain\Producto\{Producto, Variante};
use App\Domain\Producto\ValueObject\{ProductoId, Nombre, Descripcion, Talla, Color, Precio, Cantidad, Imagen, VarianteId};
use App\Domain\Producto\Repository\ProductoRepositoryInterface;
use App\Infrastructure\Shared\Event\EventDispatcher;

final class CrearProductoHandler
{
    public function __construct(
        private ProductoRepositoryInterface $repository,
        private EventDispatcher $dispatcher
    ) {}

    public function handle(CrearProductoCommand $command): void
    {
        $producto = new Producto(
            new ProductoId($command->id),
            new Nombre($command->nombre),
            new Descripcion($command->descripcion)
        );

        foreach ($command->variantes as $varianteData) {
            $variante = new Variante(
                new VarianteId(),
                new Talla($varianteData['talla']),
                new Color($varianteData['color']),
                new Precio($varianteData['precio']),
                new Cantidad($varianteData['stock']),
                new Imagen($varianteData['imagen'])
            );

            $producto->agregarVariante($variante);
        }

        $this->repository->save($producto);

        foreach ($producto->getEvents() as $event) {
            $this->dispatcher->dispatch($event);
        }
    }
}
