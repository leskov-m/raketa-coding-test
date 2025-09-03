<?php

namespace Raketa\BackendTestTask\Domain\Repository;

use Raketa\BackendTestTask\Domain\Entity\Product;

interface ProductRepositoryInterface
{
    public function whereIn(string $field, array $values): array;
    public function getByUuid(string $uuid): Product;

    public function getByCategory(string $category): array;

    public function make(array $row): Product;
}