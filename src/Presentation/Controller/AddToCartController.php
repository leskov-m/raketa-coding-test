<?php

declare(strict_types=1);

namespace Raketa\BackendTestTask\Presentation\Controller;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Raketa\BackendTestTask\Application\DTOResponse\JsonResponse;
use Raketa\BackendTestTask\Application\Service\CartService;
use Raketa\BackendTestTask\Domain\Entity\CartItem;
use Raketa\BackendTestTask\Domain\Repository\ProductRepositoryInterface;
use Raketa\BackendTestTask\Presentation\View\CartView;
use Ramsey\Uuid\Uuid;

readonly class AddToCartController
{
    public function __construct(
        private ProductRepositoryInterface $productRepository,
        private CartView                   $cartView,
        private CartService                $cartService,
    )
    {
    }

    public function get(RequestInterface $request): ResponseInterface
    {
        $rawRequest = json_decode($request->getBody()->getContents(), true);
        $product = $this->productRepository->getByUuid($rawRequest['productUuid']);

        $cart = $this->cartService->getCart();
        $cart->addItem(new CartItem(
            Uuid::uuid4()->toString(),
            $product->getUuid(),
            $product->getPrice(),
            $rawRequest['quantity'],
        ));

        $response = new JsonResponse();
        $response->fill([
            'cart' => $this->cartView->toArray($cart)
        ]);

        return $response->success();
    }
}
