<?php


namespace App\Infrastructure\Service;

class EmailService
{
    public function enviar(string $para, string $asunto, string $mensaje): void
    {
        // Aquí se utilizaría el paquete o biblioteca que quisieramos para enviar correos.
        correo($para, $asunto, $mensaje);
    }
}
