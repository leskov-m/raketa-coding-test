<?php

declare(strict_types = 1);

namespace Raketa\BackendTestTask\Domain\Entity;

use Raketa\BackendTestTask\Application\Contracts\Entity;

final class Cart implements Entity
{
    public function __construct(
        readonly private string        $uuid,
        readonly private string $paymentMethod,
        private array                  $items,
        readonly private ?Customer     $customer = null,
    ) {
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function getPaymentMethod(): string
    {
        return $this->paymentMethod;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function addItem(CartItem $item): void
    {
        $this->items[] = $item;
    }
}
