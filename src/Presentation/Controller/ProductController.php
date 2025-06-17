<?php

namespace App\Presentation\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

use App\Application\Producto\Command\CrearProducto\{CrearProductoCommand, CrearProductoHandler};
use App\Application\Producto\Query\ObtenerProducto\{ObtenerProductoQuery, ObtenerProductoQueryHandler};
use App\Domain\Producto\ValueObject\ProductoId;

use App\Domain\Producto\ProductoRepositoryInterface;
use App\Domain\Producto\Event\ProductoCreated;
use App\Infrastructure\Shared\Event\EventDispatcher;
use App\Application\Producto\Listener\SendProductoCreatedEmail;
use App\Infrastructure\Service\EmailService;

class ProductController extends AbstractController
{
    #[Route('/api/productos', name: 'crear_producto', methods: ['POST'])]
    public function crearProducto(Request $request, CrearProductoHandler $handler): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        try {
            $command = new CrearProductoCommand(
                new ProductoId(),
                $data['nombre'],
                $data['descripcion'],
                $data['variantes'] ?? []
            );

            $handler($command);

            $dispatcher = new EventDispatcher();
            $emailService = new EmailService();
            $dispatcher->listen(ProductoCreated::class, new SendProductoCreatedEmail($emailService));

            return new JsonResponse(['status' => 'ok', 'producto_id' => $command->id->getId()], 201);
        } catch (\Throwable $e) {
            return new JsonResponse(['error' => $e->getMessage()], 400);
        }
    }

    #[Route('/api/productos/{id}', name: 'obtener_producto', methods: ['GET'])]
    public function obtenerProducto(int $id, ObtenerProductoQueryHandler $query): JsonResponse
    {
        try {
            $obtenerProducto = new ObtenerProductoQuery(new ProductoId($id));


            return new JsonResponse(['status' => 'ok', 'producto' => $query->obtenerProductoId($obtenerProducto)], 201);
        } catch (\Throwable $e) {
            return new JsonResponse(['error' => $e->getMessage()], 400);
        }
    }
}
