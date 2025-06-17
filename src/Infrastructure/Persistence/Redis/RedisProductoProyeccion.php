<?php

namespace App\Infrastructure\Persistence\Redis;

use Predis\Client;

final class RedisProductoProyeccion
{
    public function __construct(private \Redis $redis) {}

    public function guardar(string $id, array $producto): void
    {
        $this->redis->set("producto:$id", json_encode($producto));
    }

    public function buscar(string $id): ?array
    {
        $json = $this->redis->get("producto:$id");
        return $json ? json_decode($json, true) : null;
    }
}
