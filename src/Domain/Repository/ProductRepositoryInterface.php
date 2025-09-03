<?php

namespace Raketa\BackendTestTask\Domain\Repository;

use Raketa\BackendTestTask\Domain\Entity\Product;

interface ProductRepositoryInterface
{
    public function getByUuid(string $uuid): Product;

    public function getByCategory(string $category): array;

    public function make(array $row): Product;
}