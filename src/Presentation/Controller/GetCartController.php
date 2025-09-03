<?php

declare(strict_types = 1);

namespace Raketa\BackendTestTask\Presentation\Controller;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Raketa\BackendTestTask\Application\DTOResponse\JsonResponse;
use Raketa\BackendTestTask\Application\Service\CartService;
use Raketa\BackendTestTask\Presentation\View\CartView;

readonly class GetCartController
{
    public function __construct(
        public CartView $cartView,
        public CartService $cartService
    ) {
    }

    public function get(RequestInterface $request): ResponseInterface
    {
        $cart = $this->cartService->getCart();

        $response = new JsonResponse();
        $response->fill($this->cartView->toArray($cart));

        return $response->success();
    }
}
