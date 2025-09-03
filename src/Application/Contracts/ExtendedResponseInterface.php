<?php

namespace Raketa\BackendTestTask\Application\Contracts;

use Psr\Http\Message\ResponseInterface;

interface ExtendedResponseInterface extends ResponseInterface
{
    public function success(int $status = 200): ResponseInterface;
    public function fill(array $data, int $status = 200): void;
}