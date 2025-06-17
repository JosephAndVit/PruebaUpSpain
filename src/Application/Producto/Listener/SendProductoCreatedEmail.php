<?php

namespace App\Application\Producto\Listener;

use App\Domain\Producto\Event\ProductoCreated;
use App\Infrastructure\Service\EmailService;

class SendProductoCreatedEmail
{
    public function __construct(private EmailService $emailService) {}

    public function __invoke(ProductoCreated $event): void
    {
        $this->emailService->enviar(
            'pepe@up-spain.com',
            'Se ha insertado nuevo producto',
            'El nuevo producto es: ' . $event->productoId,
        );
    }
}
