<?php

declare(strict_types = 1);

namespace Raketa\BackendTestTask\Presentation\View;

use Raketa\BackendTestTask\Domain\Entity\Cart;
use Raketa\BackendTestTask\Infrastructure\Repository\ProductRepository;

readonly class CartView
{
    public function __construct(
        private ProductRepository $productRepository
    ) {
    }

    public function toArray(Cart $cart): array
    {
        $customer = $cart->getCustomer();

        $data = [
            'uuid' => $cart->getUuid(),
            'customer' => [
                'id' => $customer->getId(),
                'name' => implode(' ', [
                    $customer->getLastName(),
                    $customer->getFirstName(),
                    $customer->getMiddleName(),
                ]),
                'email' => $customer->getEmail(),
            ],
            'payment_method' => $cart->getPaymentMethod(),
        ];

        $cartItems = $cart->getItems();
        $cartItemsProductsMap = $this->buildCartProductsMap($cartItems);

        $total = 0;
        $data['items'] = [];
        foreach ($cartItems as $item) {
            $product = $cartItemsProductsMap[$item->getProductUuid()];
            $data['items'][] = [
                'uuid' => $item->getUuid(),
                'price' => $item->getPrice(),
                'total' => $total,
                'quantity' => $item->getQuantity(),
                'product' => [
                    'id' => $product->getId(),
                    'uuid' => $product->getUuid(),
                    'name' => $product->getName(),
                    'thumbnail' => $product->getThumbnail(),
                    'price' => $product->getPrice(),
                ],
            ];
        }

        $data['total'] = $total;

        return $data;
    }

    private function buildCartProductsMap(array $cartItems): array
    {
        $toSearch = [];

        foreach ($cartItems as $item) {
            $productUuid = $item->getProductUuid();

            if (!in_array($productUuid, $toSearch, true)) {
                $toSearch[] = $productUuid;
            }
        }

        $products = $this->productRepository->whereIn('uuid', $toSearch);

        $map = [];
        foreach ($cartItems as $item) {
            $map[$item->getProductUuid()] = $item;

            foreach ($products as $product) {
                if ($product->getUuid() === $item->getProductUuid()) {
                    $map[$product->getUuid()] = $product;
                    break;
                }
            }
        }

        return $map;
    }
}
