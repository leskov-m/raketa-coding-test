<?php

declare(strict_types = 1);

namespace Raketa\BackendTestTask\Presentation\Controller;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Raketa\BackendTestTask\Application\DTOResponse\JsonResponse;
use Raketa\BackendTestTask\Presentation\View\ProductsView;

readonly class GetProductsController
{
    public function __construct(
        private ProductsView $productsVew
    ) {
    }

    public function get(RequestInterface $request): ResponseInterface
    {
        $rawRequest = json_decode($request->getBody()->getContents(), true);

        $response = new JsonResponse();
        $response->fill($this->productsVew->toArray($rawRequest['category']));

        return $response->success();
    }
}
