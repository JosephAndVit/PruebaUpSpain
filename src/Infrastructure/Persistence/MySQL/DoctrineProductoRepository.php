<?php

namespace App\Infrastructure\Persistence\MySQL;

use App\Domain\Producto\Producto;
use App\Domain\Producto\Repository\ProductoRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineProductoRepository implements ProductoRepositoryInterface
{
    private EntityManagerInterface $em;
    private $repository;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->repository = $em->getRepository(Producto::class);
    }

    public function save(Producto $product): void
    {
        $this->em->persist($product);
        $this->em->flush();
    }

    public function findById(string $id): ?Producto
    {
        return $this->repository->find($id);
    }
}
